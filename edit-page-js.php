<?php
session_start();
include "includes/class/main.class.php";
$obj = new ForEx();
$obj->editFile($_POST["siteType"],$_POST["siteLink"],$_POST["fileType"],$_POST["siteInput"]);

?>