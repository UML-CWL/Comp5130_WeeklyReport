<!DOCTYPE html>
<html>
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- 引入 Bootstrap -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <style>
         /* Remove the navbar's default rounded borders and increase the bottom margin */ 
         .navbar {
           margin-bottom: 50px;
           border-radius: 0;
          }
      </style>
   </head>
   <body>
    
      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#Navbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>                        
            </button>
            <a class="navbar-brand" href="./">Pre-Own Shop</a>
          </div>
          <div class="collapse navbar-collapse" id="Navbar">
            <ul class="nav navbar-nav" id="nvbrleft">
              <li><a href="./"><span class="glyphicon glyphicon-home"></span> Home</a></li>
              <li><a href="product.php"><span class="glyphicon glyphicon-shopping-cart"></span> Products</a></li>
              <li style="font-size: 20px;"><a href="#">By Cheng Wei Liao</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right" id="nvbrright">
              <script type="text/javascript">
                var path = location.pathname;
                var search = location.search;
                var url = path + search;
              </script>
            <?php if(!isset($_SESSION['loginUser'])){ ?>
              <li><a href="javascript:;" onclick="javascript:if(!(path.split(/(\\|\/)/g).pop() == 'reg.php'))location.href='reg.php?redirect='+ url+'#in';"><span class="glyphicon glyphicon-log-in"></span> Log In</a></li>
              <li><a href="javascript:;" onclick="javascript:if(!(path.split(/(\\|\/)/g).pop() == 'reg.php'))location.href='reg.php?redirect='+ url+'#up';"> Sign Up</a></li>
            <?php }else{ ?>
              <li class="navbar-text" style="color:white;">Hello, <?php echo $_SESSION['loginUser']; ?></li>
              <li><a href="sell.php"><span class="glyphicon glyphicon-upload"></span> Sell</a></li>
              <li><a href="chat.php"><span class="glyphicon glyphicon-send"></span> Chat</a></li>
              <li><a href="my.php"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
              <li><a href="javascript:;" onclick="javascript:location.replace('logout.php');"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
            <?php } ?>
            <!--
              <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
            -->
            </ul>
          </div>
        </div>
      </nav>
      <br/>
      <br/>
   </body>
</html>