<!DOCTYPE html>
<html lang="en">
<head>
  <title>Chat</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  hr.style-one {border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0));}
  /* bubble style */
  .sender{clear:both;}
  .sender div:nth-of-type(1){float: left;}
  .sender div:nth-of-type(2){background-color: aquamarine; float: left; margin: 0 20px 10px 10px; padding: 10px 10px 10px 10px; border-radius:7px;}
  .receiver div:first-child img,.sender div:first-child img{width:40px; height: 40px;}
  .receiver{ clear:both;}
  .receiver div:nth-child(1){float: right;}
  .receiver div:nth-of-type(2){float:right; background-color: gold; margin: 0 10px 10px 20px; padding: 10px 10px 10px 10px; border-radius:7px;}
  .left_triangle{height:0px;width:0px; border-width:8px; border-style:solid; border-color:transparent aquamarine transparent transparent;  position: relative; left:-25px; top:3px;}
  .right_triangle{height:0px;width:0px; border-width:8px; border-style:solid; border-color:transparent transparent transparent gold; position: relative; right:-25px; top:3px;}
  #chat_content {overflow: auto; max-height: 430px;min-height: 430px;}
  </style>
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
?>
<script>
  var path = location.pathname;
  var search = location.search;
  var url = path + search;
  setTimeout(function () {
    location.replace('reg.php?redirect='+ url+'#in'); 
  }, 2000);
</script>
<?php }else{ ?>

<div class="container">
  <?php require("chatside.php");?>
  <?php if(isset($_GET['rcv'])){ ?>
  <?php 
    $rcv=$_GET['rcv'];
    $snd=$_SESSION['loginUser'];
    $chat = "SELECT * FROM chat WHERE (sender ='".$snd."' and receiver = '".$rcv."') or (receiver ='".$snd."' and sender ='".$rcv."')";
    $chatresult = mysqli_query($link, $chat);
    //$chat_row = mysqli_fetch_array($chatresult);
    $chat_rows = array();
    while($chat_row = mysqli_fetch_array($chatresult)) $chat_rows[] = $chat_row;
  ?>
  <div class="col-sm-9">
    <h4>Chat With <?php echo $rcv; ?></h4>
    <hr class="style-one"/>
    <div id="chat_content">    
    <?php foreach($chat_rows as $chat_row){ ?>
      
      <?php if($chat_row["sender"] == $rcv){?>
      <div class="sender">  
        <div>
          <img src="<?php echo 'https://ui-avatars.com/api/?background=FF9933&color=fff&rounded=true&name='.$rcv; ?>">
        </div>
        <div>
          <div class="left_triangle"></div>
          <span><?php echo nl2br($chat_row["content"]);?></span>
          <br/>
          <span>@<?php echo $chat_row["time"];?></span>
        </div>

      </div>
      <?php }else{?>
      <div class="receiver"> 
        <div>
          <img src="<?php echo 'https://ui-avatars.com/api/?background=3399FF&color=fff&rounded=true&name='.$snd; ?>">
        </div>
        <div>
          <div class="right_triangle"></div>
          <span><?php echo nl2br($chat_row["content"]); ?></span>
          <br/>
          <span>@<?php echo $chat_row["time"];?></span>
        </div>
      </div>
      <?php }?>
     <?php } ?>
    </div>
    <div id="form" >
      <br/>
      <form name= "chat" >
          <!--<input id = "input" type ="textarea" name="content" style="width: 480px; height:50px; margin:5px;border:0;padding:0;" >-->
        <textarea class="form-control" rows="3" id="chat_input" name="chat_input"></textarea>
        <input type = "hidden" name="sender" id="sender" value ="<?php echo $snd; ?>">
        <input type = "hidden" name="receiver" id="receiver" value = "<?php echo $rcv; ?>">
        <button type="button" class="btn btn-primary" id="chatbtn" style="float:right">Send</button>
      </form>
      <script>
        if($("#receiver").val() == $("#sender").val()){
          $('#chat_input').prop('disabled', 'disabled');
          $('#chat_input').prop('placeholder', 'Cannot meesage to yourself');
          $('#chatbtn').prop('disabled', 'disabled');
        }
        $('#chatbtn').click(function() {
          var snd = $("#sender").val();
          var rcv = $("#receiver").val();
          var content = $("#chat_input").val();
          if(content){
            $.post("hi.php",{act:"chat", sender:snd, receiver:rcv, content:content},function(msg){ 
              if(msg == 1){
                $("#chat_input").val('');
                $("#chat_content").load(location.href + " #chat_content");
                $("#chatside").load(location.href + " #chatside");
              }else{
                alert("Send message error, please try again later.");
              }
            });
          }else{
            alert("Write something in content!");
          }
        });
        $("#chat_content").scrollTop($("#chat_content")[0].scrollHeight);
      </script>
    </div>
    <br/>
  </div><!-- end col-sm-9 -->
  <?php } ?>
</div>
<?php } ?>
<br/>
<br/>

</body>
</html>
