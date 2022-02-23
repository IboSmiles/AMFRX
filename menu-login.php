<?php
session_start();
include "includes/class/main.class.php";
$obj = new ForEx();
$arrayInput = $obj->readSiteConf("confLogin", "confType", "login");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="http://igniteui.com/js/modernizr.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
    <script src="http://cdn-na.infragistics.com/igniteui/latest/js/infragistics.core.js"></script>
    <script src="http://cdn-na.infragistics.com/igniteui/latest/js/infragistics.lob.js"></script>
    <link href="http://cdn-na.infragistics.com/igniteui/latest/css/themes/infragistics/infragistics.theme.css" rel="stylesheet">
    <link href="http://cdn-na.infragistics.com/igniteui/latest/css/structure/infragistics.css" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <script src="assets/js/library.js"></script>

    <script src="assets/js/menu.js"></script>
    <script src="assets/js/parser.js"></script>
    <script>
        var mainArray = eval(<?php echo json_encode($arrayInput); ?>);
        $(document).ready(function() {
            showTreeFir(mainArray);
            document.querySelector(".clicked").onclick = function() {
                var ul = $(".firstTree ul");
                var lengthOfUl = ul.length - 2;

                for (var i = 0; i <= lengthOfUl; i++) {
                    var realI = i + 1;
                    var item = $("[data-depth='" + realI + "']");
                    for (let d = 0; d <= item.length - 1; d++) {
                        var item3 = $("[data-depth='" + realI + "']:eq(" + d + ") > li");

                        for (var s = 0; s <= item3.length - 1; s++) {
                            var item2DataPath = $("[data-depth='" + realI + "']:eq(" + d +
                                ") > li[data-path]:eq(" + s + ")").attr("data-path");
                            var item2 = $("[data-depth='" + realI + "']:eq(" + d + ") > li[data-path]:eq(" + s +
                                ") > a");
                            var urlImgSrc = $("[data-depth='" + realI + "']:eq(" + d + ") > li[data-path]:eq(" +
                                s + ") > img").attr("src");
                            console.log(urlImgSrc);
                            var item2Split = item2DataPath.split(".");
                            var num = 0;
                            num++;
                            if (realI == 1) {

                                head[0].Folder.push({
                                    Text: item2.html(),
                                    ImageUrl: urlImgSrc,
                                    Value: "Folder",
                                    Folder: []
                                })

                                Object.assign(nav.ul.children, {
                                    ["li" + item2Split[1]]: {
                                        children: {
                                            a: {
                                                href: urlImgSrc,
                                                innerHTML: item2.html()
                                            },
                                            ul: {
                                                children: {}
                                            }
                                        }
                                    }
                                });


                            } else {

                                underUnder(item2Split, item2.html(), s, urlImgSrc);
                                var obj2 = parseInt(item2Split[1]) + parseInt(1);

                                // addMenuItem(item2Split[0] + "." + obj2,"","Ha");
                                ///    $(".firstTree").igTree("reload");

                            }
                        }
                    }

                }
                var obj = JSON.stringify(head);
                obj8 = JSON.stringify(nav);
                console.log(nav);
                console.log(obj8);
                $.post("menu-save.php", {
                    array1: obj,
                    array2: obj8,
                    type: "login"
                }, function(data) {
                    $(".result").html(data);
                    head = [{
                        Text: "Homepage",
                        ImageUrl: "assets/images/server.png",
                        Value: "Folder",
                        Folder: []
                    }]

                    nav = {
                        ul: {
                            class: "main-navigation",
                            children: {}
                        }
                    };


                })




            }
            $(".ui-igtrialwatermark").remove();

            document.querySelector(".btn-add").onclick = function() {
                removeElem();
                var item2DataPath = $("[data-depth='1'] > li[data-path]:last-of-type").attr("data-path");
                console.log(item2DataPath);
                var obj2;
                if (item2DataPath == undefined) {
                    obj2 = "0.0";
                    console.log(obj2);
                } else {
                    var split = item2DataPath.split(".");
                    var obj3 = parseInt(split[1]) + parseInt(1);
                    obj2 = split[0] + "." + obj3;
                    console.log(obj2);
                }
                console.log($("#sitesList option:selected").text());
                addMenuItem(obj2, $("#sitesList option:selected").val(), $("#sitesList option:selected")
                    .text());
            }
            document.querySelector(".btn-add-indi").onclick = function() {
                removeElem();
                var input = $(".indi").val();
                var input2 = $(".indi-link").val();
                var item2DataPath = $("[data-depth='1'] > li[data-path]:last-of-type").attr("data-path");
                console.log(item2DataPath);
                var obj2;
                if (item2DataPath == undefined) {
                    obj2 = "0.0";
                    console.log(obj2);
                } else {
                    var split = item2DataPath.split(".");
                    var obj3 = parseInt(split[1]) + parseInt(1);
                    obj2 = split[0] + "." + obj3;
                    console.log(obj2);
                }
                addMenuItem(obj2, input2, input);
            }

            function removeElem() {
                $("li ").click(function() {
                    var li = $(this);
                    $("[data-depth='1'] >  li > a").click(function() {
                        var lenfht = $("[data-depth='1'] > li").length;
                    if (lenfht > 1) {
                        var path = $(this).attr("data-path");
                        li.remove();
                    }
                    }); 
                  

                })
            }
            removeElem();
        })
    </script>
    <style>
        img {
            width: 6%;
            display: none;
        }
    </style>
    <title>Add Menu</title>
</head>

<body>
    <?php
    include "templates/login/admin/nav.tpl.html";
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="containerTree">
                    <div id="left">
                        <h3>Menu login</h3>
                        <div class="firstTree"></div>
                    </div>

                </div>
            </div>
            <div class="col-md-6" style="margin-top:50px">
                <select name="sites" class="mdb-select md-form form-control" id="sitesList" style="outline:none !important">
                    <?php
                    $obj->readPagePropertiesInOption("siteName,siteLink", "login", "", "", "siteType")
                    ?>
                </select>

                <div class=" text-right" style="margin-top:20px">

                    <div class="" data-toggle="buttons">
                        <label class="btn btn-lg btn-success btn-add">
                            <input type="radio" name="options" id="option1" autocomplete="off" checked>
                            <i></i> Add
                        </label>

                    </div>
                </div>
                <br><br><br>
                Individual links:
                <input type="text" class="form-control indi " id="" placeholder="Name" name="siteName" value="">
                <input type="text" class="form-control indi-link " id="" placeholder="url" name="url" value="#">

                <div class=" text-right" style="margin-top:20px">

                    <div class="" data-toggle="buttons">
                        <label class="btn btn-lg btn-success btn-add-indi">
                            <input type="radio" name="options" id="option1" autocomplete="off" checked>
                            <i class=""></i> Add
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clicked right-corner text-right" style="margin-top:20px">

        <div class="" data-toggle="buttons">
            <label class="btn btn-lg btn-success ">
                <input type="radio" name="options" id="option1" autocomplete="off" checked>
                <i class=""></i> Save
            </label>
        </div>
    </div>

    <div class="result"></div>
    <script src="assets/js/master-admin.js"></script>
</body>

</html>