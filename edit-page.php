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
    <script src="assets/js/emmet.js"></script>
    <script src="assets/js/library.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
   
    <title>Add Site</title>
    <script src='http://lovasoa.github.io/tidy-html5/tidy.js'></script>
<script>
  options = {
  "indent":"auto",
  "indent-spaces":2,
  "wrap":80,
  "markup":true,
  "output-xml":false,
  "numeric-entities":true,
  "quote-marks":true,
  "quote-nbsp":false,
  "show-body-only":true,
  "quote-ampersand":false,
  "break-before-br":true,
  "uppercase-tags":false,
  "uppercase-attributes":false,
  "drop-font-tags":true,
  "tidy-mark":false
}

  var html = $("textarea").html;
var result = tidy_html5(html, options);
console.log(result);


</script>
</head>
<body>
    <?php
        if(isset($_SESSION["login"]) && $_SESSION["login"] == "adminLogin"){
            $obj = new ForEx();
            include "templates/login/admin/nav.tpl.html";
            ?>
            <div class="container">
            <form action="" method="post">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationServer01">Site name</label>
      <input type="text" class="form-control is-valid" id="validationServer01" placeholder="Site name" name="siteName" value="<?php echo $obj->readPageProperties("siteName",$_GET["id"]); ?>" required>
      
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationServer02">Perma Link</label>
      <input type="text" class="form-control is-valid" id="validationServer02" placeholder="perma link" name="siteLink" value="<?php echo $obj->readPageProperties("siteLink",$_GET["id"]); ?>" readonly>
    
    </div>
    
    <div class="form-group col-md-4">
      <label for="inputState">Type</label>
      <select id="inputState" name="type" class="form-control">
        <option value="<?php echo $obj->readPageProperties("siteType",$_GET["id"]); ?>" selected><?php echo $obj->readPageProperties("siteType",$_GET["id"]); ?></option>
        <option value="login">Logged in</option>
        <option value="logout">Logged out</option>
      </select>
    </div>
  </div>
  <div class="row sdf siteContent">
      <div class="col-md-8">
      <div class="form-group">
    <label for="comment">Push Tab to auto completes! <br>Input:</label>
    <textarea class="form-control" rows="20" cols="100" style="overflow:scroll;" id="comment" name="siteInput" value=""><?php echo $obj->readPageProperties("siteInput",$_GET["id"],$_GET["type"],$_GET["siteLink"]); ?></textarea>
    <script>
      window.onload = function(){
        
		emmet.require('textarea').setup({
			pretty_break: true, // enable formatted line breaks (when inserting 
					            // between opening and closing tag) 
      use_tab: true       // expand abbreviations by Tab key
      
    });
    $.ctrl = function(key, callback, args) {
    var isCtrl = false;
    $(window).keydown(function(e) {
        if(!args) args=[]; // IE barks when args is null
        
        if(e.ctrlKey) isCtrl = true;
        if(e.keyCode == key.charCodeAt(0) && isCtrl) {
            callback.apply(this, args);
            return false;
        }
    }).keyup(function(e) {
        if(e.ctrlKey) isCtrl = false;
    });        
    $.ctrl('s', function() {
    alert("Saved");
});
};
      }
	</script>  
  </div>
    <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      <div class="form-group col-md-4">
      <label for="inputState">File type</label>
      <select id="inputState" name="fileType" class="form-control">
      <?php
  if($_GET["fileType"] == "php"){
    ?>
<option value="php" selected>PHP</option>
<option value="html">HTML</option>
    <?php
  }else if($_GET["fileType"] == "html"){
    ?>
<option value="php" >PHP</option>
<option value="html"selected>HTML</option>
    <?php
  }

?>
        
        
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">Assets include</label>
      <select id="inputState" name="fileAssets[]" class="form-control fileAssets" multiple>
       <?php
        $obj = new ForEx();
        $obj->readAssetsOption();
      ?>
      </select>
      <script>
      function GetURLParameter(sParam)
{
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++)
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam)
        {
            return sParameterName[1];
        }
    }
}


var assetsALL = GetURLParameter("assets");
var assetsAllSplit = assetsALL.split(",");
for(var i = 0;i <= assetsAllSplit.length-1;i++){
  var allSelectOption = $(".fileAssets option");
  for(var s = 0;s <= allSelectOption.length-1;s++){
    if(allSelectOption[s].getAttribute("value") == assetsAllSplit[i]){
   
      allSelectOption[s].setAttribute("selected","");
    }
  }
}
      </script>
        </form>
  </div>
  <?php
    if(isset($_POST["siteName"])){
        $obj = new ForEx();
        $all = "";
        $var5 = @implode(",",$_POST["fileAssets"]);

        $obj->editPage($_GET["id"],$_POST["siteName"],$_POST["siteLink"],$_POST["type"],$_POST["fileType"],$_POST["siteInput"],$var5);
    }
  ?>   
  </div>

            <?php
        }else{
            header("Location:login.php");
        }

    ?>
    <script src="assets/js/master-admin.js"></script>
</body>
</html>