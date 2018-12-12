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
  .panel-body img {max-height:200px; min-height:200px;}
  .panel-footer {overflow:hidden; text-overflow:ellipsis; white-space: nowrap; text-align: center;}
  .carousel-inner > .item > img {
    margin: 0 auto;
}
  </style>
</head>
<body>
<?php 
$coutdata = "SELECT * FROM product";
$coutdataresult = mysqli_query($link, $coutdata);
$count = mysqli_num_rows($coutdataresult);

if($count < 6){
  $showpanel = "SELECT * FROM product WHERE issold = '0' ORDER  BY id DESC LIMIT ".$count;
}else{
  $showpanel = "SELECT * FROM product WHERE issold = '0' ORDER  BY id DESC LIMIT 6 ";
}

$showpanel_query = mysqli_query($link, $showpanel);

$showpanel_rows = array();

while($showpanel_row = mysqli_fetch_array($showpanel_query)) $showpanel_rows[] = $showpanel_row;
//--------------------------------------------------------------------------------------------------
function make_query($link)
{
  $coutcaro = "SELECT * FROM product";
  $coutcaroresult = mysqli_query($link, $coutcaro);
  $slides = mysqli_num_rows($coutcaroresult);

 if($slides < 3){
  $query = "SELECT id,name,pic FROM product WHERE issold = '0' ORDER BY RAND() limit ".$slides;
}else{
  $query = "SELECT id,name,pic FROM product WHERE issold = '0' ORDER BY RAND() limit 3";
}
 $result = mysqli_query($link, $query);
 return $result;
}

function make_slide_indicators($link)
{
 $output = ''; 
 $count = 0;
 $result = make_query($link);
 while($row = mysqli_fetch_array($result))
 {
  if($count == 0)
  {
   $output .= '
   <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'" class="active"></li>
   ';
  }
  else
  {
   $output .= '
   <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'"></li>
   ';
  }
  $count = $count + 1;
 }
 return $output;
}

function make_slides($link)
{
 $output = '';
 $count = 0;
 $result = make_query($link);
 while($row = mysqli_fetch_array($result))
 {
  if($count == 0)
  {
   $output .= '<div class="item active">';
  }
  else
  {
   $output .= '<div class="item">';
  }
  $itemlink = "detail.php?id=".$row["id"];
  $output .= '
   <img src="pics/'.$row["pic"].'" alt="'.$row["name"].'" style="max-height:350px; min-height:350px;"/>
   <div class="carousel-caption" style="background: rgba(0%,10%,20%,0.4);-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;">
    <h3><b><a href='.$itemlink.' style="color:white;">'.$row["name"].'</a></b></h3>
   </div>
  </div>
  ';
  $count = $count + 1;//#99CC00
 }
 return $output;
}

?>
<br/>

<div class="container">
  <div class="row clearfix">
    <div class="col-md-12 column">
      <div id="Carousel" class="carousel slide">
        <!-- Carousel -->
        <ol class="carousel-indicators">
          <!--
          <li data-target="#Carousel" data-slide-to="0" class="active"></li>
          <li data-target="#Carousel" data-slide-to="1"></li>
          <li data-target="#Carousel" data-slide-to="2"></li>
        -->
        <?php echo make_slide_indicators($link); ?>
        </ol>   
        <!-- Carousel -->
        <div class="carousel-inner">
          <?php echo make_slides($link); ?>
          <!--
          <div class="item active">
            <img src="default.jpg" alt="First slide">
            <div class="carousel-caption" style="background: rgba(0%,10%,20%,0.2);-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;">
              <h4></h4>
              
            </div>
          </div>
          <div class="item">
            <img src="default1.jpg" alt="Second slide">
            <div class="carousel-caption"style="background: rgba(0%,10%,20%,0.2);-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;">  
              <h4><?php echo $carousel_row["id"]; ?></h4>
              
            </div>
          </div>
          <div class="item">
            <img src="default2.jpg" alt="Third slide">
            <div class="carousel-caption"style="background: rgba(0%,10%,20%,0.2);-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;">
              <h4>Title 3</h4>
              
            </div>
          </div>-->
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
    <?php foreach($showpanel_rows as $showpanelrow){ ?>
    <div class="col-sm-4">
      <div class="panel panel-danger">
        <div class="panel-heading">New Arrival</div>
        <div class="panel-body"><img src="pics/<?php echo $showpanelrow["pic"]; ?>" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer"><a href="detail.php?id=<?php echo $showpanelrow["id"]; ?>"><?php echo $showpanelrow["name"]; ?></a></div>
      </div>
    </div>
  <?php } ?>
  </div>
</div><br>
<!--
<footer class="container-fluid text-center">
  <p>Online Store Copyright</p>  
  <form class="form-inline">Get deals:
    <input type="email" class="form-control" size="50" placeholder="Email Address">
    <button type="button" class="btn btn-danger">Sign Up</button>
  </form>
</footer>
-->
</body>
</html>
