<!DOCTYPE html>
<html lang="en">
<head>
  <title>chatside</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<?php 
  $sndlist=$_SESSION['loginUser'];
  $temp_sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `chatlist` (`ChatName` varchar(20) NOT NULL,`time` timestamp NOT NULL)";
  $temp_query = mysqli_query($link, $temp_sql);
  $chatlist_all = "INSERT INTO chatlist (ChatName,time) SELECT A.sender AS ChatName, A.time FROM chat A  INNER JOIN chat B ON A.receiver = B.sender AND B.sender = '".$sndlist."' UNION SELECT A.receiver AS ChatName, A.time FROM chat A INNER JOIN chat B ON A.sender = B.receiver AND B.receiver = '".$sndlist."' ORDER  BY time DESC";
  $chatlist_all_query = mysqli_query($link, $chatlist_all);
  $chatlist = "SELECT DISTINCT ChatName FROM chatlist";
  $chatlist_query = mysqli_query($link, $chatlist);
  $chatls_rows = array();
  while($chatls_row = mysqli_fetch_array($chatlist_query)) $chatls_rows[] = $chatls_row;
?>
  
  <div class="col-sm-3 sidenav">
    <h1>Chat</h1>
    <nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid"> 
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#chatlist">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse" id="chatlist">
        <ul class="nav nav-pills nav-stacked" id="chatside">
          <?php foreach($chatls_rows as $chatls_row){ ?>
          <li id="<?php echo $chatls_row["ChatName"]; ?>"><a href="?rcv=<?php echo $chatls_row["ChatName"]; ?>"><?php echo $chatls_row["ChatName"]; ?></a></li>
          <?php } ?>
          <?php if(isset($_GET['rcv'])){ $rcv = $_GET['rcv']; }else{ $rcv = 0; } ?>
          <input type = "hidden" name="chatid" id="chatid" value ="<?php echo $rcv; ?>">
          <script>
            $("#"+$("#chatid").val()).addClass('active');
          </script>
        </ul>
      </div>
      <script>
        var timeout = setInterval(reloadChat, 5000);    
        function reloadChat () {
          $("#chatside").load(location.href + " #chatside");
        }
      </script>
      </div>
    </nav>

    <!--
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#chatlist">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="chatlist">
      <ul class="nav nav-pills nav-stacked" id="chatside">
        <?php foreach($chatls_rows as $chatls_row){ ?>
        <li><a id="<?php echo $chatls_row["ChatName"]; ?>" href="?rcv=<?php echo $chatls_row["ChatName"]; ?>"><?php echo $chatls_row["ChatName"]; ?></a></li>
        <?php } ?>
      </ul><br>
    </div> --> 
  </div>
</body>
</html>
