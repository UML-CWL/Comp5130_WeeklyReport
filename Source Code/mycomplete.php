<!DOCTYPE html>
<html lang="en">
<head>
  <title>Account Dashboard - Bought Items</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  #bot_order, #sol_order {overflow: auto; max-height: 300px;min-height: 300px;}
  .tdlimited {width: 40%;}
  </style>
</head>
<body>
<?php
require("config.php");
require("navbar.php");
?>
<br/>
<?php if(!isset($_SESSION['loginUser'])){  
  require("notlogin.php");
 }else{ ?>
<?php 
  $usr = $_SESSION['loginUser'];

  $sold = "SELECT * FROM buy WHERE seller = '".$usr."' AND status = '4' ORDER BY order_time DESC ";
  $bought = "SELECT * FROM buy WHERE buyer = '".$usr."' AND status = '4' ORDER BY order_time DESC ";

  $sellingresult = mysqli_query($link, $sold);
  $buyingresult = mysqli_query($link, $bought);
  
  $selling_rows = array();
  $buying_rows = array();

  while($selling_row = mysqli_fetch_array($sellingresult)) $selling_rows[] = $selling_row;
  while($buying_row = mysqli_fetch_array($buyingresult)) $buying_rows[] = $buying_row;
?>
<div class="container">
  <?php require("myside.php");?>
  <script>
    $('#myside li:eq(2) a').tab('show');
  </script>
  <div class="col-sm-9">
    <h4>Completed Orders</h4>
    <hr>
    <h2>Sold</h2>
    <div id="sol_order">
      <?php if(!mysqli_num_rows($sellingresult)){?>
        <h3 class="text-center">There is no data so far.</h3>
      <?php }else{ ?>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>OrderID</th>
              <th>Item</th>
              <th>Buyer</th>
              <th>Price</th>
              <th>Order Time</th>
              <th>Completed At</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($selling_rows as $sellrow){ ?>
              <tr>
                <td><?php echo $sellrow["orderid"]; ?></td>
                <td class="tdlimited"><?php echo $sellrow["item"]; ?></td>
                <td><?php echo $sellrow["buyer"]; ?></td>
                <td><?php echo $sellrow["price"]; ?></td>
                <td><?php echo $sellrow["order_time"]; ?></td>
                <td><?php echo $sellrow["final_time"]; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php } ?>
    </div>
    <h2>Bought</h2>
    <div id="bot_order">
      <?php if(!mysqli_num_rows($buyingresult)){?>
        <h3 class="text-center">There is no data so far.</h3>
      <?php }else{ ?>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>OrderID</th>
              <th>Item</th>
              <th>Seller</th>
              <th>Price</th>
              <th>Order Time</th>
              <th>Completed At</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($buying_rows as $buyingrow){ ?>
              <tr>
                <td><?php echo $buyingrow["orderid"]; ?></td>
                <td class="tdlimited"><?php echo $buyingrow["item"]; ?></td>
                <td><?php echo $buyingrow["seller"]; ?></td>
                <td><?php echo $buyingrow["price"]; ?></td>
                <td><?php echo $buyingrow["order_time"]; ?></td>
                <td><?php echo $buyingrow["final_time"]; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php } ?>
    </div>  
  </div><!-- end col-sm-9 -->
</div>
<?php } ?>
<br/>
<br/>

</body>
</html>
