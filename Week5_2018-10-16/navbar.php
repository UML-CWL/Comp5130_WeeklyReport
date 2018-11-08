<!DOCTYPE html>
<html>
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Bootstrap -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      
   </head>
   <body>
    <style>
         /* Remove the navbar's default rounded borders and increase the bottom margin */ 
         .navbar {
           margin-bottom: 50px;
           border-radius: 0;
          }
    </style>
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
              <li class="active"><a href="./"><span class="glyphicon glyphicon-home"></span> Home</a></li>
              <li><a href="#">Products</a></li>
              <li><a href="#"><span class="glyphicon glyphicon-send"></span> Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right" id="nvbrright">
              <li><a href="#" ><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
              <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
            
              <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
            </ul>
          </div>
        </div>
      </nav>
      <br/>
      <br/>
   </body>
</html>