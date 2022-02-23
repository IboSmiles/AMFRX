<?php
ob_start();
/**
 * Main Klasse für Forex Am
 */
class ForEx
{
    public function adminLogin($userID, $pw)
    {
        include "includes/inc/db.inc.php";
        $sql = "SELECT * FROM adminmembers";
        if ($stmt = $mysql->prepare($sql)) {
            $stmt->execute();
            $stmt->bind_result($id, $userID_db, $email, $pw_db);
            while ($stmt->fetch()) {
                if ($userID == $userID_db && $pw == $pw_db) {
                    $_SESSION["userid"] = $userID;
                    $_SESSION["login"] = "adminLogin";
                    header("Location:index.php");
                    echo "<script>window.location.href = 'home';</script>";
                } else {
                    echo "<script>alert('Wrong Passwort or username')</script>";
                }
            }
        } else {
            echo "<script>alert('SQL Error')</script>";
        }
    }

    public function addPage($siteName, $siteLink, $forType, $fileType, $siteInput, $fileAssets)
    {
        include "includes/inc/db.inc.php";
        $sql = "INSERT INTO sitesavaible(siteName,siteLink,siteType,fileType,assets)VALUES(?,?,?,?,?)";
        if ($stmt = $mysql->prepare($sql)) {
            $stmt->bind_param("sssss", $siteName, $siteLink, $forType, $fileType, $fileAssets);
            $stmt->execute();
            if (mkdir("sites/" . $forType . "/" . $siteLink . "")) {
                $f = fopen("sites/" . $forType . "/" . $siteLink . "/index." . $fileType, "w");
                fwrite($f, $siteInput);
                header("Location:show-site-conf.php");
            }
        } else {
            echo "NO";
        }
    }
    public function addAsset($fileName, $srcLink, $fileType, $fileInput)
    {
        include "includes/inc/db.inc.php";
        $sql = "INSERT INTO assets(name,url,type)VALUES(?,?,?)";
        if ($stmt = $mysql->prepare($sql)) {
            $url = $srcLink . "." . $fileType;
            $stmt->bind_param("sss", $fileName, $url, $fileType);
            $stmt->execute();

            $f = fopen("sites/assets/" . $fileType . "/$srcLink." . $fileType, "w");
            fwrite($f, $fileInput);
        } else {
            echo "NO";
        }
    }

    public function readSites($whichType)
    {
        include "includes/inc/db.inc.php";
        $sql = "SELECT * FROM sitesavaible WHERE siteType = '" . $whichType . "'";
        if ($stmt = $mysql->prepare($sql)) {
            $stmt->execute();
            $stmt->bind_result($id, $siteName, $siteLink, $siteType, $fileType, $assets);

            $heardoc = "";
            echo '<div class="row">';
            while ($stmt->fetch()) {
                echo "
                <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>
               
                <div class='box-part text-center'>
                    
                    <i class='	fa fas fa-window-maximize'style='font-size:40px' aria-hidden='true'></i>
                    
                    <div class='title'>
                        <h4>$siteName </h4>
                    </div>
                    
                    <div class='text'>
                        <span>Lorem ipsum dolor sit amet, id quo eruditi eloquentiam. Assum decore te sed. Elitr scripta ocurreret qui ad.
                        </span>
                    </div>
                    
                    <a href='$siteLink?id=$id&type=$siteType&siteLink=$siteLink&typeView=true'>Visit Site</a> <a href='edit-page.php?id=$id&type=$siteType&siteLink=$siteLink&fileType=$fileType&assets=$assets'>Edit Site</a>
                    <div class='footer'<span class'siteType' ><b>$siteType</b></span></div>
                 </div>
                 </div>
            
";
            }
            echo "</div>";
        }
    }


    public function userLogin($userID, $pw)
    {
        include "includes/inc/db.inc.php";
        $sql = "SELECT * FROM members";
        if ($stmt = $mysql->prepare($sql)) {
            $stmt->execute();
            $stmt->bind_result($id, $name, $userID_db, $pw_db, $email);
            while ($stmt->fetch()) {
                if ($userID == $userID_db && $pw == $pw_db) {
                    echo "YES";
                    $_SESSION["userid"] = $userID;
                    $_SESSION["login"] = "userLogin";
                    echo "<script>window.location.href = 'home';</script>";
                } else {
                    header("Location:index.php");
                }
            }
        } else {
            echo "<script>alert('SQL Error')</script>";
        }
    }



    public function editPage($id, $siteName, $siteLink, $forType, $fileType, $siteInput, $fileAssets)
    {
        include "includes/inc/db.inc.php";
        $sql = "UPDATE sitesavaible SET siteName=?,siteLink=?,siteType=?,assets=? WHERE id ='" . $id . "' ";
        if ($stmt = $mysql->prepare($sql)) {
            $stmt->bind_param("ssss", $siteName, $siteLink, $forType, $fileAssets);
            $stmt->execute();
            $f = fopen("sites/" . $forType . "/" . $siteLink . "/index." . $fileType, "w");
            fwrite($f, $siteInput);
            header("Refresh:0");
        } else {
            echo "NO";
        }
    }

    public function readPageProperties($which, $id, $type = '', $siteLink = '', $whichTable = "id")
    {
        include "includes/inc/db.inc.php";
        $input = [];
        $typeFile = '';
        $i  = 0;
        if ($which == "siteInput") {
            $fileName = scandir("sites/$type/$siteLink");

            $split = explode(".", end($fileName));
            if (end($split) != "") {
                $typeFile = end($split);
            }
            $file = fopen("sites/$type/$siteLink/index.$typeFile", "r") or die("Unable to Read file");
            while (!feof($file)) {
                array_push($input, fgets($file));
            }
            foreach ($input as $key => $value) {
                echo $value;
            }
        } else {
            $sql = "SELECT $which FROM sitesavaible WHERE $whichTable = '" . $id . "'";
            if ($stmt = $mysql->prepare($sql)) {
                $stmt->execute();
                $stmt->bind_result($which_output);
                while ($stmt->fetch()) {
                    return $which_output;
                }
            }
        }
    }

