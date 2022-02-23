<?php
session_start();
include "db.inc.php";
$selector = $_POST["get"];


if($selector != "pw"){
    $sql = "SELECT $selector FROM members WHERE userID = '".$_SESSION['userid']."' ";
    if($stmt = $mysql->prepare($sql)){
        $stmt->execute();
        $stmt->bind_result($get);
        while($stmt->fetch()){
            echo $get;
        }
    }
}else{
    echo "Permission Denied";
}





?>