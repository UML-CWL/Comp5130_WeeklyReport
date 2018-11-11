<?php
require("config.php");
require("navbar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Selling</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="pwdcheck.js"></script>
  <style>
  </style>
</head>
<body>
<br/>
<?php if(!isset($_SESSION['loginUser'])){ 
  require("notlogin.php");
?>
<script>
  var path = location.pathname;
  var search = location.search;
  var url = path + search;
  setTimeout(function () {
    location.replace('reg.php?redirect='+ url+'#in'); 
  }, 2000);
</script>
<?php }else{ ?>
<div class="container" style="">
    <div id="sell">
      <div class="row">
        <div class="col-md-5 col-md-offset-3 column">
          <h2>Enter Selling Product Information</h2> 
          <form role="form" id="sellform" method="post" action="">
            
            <div class="form-group">
              <span style="color:red">*</span><label for="pro_name">Product Name</label> <span id="pro_namewarn" style="background: rgba(0%,10%,20%,0.1);-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px; color:#CC6600; font-weight:bold;"></span><input type="text" class="form-control" id="pro_name" name="pro_name"/>
            </div>
            <div class="form-group">
              <span style="color:red">*</span><label for="pro_des">Product Description</label> <span id="pro_deswarn" style="background: rgba(0%,10%,20%,0.1);-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px; color:#CC6600; font-weight:bold;"></span><textarea class="form-control" rows="3" id="pro_des" name="pro_des"></textarea>
            </div>
            <div class="row">
              <div class="col-lg-3">
                <span style="color:red">*</span><label for="quantity">Quantity</label> <span id="quantitywarn"></span><input type="text" class="form-control" id="quantity" name="quantity" />
              </div>
              <div class="col-lg-3">
                <span style="color:red">*</span><label for="price">Price</label><span id="pricewarn"></span><input type="text" class="form-control" id="price" name="price"/>
              </div>
              <div class="col-lg-6">
                <label for="state">Type</label>
                <select class="form-control" id="type" name="type">
                </select>
              </div>
            </div>
            <br/>
            <div class="form-group">
              <span style="color:red">*</span><label for="pic">Upload photo</label> <span id="picwarn" style="background: rgba(0%,10%,20%,0.1);-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px; color:#CC6600; font-weight:bold;"></span><input type="file" id="pic">
            </div>
            <input type="hidden" class="form-control" id="username" name="username" value="<?php echo $_SESSION['loginUser'];?>"/>
            <br/>
            <!--<button type="submit" class="btn btn-default">Submit</button>-->
            <input type="button" class="btn btn-primary btn-block" value="Next" data-toggle="modal"  id ="sgnupsubmit" disabled="disabled"/>

          </form>
        </div>
      </div>
    </div><!-- sell -->
</div><!-- Container -->
<?php } ?>
<br>

</body>
</html>
