<?php
session_start();
include "includes/class/main.class.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="assets/js/library.js"></script>
    <script src="assets/js/master-admin.js"></script>
    <title>Add and Delete Sites</title>
</head>
<body>
    <?php
        if(isset($_SESSION["login"]) && $_SESSION["login"] == "adminLogin"){
            include "templates/login/admin/nav.tpl.html";

            ?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="box">
    <div class="container">
     	
             <?php
                $obj = new ForEx();
                $obj->readAssets("css");
             ?><hr>
             <?php
                $obj = new ForEx();
                $obj->readAssets("js");
             ?>
		
    </div>
</div>

<a href="add-asset.php"><i class="fas fa-plus-circle plus-add right-corner float-sm-right"></i></a>
     
            <?php
        }else{
            header("Location:login.php");
        }

    ?>
</body>
</html>