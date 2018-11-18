<?php
require("config.php");
require("navbar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Selling</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="jquery.min.js"></script>
  <script src="jquery.form.js"></script>
  <script src="bootstrap.min.js"></script>
  <style>
    .upldpic{position: relative;overflow: hidden;margin-right: 4px;display:inline-block;*display:inline;padding:4px 10px 4px;font-size:14px;line-height:18px;*line-height:20px;color:#fff;text-align:center;vertical-align:middle;cursor:pointer;background:#337AB7;border:1px solid #cccccc;border-color:#e6e6e6 #e6e6e6 #bfbfbf;border-bottom-color:#b3b3b3;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;} 
    .upldpic input{position: absolute;top: 0; right: 0;margin: 0;border:solid transparent;opacity: 0;filter:alpha(opacity=0); cursor: pointer;}
    .upldprogress{position:relative; margin-left:100px; margin-top:-24px;width:200px;padding: 1px; border-radius:3px; display:none} 
    .bar {background-color: green; display:block; width:0%; height:20px;border-radius:3px; } 
    .percent{position:absolute; height:20px; display:inline-block;top:3px; left:2%; color:#fff } 
    .files{height:22px; line-height:22px; margin:10px 0} 
    .delimg{margin-left:20px; color:#090;}
  </style>
</head>
<body>
<br/>
<?php 
  if(!isset($_SESSION['loginUser'])){ 
    require("notlogin.php");
  }else{ ?>
<div class="container" style="">
    <div id="sell">
      <div class="row">
        <div class="col-md-5 col-md-offset-3 column">
          <h2>Enter Selling Product Information</h2>
          <div class="form-group" id="upldnotice"></div>
          <form role="form" id="sellform" method="post" action="">
            
            <div class="form-group">
              <span style="color:red">*</span><label for="pro_name">Product Name</label> <span id="pro_namewarn" style="background: rgba(0%,10%,20%,0.1);-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px; color:#CC6600; font-weight:bold;"></span><input type="text" class="form-control" id="pro_name" name="pro_name"/>
            </div>
            <div class="form-group">
              <span style="color:red">*</span><label for="pro_des">Product Description</label> <span id="pro_deswarn" style="background: rgba(0%,10%,20%,0.1);-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px; color:#CC6600; font-weight:bold;"></span><textarea class="form-control" rows="3" id="pro_des" name="pro_des"></textarea>
            </div>
            <div class="row">
              <div class="col-lg-3">
                <span style="color:red">*</span><label for="quantity">Quantity</label> <span id="quantitywarn"></span><input type="text" class="form-control" id="quantity" name="quantity" />
              </div>
              <div class="col-lg-3">
                <span style="color:red">*</span><label for="price">Price</label><span id="pricewarn"></span><input type="text" class="form-control" id="price" name="price"/>
              </div>
              <div class="col-lg-6">
                <label for="type">Type</label>
                <select class="form-control" id="type" name="type">
                  <option value="test">test</option>
                </select>
              </div>
            </div>
            <br/>
            <span style="color:red">*</span>
            <div class="form-group upldpic">
              <span>Upload photo</span> 
              <input type="file" id="pic" name="pic">
            </div>
            <input type="hidden" class="form-control" id="isfile" name="isfile" value="0"/>
            <input type="hidden" class="form-control" id="seller" name="seller" value="<?php echo $_SESSION['loginUser']; ?>"/>
            <span id="dl"></span>
              <div class="upldprogress"> 
                <span class="bar"></span><span class="percent">0%</span> 
              </div>
            <div class="files"></div> 
            <div id="showimg" class="img-thumbnail" style="display:none;"></div>
            <br/>
            <!--<button type="submit" class="btn btn-default">Submit</button>-->
            <input type="button" class="btn btn-primary btn-block" id ="sellsubmit" value="Submit" data-toggle="modal"  />
            <!--<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#sellmodal">Submit</button>-->

          
            <div class="modal fade" id="sellmodal" tabindex="-1" role="dialog" aria-labelledby="selllabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h4 class="modal-title" id="selllabel"></h4>
                  </div>
                  <div class="modal-body"></div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal -->
            </div>
          </form>
        </div>
        <script>
          $(function () { 
            var bar = $('.bar'); 
            var percent = $('.percent'); 
            var showimg = $('#showimg'); 
            var progress = $(".progress"); 
            var files = $(".files"); 
            var btn = $(".upldpic span"); 
            $("#pic").wrap("<form id='upld' action='action.php' method='post' enctype='multipart/form-data'></form>"); 
            $("#pic").change(function(){  
              if($(this).val() == ''){//file not selected
                return false;
              }
              $("#upld").ajaxSubmit({ 
                dataType:  'json', //json format data
                beforeSend: function() { //uploadiong 
                  showimg.empty(); //pic empty 
                  progress.show(); //show progess bar 
                  var percentVal = '0%'; //start from 0% 
                  bar.width(percentVal);  
                  percent.html(percentVal); 
                  btn.html("Uploading…");  
                }, 
                uploadProgress: function(event, position, total, percentComplete) { 
                  var percentVal = percentComplete+'%'; //get porgress 
                  bar.width(percentVal); //width of progress bar 
                  percent.html(percentVal); //show percentage 
                }, 
                success: function(data) { //sucess 
                  //get json data，include filename，size，and delete option 
                  files.html("<b>"+data.name+"("+data.size+"k)</b>");
                  $("#dl").html("<span class='delimg' rel='"+data.pic+"'>Click picture to delete</span>");
                  //show pic 
                  var img = "thumbs/"+data.pic; 
                  showimg.show();
                  showimg.html("<img src='"+img+"'/>"); 
                  btn.html("Upload photo");
                  $("#isfile").val(1);
                }, 
                error:function(xhr){ //fail 
                  btn.html("Upload Failed"); 
                  bar.width('0'); 
                  files.html(xhr.responseText); //show fail message 
                } 
              }); 
            });
            //Delete file
            showimg.on('click',function(){ 
              var con = confirm("Confirm deleting?");
              if(con){
                var pic = $(".delimg").attr("rel"); 
                $.post("action.php?act=delimg",{imagename:pic},function(msg){ 
                  if(msg==1){ 
                    files.html("Deleted Successful."); 
                    showimg.remove(); //file empty 
                    progress.hide(); //hide progress bar 
                    $("#isfile").val(0);
                  }else{ 
                    alert(msg); 
                  }
                });
              }
            }); 
          });
          $('#quantity,#price').on('input', function() {
            var number = $(this).val().replace(/[^\d]/g, '')
            $(this).val(number)
          });
          $('#sellsubmit').click(function() {
            if(!$("#pro_name").val() || !$("#pro_des").val() || !$("#quantity").val() || !$("#price").val() || $("#isfile").val() != 1){  
              $('#sellmodal').modal('show');
              var note='';
              if(!$("#pro_name").val()){note = '● Product Name </br>';}
              if(!$("#pro_des").val()){note += '● Product Description </br>';}
              if(!$("#quantity").val()){note += '● Quantity </br>';}
              if(!$("#price").val()){note += '● Price </br>';}
              if($("#isfile").val() != 1){note += '● Please select a picture </br>';}
              $('#sellmodal .modal-title').html("Please fix the following error(s)");
              $('#sellmodal .modal-body').html("<font color='#FF3300'>"+note+"</font>");
            }else{
              
              var name = $("#pro_name").val();
              var des =  $("#pro_des").val();
              var quan = $("#quantity").val();
              var price = $("#price").val();
              var type = $("#type").val();
              var seller = $("#seller").val();
              var path = $(".delimg").attr("rel");
              
              $.post("hi.php",{act:"sell", name:name, description:des, quantity:quan, price:price, type:type, seller:seller, path:path, issold:"0", buyer:"N/A"},function(msg){ 
                if(msg == 1){
                  $('#upldnotice').removeClass();
                  $('#upldnotice').addClass('alert alert-success');
                  $('#upldnotice').html('<div class="media-left"><img src="success.png" class="media-object"/></div><div class="media-right"><h4 class="media-heading">Product information uploaded successful.</h4><br/>Redirect in 3 seconds...</div>');
                  $('#sellform').remove();
                  setTimeout(function () {
                    location.href="./"; 
                  }, 3000);
                }
              });
            } 
          });
        </script>
      </div>
    </div><!-- sell -->
</div><!-- Container -->
<?php } ?>
<br>

</body>
</html>
