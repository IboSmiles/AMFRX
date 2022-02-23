<?php
session_start();
include "includes/class/main.class.php";
$obj = new ForEx();
$obj->updateConf("confLogin","confType",$_POST["type"],$_POST["array1"]);
$obj->updateConf("confInput","confType",$_POST["type"],$_POST["array2"]);




























