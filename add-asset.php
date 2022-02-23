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
    <title>Add Site</title>
</head>
<body>
    <?php
        if(isset($_SESSION["login"]) && $_SESSION["login"] == "adminLogin"){
            include "templates/login/admin/nav.tpl.html";
            ?>
            <div class="container">
            <form action="" method="post">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationServer01">File name</label>
      <input type="text" class="form-control is-valid" id="validationServer01" placeholder="File name" name="fileName" value="" required>
      
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationServer02">Src Link</label>
      <input type="text" class="form-control is-valid" id="validationServer02" placeholder="Src link" name="srcLink" value="" required>
    
    </div>
    
    <div class="form-group col-md-4">
      <label for="inputState">File Type</label>
      <select id="inputState" name="fileType" class="form-control">
        <option value="css" selected>Choose...</option>
        <option value="css">CSS</option>
        <option value="js">JavaScript</option>
      </select>
    </div>
  </div>
  <div class="row sdf siteContent">
      <div class="col-md-8">
      <div class="form-group">
    <label for="comment">Push Tab to auto complete! <br>Input:</label>
    <textarea class="form-control" rows="5" cols="40" id="comment" name="fileInput"></textarea>
    <script>
		emmet.require('textarea').setup({
			pretty_break: true, // enable formatted line breaks (when inserting 
					            // between opening and closing tag) 
			use_tab: true       // expand abbreviations by Tab key
		});
	</script> 
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
      </div>
   
        </form>
  </div>
  <?php
    if(isset($_POST["fileName"])){
        $obj = new ForEx();
        $obj->addAsset($_POST["fileName"],$_POST["srcLink"],$_POST["fileType"],$_POST["fileInput"]);
    }
  ?>   
  </div>

            <?php
        }else{
            header("Location:login.php");
        }

    ?>
</body>
</html>