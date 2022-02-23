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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="assets/js/library.js"></script>
    <script src="assets/js/master-admin.js"></script>
    <title>Add and Delete Sites</title>
</head>

<body>
    <?php
    if (isset($_SESSION["login"]) && $_SESSION["login"] == "adminLogin") {
        include "templates/login/admin/nav.tpl.html";
        ?>
    <div class="container">
        <div class="row">

            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>

                <div class='box-part text-center'>

                    <i class='fas fa-bars' style='font-size:40px' aria-hidden='true'></i>

                    <div class='title'>
                        <h4>Menu</h4>
                    </div>

                    <div class='text'>
                        <span>Lorem ipsum dolor sit amet, id quo eruditi eloquentiam. Assum decore te sed. Elitr scripta
                            ocurreret qui ad.
                        </span>
                    </div>

                    <a href='menu-login.php'>Edit Menu</a>
                    <div class='footer'> <span class='siteType'><b>Login</b></span></div>
                </div>
            </div>
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>

                <div class='box-part text-center'>

                    <i class='fas fa-bars' style='font-size:40px' aria-hidden='true'></i>

                    <div class='title'>
                        <h4>Menu</h4>
                    </div>

                    <div class='text'>
                        <span>Lorem ipsum dolor sit amet, id quo eruditi eloquentiam. Assum decore te sed. Elitr scripta
                            ocurreret qui ad.
                        </span>
                    </div>

                    <a href='menu-logout.php'>Edit Menu</a>
                    <div class='footer'> <span class='siteType'><b>Logout</b></span></div>
                </div>
            </div>


        </div>

    </div>

    <?php
} else {
    header("Location:login.php");
}
?>
</body>

</html>