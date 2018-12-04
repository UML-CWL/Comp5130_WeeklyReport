<?php
if(!isset($_GET['id'])){
header("Location:product.php");
exit;
}else{
  $id = $_GET['id'];
}
require("config.php");
require("navbar.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Product Detail</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  img{
    max-height:350px;
    myheight:expression(onload=function(){ this.style.height=(this.offsetheight > 350)?'350px':'auto'});
  }
  .jumbotron {margin-bottom: 0; text-align : center;}
  .offerbtn{cursor:pointer;outline:none;border-radius:0.25rem;-webkit-appearance:none;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;display:-webkit-inline-box;display:-moz-inline-box;display:-ms-inline-flexbox;display:-webkit-inline-flex;display:inline-flex;font-weight:600;background-color:#00ab80;border:1px solid #00ab80;border-bottom-color:#009770;color:#ffffff;padding:8px 20px;font-size:20px;line-height:26px;}
  .offerbtn:disabled{opacity:.65;pointer-events:none;}
  .offerbtn:hover{background-color:#009770;border-color:#009770;}
  .offerbtn:focus{border-color:#009770;}
  .offerbtn:active{background-color:#008765;}
  .askbtn{cursor:pointer;outline:none;border-radius:0.25rem;-webkit-appearance:none;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;display:-webkit-inline-box;display:-moz-inline-box;display:-ms-inline-flexbox;display:-webkit-inline-flex;display:inline-flex;font-weight:600;background-color:#ffffff;border:1px solid #00ab80;color:#00ab80;padding:8px 20px;font-size:20px;line-height:26px;}
  .askbtn:disabled{opacity:.65;pointer-events:none;}
  .askbtn:hover{background-color:rgba(0, 171, 128, 0.1);}
  .askbtn:active{background-color:rgba(0, 151, 112, 0.1);}
  hr.style-one {border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0));}
  .sellerarea{position:relative;border:1px solid #d8d8d8;border-radius:6px;padding:16px;background-color:white;}
  </style>
</head>
<body>
<?php 
  $product = "SELECT * FROM product WHERE id = ".$id;
  $productresult = mysqli_query($link, $product);
  $product_row = mysqli_fetch_array($productresult);
  $sellername = $product_row["seller"];
  
  $seller = "SELECT city,state FROM account WHERE username = '".$sellername."'";
  $sellerresult = mysqli_query($link, $seller);
  $seller_row = mysqli_fetch_array($sellerresult);
?>
<br/>
<br/>
<div class="jumbotron">
  <img src="pics/<?php echo $product_row['pic']; ?>"/>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-offset-3">
      <div class="media-left" style="color:green; font-size:38px;">$<?php echo $product_row["price"]; ?></div>
      <div class="media-body" style=" font-size:27px;"><?php echo $product_row["name"]; ?></div>
    </div>
    <div class="col-md-offset-3">
      <div class="col-md-8">
        <div style=" font-size:20px;"><?php echo $seller_row["city"]; ?>, <?php echo $seller_row["state"]; ?></div>
        <div style=" font-size:20px;">Posted: <?php echo $product_row["time"]; ?></div>
        <span class="label label-default"><?php echo $product_row["category"]; ?></span>
      </div>
      <div class="media-right">
        <div class="sellerarea">
          <p style=" font-size:20px;">Seller: <?php echo $product_row["seller"]; ?>
          <input type = "hidden" name="seller" id="seller" value ="<?php echo $product_row["seller"]; ?>">
          <input type = "hidden" name="acc" id="acc" value ="<?php echo $_SESSION['loginUser'] ?>">
          <button type="button" id="sellermsgbtn" class="btn btn-primary btn-xs">Message</button></p>
          <form class="form-inline">
            <button type="button" class="askbtn">Make Offer</button>
            <button type="button" class="offerbtn">Buy</button>
          </form>
        </div>
      </div>
      <hr class="style-one"/>
    </div>
    <div class="col-md-offset-3">
      <div style=" font-size:20px;"><?php echo nl2br($product_row["description"]); ?></div>
    </div>
  </div>
</div>
<script>
  $('#sellermsgbtn').click(function() {
    var seller = $('#seller').val();
    var acc = $('#acc').val();
    if(seller == acc){
      alert("You Cannot Message to Yourself !!");
    }else{
      alert("Passed");
    }
  });
</script>
<!--
<footer class="container-fluid text-center ">
  <p style=" font-size:20px;">Seller: <?php echo $product_row["seller"]; ?></p>  
  <form class="form-inline">
    <button type="button" class="askbtn">Ask</button>
    <button type="button" class="offerbtn">Make Offer</button>
  </form>
</footer>-->
</body>
</html>
