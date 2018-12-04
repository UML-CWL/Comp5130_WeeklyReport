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
  $chatlist = "(SELECT receiver FROM chat WHERE sender='".$sndlist."') UNION (SELECT sender FROM chat WHERE receiver='".$sndlist."')";
  $chatlsresult = mysqli_query($link, $chatlist);
  $chatls_rows = array();
  while($chatls_row = mysqli_fetch_array($chatlsresult)) $chatls_rows[] = $chatls_row;
?>
  
  <div class="col-sm-3 sidenav">
    <h1>Chat</h1>
    <ul class="nav nav-pills nav-stacked" id="chatside">
      <?php foreach($chatls_rows as $chatls_row){ ?>
      <li><a id="<?php echo $chatls_row["receiver"]; ?>" href="?rcv=<?php echo $chatls_row["receiver"]; ?>"><?php echo $chatls_row["receiver"]; ?></a></li>
      <?php } ?>
    </ul><br>
  </div>
</body>
</html>
