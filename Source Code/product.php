<?php
require("config.php");
require("navbar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Product List</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  .thumbnail img{max-height:200px; min-height:200px;}
  #title {overflow:hidden; text-overflow:ellipsis; white-space: nowrap; font-size: 20px; font-weight:bold;}
  </style>
</head>
<body>
<?php 
  $order = "SELECT * FROM product WHERE issold = '0' ORDER BY id ASC ";
  $rev_order = "SELECT * FROM product WHERE issold = '0' ORDER BY id DESC ";
  $price = "SELECT * FROM product WHERE issold = '0' ORDER BY price ASC, id ASC ";
  $rev_price = "SELECT * FROM product WHERE issold = '0' ORDER BY price DESC, id ASC ";

  $orderresult = mysqli_query($link, $order);
  $rev_orderresult = mysqli_query($link, $rev_order);
  $priceresult = mysqli_query($link, $price);
  $rev_priceresult = mysqli_query($link, $rev_price);
  
  $order_rows = array();
  $rev_order_rows = array();
  $price_rows = array();
  $rev_price_rows = array();

  while($order_row = mysqli_fetch_array($orderresult)) $order_rows[] = $order_row;
  while($rev_order_row = mysqli_fetch_array($rev_orderresult)) $rev_order_rows[] = $rev_order_row;
  while($price_row = mysqli_fetch_array($priceresult)) $price_rows[] = $price_row;
  while($rev_price_row = mysqli_fetch_array($rev_priceresult)) $rev_price_rows[] = $rev_price_row;
?>
<br/>
<br/>

<div class="container">
  <div class="row">
    <h2>Product</h2>
    <div class="col-sm-offset-10 col-sm-3">
      <ul class="nav nav-pills" id="product-sort">
        <li>
          <a data-target="#order" data-toggle="tab" class="btn" title="Sort by order"><span class="glyphicon glyphicon-sort-by-order"></span></a>
        </li>
        <li>
          <a data-target="#r_order" data-toggle="tab" class="btn" title="Sort by reverse order"><span class="glyphicon glyphicon-sort-by-order-alt"></span></a>
        </li>
        <li>
          <a data-target="#l_price" data-toggle="tab" class="btn" title="Lower price first"><span class="glyphicon glyphicon-usd"></span></a>
        </li>
        <li>
          <a data-target="#h_price" data-toggle="tab" class="btn" title="Higher price first"><span class="glyphicon glyphicon-usd"></span></a>
        </li>
      </ul>
    </div>
  </div>
  <div id="myTabContent" class="tab-content">
    <div class="tab-pane fade in active" id="order">
      <div class="row">
        <?php if(!mysqli_num_rows($orderresult)){?>
          <h3 class="text-center">There are no items so far.</h3>
        <?php }else{ ?>
        <?php foreach($order_rows as $orderrow){ ?>
        <div class="col-sm-6 col-md-4">
          <div class="panel">  
            <div class="thumbnail">
              <img src="pics/<?php echo $orderrow['pic']; ?>" alt="Thumbnail" >
              <div class="caption">
                  <h3 id="title"><?php echo $orderrow["name"]; ?></h3>
                  <p class="label label-success" style="background-color:#999900;">Seller: <?php echo $orderrow["seller"]; ?></p>
              </div>
              <div class="panel-footer">
                <p>
                  <a href="detail.php?id=<?php echo $orderrow["id"]; ?>" class="btn btn-primary" role="button">Detail</a>
                  <span style="color:green; font-size:25px; float:right;">$<?php echo $orderrow["price"]; ?></span>
                </p>
              </div>
            </div>
          </div>
        </div>
        <?php }} ?>
      </div>
    </div><!-- tab1 -->
    <div class="tab-pane fade" id="r_order">
      <div class="row">
        <?php if(!mysqli_num_rows($rev_orderresult)){?>
          <h3 class="text-center">There are no items so far.</h3>
        <?php }else{ ?>
        <?php foreach($rev_order_rows as $rev_orderrow){ ?>
        <div class="col-sm-6 col-md-4">
          <div class="panel">  
            <div class="thumbnail">
              <img src="pics/<?php echo $rev_orderrow['pic']; ?>" alt="Thumbnail">
              <div class="caption">
                  <h3 id="title"><?php echo $rev_orderrow["name"]; ?></h3>
                  <p class="label label-success" style="background-color:#999900;">Seller: <?php echo $rev_orderrow["seller"]; ?></p>
              </div>
              <div class="panel-footer">
                <p>
                  <a href="detail.php?id=<?php echo $rev_orderrow["id"]; ?>" class="btn btn-primary" role="button">Detail</a>
                  <span style="color:green; font-size:25px; float:right;">$<?php echo $rev_orderrow["price"]; ?></span>
                </p>
              </div>
            </div>
          </div>
        </div>
        <?php }} ?>
      </div>
    </div><!-- reverse order -->
    <div class="tab-pane fade" id="l_price">
      <div class="row">
        <?php if(!mysqli_num_rows($priceresult)){?>
          <h3 class="text-center">There are no items so far.</h3>
        <?php }else{ ?>
        <?php foreach($price_rows as $pricerow){ ?>
        <div class="col-sm-6 col-md-4">
          <div class="panel">  
            <div class="thumbnail">
              <img src="pics/<?php echo $pricerow['pic']; ?>" alt="Thumbnail">
              <div class="caption">
                  <h3 id="title"><?php echo $pricerow["name"]; ?></h3>
                  <p class="label label-success" style="background-color:#999900;">Seller: <?php echo $pricerow["seller"]; ?></p>
              </div>
              <div class="panel-footer">
                <p>
                  <a href="detail.php?id=<?php echo $pricerow["id"]; ?>" class="btn btn-primary" role="button">Detail</a>
                  <span style="color:green; font-size:25px; float:right;">$<?php echo $pricerow["price"]; ?></span>
                </p>
              </div>
            </div>
          </div>
        </div>
        <?php }} ?>
      </div>
    </div><!-- low price -->
    <div class="tab-pane fade" id="h_price">
      <div class="row">
        <?php if(!mysqli_num_rows($rev_priceresult)){?>
          <h3 class="text-center">There are no items so far.</h3>
        <?php }else{ ?>
        <?php foreach($rev_price_rows as $rev_pricerow){ ?>
        <div class="col-sm-6 col-md-4">
          <div class="panel">  
            <div class="thumbnail">
              <img src="pics/<?php echo $rev_pricerow['pic']; ?>" alt="Thumbnail">
              <div class="caption">
                  <h3 id="title"><?php echo $rev_pricerow["name"]; ?></h3>
                  <p class="label label-success" style="background-color:#999900;">Seller: <?php echo $rev_pricerow["seller"]; ?></p>
              </div>
              <div class="panel-footer">
                <p>
                  <a href="detail.php?id=<?php echo $rev_pricerow["id"]; ?>" class="btn btn-primary" role="button">Detail</a>
                  <span style="color:green; font-size:25px; float:right;">$<?php echo $rev_pricerow["price"]; ?></span>
                </p>
              </div>
            </div>
          </div>
        </div>
        <?php }} ?>
      </div>
    </div><!-- high price -->
  </div>
</div>
</body>
</html>
