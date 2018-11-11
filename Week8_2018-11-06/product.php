<?php
require("config.php");
require("navbar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pre-Own Shop</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  </style>
</head>
<body>
<br/>
<br/>

<div class="container">
  <div class="row">
      <h2>Product</h2>
      <?php for($i=0;$i<9;$i++){ ?>
      <div class="col-sm-6 col-md-4">
          <div class="thumbnail">
              <img src="kittens.jpg" alt="Thumbnail">
              <div class="caption">
                  <h3>Title</h3>
                  <p>Description</p>
                  <p>
                      <a href="#" class="btn btn-primary" role="button">
                          Btn
                      </a>
                      <a href="#" class="btn btn-default" role="button">
                          Btn
                      </a>
                  </p>
              </div>
          </div>
      </div>
      <?php } ?>
  </div>
</div>
<br/>
</body>
</html>
