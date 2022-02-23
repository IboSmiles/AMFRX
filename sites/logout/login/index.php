<link rel="stylesheet" href="assets/css/form.css">
<div class="wrapper ">
    <div id="formContent">
        <!-- Tabs Titles -->
        <!-- Icon -->
        <div class="fadeIn before">
            <img src="Logo_SVG.svg" class="imgForm" id="icon" width="20%" alt="User Icon" />
        </div>

        <!-- Login Form -->
        <form action="" method="post">
            <input type="text" id="login"  name="login" placeholder="Userid">
            <input type="text" id="password"  name="pw" placeholder="Password">
            <input type="submit"  value="Log In">
        </form>

        <!-- Forhot Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="#">Forgot Password?</a>
        </div>

    </div>
</div>
<?php
if(isset($_POST["login"])){
$obj = new ForEx();
    $obj->userLogin($_POST["login"],$_POST["pw"]);
}
?>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>