    public function editFile($siteType, $siteLink, $fileType, $siteInput)
    {
        echo $siteInput;
        $input = [];
        if ($f = fopen("sites/" . $siteType . "/" . $siteLink . "/index." . $fileType, "w")) {

            fwrite($f, htmlspecialchars_decode($siteInput));
            fclose($f);
        }
    }

    public function readAssets($type_l)
    {
        include "includes/inc/db.inc.php";
        $sql = "SELECT * FROM assets WHERE type = '" . $type_l . "'";
        if ($stmt = $mysql->prepare($sql)) {
            $stmt->execute();
            $stmt->bind_result($id, $name, $url, $type);
            echo '<div class="row">';
            while ($stmt->fetch()) {
                echo "
                <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12' style='display:block !important'>
               
                <div class='box-part text-center'>
                    
                    <i class='fas fa-file'style='font-size:60px' aria-hidden='true'></i>
                    
                    <div class='title'>
                        <h4>$name</h4>
                    </div>
                    
                    <div class='text'>
                        <span>Lorem ipsum dolor sit amet, id quo eruditi eloquentiam. Assum decore te sed. Elitr scripta ocurreret qui ad.
                        </span>
                    </div>
                    
                    <a href='edit-asset.php?id=$id&type=$type&name=$name&url=$url'>Edit File</a>
                    <div class='footer'<span class'siteType' ><b>$type</b></span></div>
                 </div>
                 </div>
            
";
            }
            echo "</div>";
        }
    }
    public function readAssetsOption($select = '', $siteLink = '')
    {
        include "includes/inc/db.inc.php";
        if ($select == "selected") {
            $sql2 = "SELECT * FROM assets WHERE siteLink = '" . $siteLink . "'";
            if ($stmt2 = $mysql->prepare($sql2)) {
                $stmt2->execute();
                $stmt2->bind_result($id2, $name2, $url2, $type2);
                while ($stmt2->fetch()) {
                    echo "<option value='$url2' >{$name2}.{$type2}</option>";
                }
            }
        } else {
            $sql = "SELECT * FROM assets";
            if ($stmt = $mysql->prepare($sql)) {
                $stmt->execute();
                $stmt->bind_result($id, $name, $url, $type);
                while ($stmt->fetch()) {
                    echo "<option value='$url'>{$name}.{$type}</option>";
                }
            }
        }
    }





    public function readPageProperties_assets($which, $id, $type = '', $fileLink = '', $whichTable = "id")
    {
        include "includes/inc/db.inc.php";
        $input = [];
        $typeFile = '';
        $i  = 0;
        if ($which == "fileInput") {

            $file = fopen("sites/assets/$type/$fileLink", "r") or die("Unable to Read file");
            while (!feof($file)) {
                array_push($input, fgets($file));
            }
            foreach ($input as $key => $value) {
                echo $value;
            }
        } else {
            $sql = "SELECT $which FROM assets WHERE $whichTable = '" . $id . "'";
            if ($stmt = $mysql->prepare($sql)) {
                $stmt->execute();
                $stmt->bind_result($which_output);
                while ($stmt->fetch()) {
                    return $which_output;
                }
            }
        }
    }


    public function editAsset($fileName, $fileType, $fileInput, $varURL)
    {
        include "includes/inc/db.inc.php";
        $sql = "UPDATE assets SET name='" . $fileName . "',type='" . $fileType . "' WHERE url = '" . $varURl . "' ";
        if ($stmt = $mysql->prepare($sql)) {
            $stmt->execute();
            $f = fopen("sites/assets/$fileType/$varURL", "w");
            fwrite($f, $fileInput);
            header("Refresh:0");
        }
    }

    public function readSiteConf($select, $where, $equal)
    {
        include "includes/inc/db.inc.php";
        $sql = "SELECT $select FROM websiteConf WHERE $where = '$equal'";
        if ($stmt = $mysql->prepare($sql)) {
            $stmt->execute();
            $stmt->bind_result($res);
            while ($stmt->fetch()) {
                return $res;
            }
        } else {
            echo "NO";
        }
    }
    public function updateConf($select,$where,$equal,$array)
    {
      
       include "includes/inc/db.inc.php";
       $sql = "UPDATE websiteConf SET $select='$array' WHERE $where='$equal'";
       if($stmt = $mysql->prepare($sql)){
           $stmt->execute();
       }
    }
    public function readPagePropertiesInOption($which, $id, $type = '', $siteLink = '', $whichTable = "id")
    {
        include "includes/inc/db.inc.php";
   
            $sql = "SELECT $which FROM sitesavaible WHERE $whichTable = '" . $id . "'";
            if ($stmt = $mysql->prepare($sql)) {
                $stmt->execute();
                $stmt->bind_result($which_output,$link);
                while ($stmt->fetch()) {
                    echo "<option value='$link'>$which_output</option>";
                
                }
            }
        
    }
    public function readPagePropertiesAssets($site,$type)
    {
        include "includes/inc/db.inc.php";
        $sql = "SELECT assets FROM sitesavaible WHERE siteType = '".$type."' && siteLink ='".$site."'";
        if($stmt = $mysql->prepare($sql)){
            $stmt->execute();
            $stmt->bind_result($assets);
            while($stmt->fetch()){
                return $assets;
            }
        }
    }
}
?>
