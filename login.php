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
  <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="assets/css/form.css">
  <title>Login</title>
</head>

<body>

  <div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->

      <!-- Icon -->
      <div class="fadeIn before">
        <img src="Logo_SVG.svg" id="icon" alt="User Icon" />
      </div>

      <!-- Login Form -->
      <form action="" method="post">
        <input type="text" id="login" class="fadeIn second" name="login" placeholder="Userid">
        <input type="text" id="password" class="fadeIn third" name="pw" placeholder="Password">
        <input type="submit" class="fadeIn fourth" value="Log In">
      </form>

      <!-- Forhot Passowrd -->
      <div id="formFooter">
        <a class="underlineHover" href="#">Forgot Password?</a>
      </div>

    </div>
  </div>
  <?php
  if (isset($_POST["login"])) {

    $obj = new ForEx();
    $obj->adminLogin($_POST["login"], $_POST["pw"]);
  }
  ?>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>