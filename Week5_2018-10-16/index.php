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

<?php
require("config.php");
require("navbar.php");
?>
<br/>

<div class="container">
  <div class="row clearfix">
    <div class="col-md-12 column">
      <div id="Carousel" class="carousel slide">
        <!-- Carousel-->
        <ol class="carousel-indicators">
          <li data-target="#Carousel" data-slide-to="0" class="active"></li>
          <li data-target="#Carousel" data-slide-to="1"></li>
          <li data-target="#Carousel" data-slide-to="2"></li>
        </ol>   
        <!-- Carousel -->
        <div class="carousel-inner">
          <div class="item active">
            <img src="http://www.runoob.com/try/bootstrap/layoutit/v3/default.jpg" alt="First slide">
            <div class="carousel-caption" style="background: rgba(0%,10%,20%,0.2);-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;">
              <h4>Title 1</h4>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            </div>
          </div>
          <div class="item">
            <img src="http://www.runoob.com/try/bootstrap/layoutit/v3/default1.jpg" alt="Second slide">
            <div class="carousel-caption"style="background: rgba(0%,10%,20%,0.2);-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;">  
              <h4>Title 2</h4>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            </div>
          </div>
          <div class="item">
            <img src="http://www.runoob.com/try/bootstrap/layoutit/v3/default2.jpg" alt="Third slide">
            <div class="carousel-caption"style="background: rgba(0%,10%,20%,0.2);-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;">
              <h4>Title 3</h4>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            </div>
          </div>
        </div>
        <!-- Carousel -->
        <a class="left carousel-control" data-target="#Carousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" data-target="#Carousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
</div> 

<br/>



<div class="container">
  <div class="row">
      <div class="col-sm-6 col-md-4">
          <div class="thumbnail">
              <img src="http://www.runoob.com/wp-content/uploads/2014/06/kittens.jpg"
                   alt="Thumbnail">
              <div class="caption">
                  <h3>Thumbnail</h3>
                  <p>Text</p>
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
      
  </div>

  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">BLACK FRIDAY DEAL</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-danger">
        <div class="panel-heading">BLACK FRIDAY DEAL</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-success">
        <div class="panel-heading">BLACK FRIDAY DEAL</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
      </div>
    </div>
  </div>
</div><br>

<div class="container">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">BLACK FRIDAY DEAL</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">BLACK FRIDAY DEAL</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">BLACK FRIDAY DEAL</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
      </div>
    </div>
  </div>
</div><br><br>

</body>
</html>
