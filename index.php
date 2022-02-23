<?php
session_start();
include_once("includes/class/main.class.php");
$url = "http://$_SERVER[HTTP_HOST] $_SERVER[REQUEST_URI]";
$obj = new ForEx();
$url_parse = parse_url($url, PHP_URL_PATH);
$splitURL = explode("/", $url_parse);
$endof2 = end($splitURL);
$splitEndOf = explode("?", $endof2);
$endof = $splitEndOf[0];
if ($endof == "" || $endof == "index.php") {
    $endof = "home";
}
$endofFile = $obj->readPageProperties("fileType", $endof, "", "", "siteLink");
$type = $obj->readPageProperties("siteType", $endof, "", "", "siteLink");
$siteLink = $endof;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="assets/js/library.js"></script>
    <script src="assets/js/parser.js"></script>


    <link rel="stylesheet" href="assets/css/style.css">


    <?php

    if ($endof == "" || $endof == "index.php") {
        echo "<title>AM Forex | Home</title>";
    } else {
        echo "<title>AM Forex | " . ucfirst($endof) . "</title>";
    }


    ?>

</head>

<body>

    <?php


    if (isset($_SESSION["login"]) && $_SESSION["login"] == "adminLogin") {

        echo '<script src="assets/js/master-admin.js"></script>';
        $obj = new ForEx();
        if (isset($_GET["typeView"])  &&  $_GET["typeView"] == "true") {
            @include "templates/nav.tpl.html";
            if ($_GET["type"]  == "logout") {
                $arrayInput235 = $obj->readSiteConf("confInput", "confType", "logout");
            } else if ($_GET["type"] == "login") {
                $arrayInput235 = $obj->readSiteConf("confInput", "confType", "login");
            }

            echo '<script>
        var array =' . ($arrayInput235) . ';     
            $(".navbar-collapse").click(function(){this.insertBeforeFromObject(array,this.childNode);});
            $(".navbar-collapse").click();
            $(".navbar-collapse").off("click");
         
        </script>';
            ?>

            <?php
            echo "<main>";

            $_SESSION["view"] = "true";
            if (@!include "sites/" . $_GET["type"] . "/" . $siteLink . "/index." . $endofFile) {
                echo "Cant View page";
            } else {

                echo "</main>";
            }


            ?>
            <script>
                window.onload = function() {
                    $(".save-button").css("display", "inline");
                    $('main').attr('contenteditable', '');

                    function GetURLParameter(sParam) {
                        var sPageURL = window.location.search.substring(1);
                        var sURLVariables = sPageURL.split('&');
                        for (var i = 0; i < sURLVariables.length; i++) {
                            var sParameterName = sURLVariables[i].split('=');
                            if (sParameterName[0] == sParam) {
                                return sParameterName[1];
                            }
                        }
                    }

                    var type_l = GetURLParameter("type");
                    var siteLink_l = GetURLParameter("siteLink");

                    $(".save-on-view").click(function() {
                        var siteInput_l = $('main').html();
                        $.post("edit-page-js.php", {
                            siteType: type_l,
                            siteLink: siteLink_l,
                            fileType: "php",
                            siteInput: siteInput_l
                        }, function(data) {

                        })

                    })
                } //end onload
            </script>

        <?php


    } else {
        @include "templates/login/admin/nav.tpl.html";
    }
} else if (isset($_SESSION["login"]) && $_SESSION["login"] == "userLogin") {
    $assets = $obj->readPagePropertiesAssets($endof, "login");
    $splitAssets = explode(",", $assets);


    ?>
        <script>
            $(document).ready(function() {
                var allElem = $("[data-member]");

                var actualElem = [];
                var s = 0;
                for (var i = 0; i <= allElem.length - 1; i++) {

                    actualElem[i] = allElem[i];
                    //.getAttribute("data-member")
                    var tagNameElem = actualElem[i].tagName.toLowerCase();
                    var attributeElem = actualElem[i].dataset.member;
                    //console.log(actualElem[i]);

                    $.post("includes/inc/selectMemberData.php", {
                        get: attributeElem
                    }, function(data) {

                        if ($("[data-member]:eq(" + s + ")").prop("tagName") == "INPUT") {
                            $("[data-member]:eq(" + s + ")").val(data);
                        } else {
                            $("[data-member]:eq(" + s + ")").text(data);

                        }
                        s++;
                    })
                }
            })
        </script>
        <script>
            var src = <?php echo json_encode($splitAssets) ?> ;
            var src2 = [];
            var src3 = [];

            for (var i = 0; i <= src.length - 1; i++) {
                var splitSrc = src[i].split(".");
                src2.push(splitSrc[splitSrc.length - 1]);
                src3.push("sites/assets/" + src2[i] + "/" + src[i]);
            }

            elem.addTag(src3, 'head');
        </script>

        <?php
        include "templates/login/user/nav.tpl.html";
        $arrayInput23 = $obj->readSiteConf("confInput", "confType", "login");
        echo '<script>
    var array =' . ($arrayInput23) . ';
     

     window.onload = function(){
    $(".navbar-collapse").click(function(){this.insertBeforeFromObject(array,this.childNode);});
     $(".navbar-collapse").click();
     $(".navbar-collapse").off("click");
     }
    </script>';
        if ($endof == "" || $endof == "index.php") {
            if (!@include "sites/login/home/index." . $endofFile) {
                echo "No such file";
            }
        } else {
            if (!@include "sites/login/$endof/index.php") {
                echo "No such file";
            }
        }
    } else {
        $assets = $obj->readPagePropertiesAssets($endof, "logout");
        $splitAssets = explode(",", $assets);


        ?>
        <script>
            var src = <?php echo json_encode($splitAssets) ?>;
            var src2 = [];
            var src3 = [];

            for (var i = 0; i <= src.length - 1; i++) {
                var splitSrc = src[i].split(".");
                src2.push(splitSrc[splitSrc.length - 1]);
                src3.push("sites/assets/" + src2[i] + "/" + src[i]);
            }

            elem.addTag(src3, 'head');
        </script>
        <?php
        include "templates/nav.tpl.html";
        $arrayInput2 = $obj->readSiteConf("confInput", "confType", "logout");
        echo '<script>
    var array =' . ($arrayInput2) . ';
     

    
     $(".navbar-collapse").click(function(){this.insertBeforeFromObject(array,this.childNode);});
     $(".navbar-collapse").click();
     $(".navbar-collapse").off("click");

    </script>';
        if ($endof == "" || $endof == "index.php") {
            if (!@include "sites/logout/home/index.php") {
                include "sites/logout/home/index.html";
            }
        } else {

            if (!@include "sites/logout/$endof/index.php") {
                if (!@include "sites/logout/$endof/index.html") {
                    echo "No such file";
                }
            }
        }
    }

    ?>
    <div class="save-button"><a href='show-site-conf.php' class='left-corner' contenteditable='false'><i class='fas back-arrow fa-arrow-left'></i>back</a>
        <div class="clicked right-corner text-right" style="margin-top:20px">

            <div class="save-on-view" data-toggle="buttons">
                <label class="btn btn-lg btn-success ">
                    <input type="radio" name="options" id="option1" autocomplete="off" checked>
                    <i class=""></i> Save
                </label>
            </div>
        </div>
    </div>

    <script src="assets/js/master.js"></script>
    <script>
        var node = document.createElement("div");
        node.setAttribute("class", "caret");
        if ($(" ul > li > ul").children().length > 0) {
            $(" ul > li:has(ul) > a").append(node);
        }
        // $(" ul > li > ul > a").append(node);
    </script>
</body>

</html>