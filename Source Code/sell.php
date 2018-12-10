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
    #showimg{display:inline-block; position:relative;}
    #showimg .cover{position:absolute;color:#fff;text-align:center; top : 0px;right : 0px;width : 40px;height : 40px;}
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
                <span style="color:red">*</span><label for="price">Price</label><input type="text" class="form-control" id="price" name="price"/>
              </div>
              <div class="col-lg-5">
                <label for="item_condition">Condition</label>
                <select class="form-control" id="item_condition" name="item_condition">
                  <option value="Brand New">Brand New</option>
                  <option value="Refurbished">Refurbished</option>
                  <option value="Used">Used</option>
                  <option value="For parts">For parts</option>
                  <option value="Other(see description)">Other(see description)</option>
                </select>
              </div>
              <div class="col-lg-4"></div>
            </div>
            <br/>
            <div class="row">
              <label class="col-sm-12">Where this product is?</label>
            </div>
            <div class="row">
              <div class="col-lg-5">
                <span style="color:red">*</span><label for="city">City</label><input type="text" class="form-control" id="city" name="city"/>
              </div>
              <div class="col-lg-6">
                <label for="state">State</label>
                <select class="form-control" id="state" name="state">
                  <option value="AL">Alabama</option>
                  <option value="AK">Alaska</option>
                  <option value="AZ">Arizona</option>
                  <option value="AR">Arkansas</option>
                  <option value="CA">California</option>
                  <option value="CO">Colorado</option>
                  <option value="CT">Connecticut</option>
                  <option value="DE">Delaware</option>
                  <option value="DC">District Of Columbia</option>
                  <option value="FL">Florida</option>
                  <option value="GA">Georgia</option>
                  <option value="HI">Hawaii</option>
                  <option value="ID">Idaho</option>
                  <option value="IL">Illinois</option>
                  <option value="IN">Indiana</option>
                  <option value="IA">Iowa</option>
                  <option value="KS">Kansas</option>
                  <option value="KY">Kentucky</option>
                  <option value="LA">Louisiana</option>
                  <option value="ME">Maine</option>
                  <option value="MD">Maryland</option>
                  <option value="MA">Massachusetts</option>
                  <option value="MI">Michigan</option>
                  <option value="MN">Minnesota</option>
                  <option value="MS">Mississippi</option>
                  <option value="MO">Missouri</option>
                  <option value="MT">Montana</option>
                  <option value="NE">Nebraska</option>
                  <option value="NV">Nevada</option>
                  <option value="NH">New Hampshire</option>
                  <option value="NJ">New Jersey</option>
                  <option value="NM">New Mexico</option>
                  <option value="NY">New York</option>
                  <option value="NC">North Carolina</option>
                  <option value="ND">North Dakota</option>
                  <option value="OH">Ohio</option>
                  <option value="OK">Oklahoma</option>
                  <option value="OR">Oregon</option>
                  <option value="PA">Pennsylvania</option>
                  <option value="RI">Rhode Island</option>
                  <option value="SC">South Carolina</option>
                  <option value="SD">South Dakota</option>
                  <option value="TN">Tennessee</option>
                  <option value="TX">Texas</option>
                  <option value="UT">Utah</option>
                  <option value="VT">Vermont</option>
                  <option value="VA">Virginia</option>
                  <option value="WA">Washington</option>
                  <option value="WV">West Virginia</option>
                  <option value="WI">Wisconsin</option>
                  <option value="WY">Wyoming</option>
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
                  showimg.html("<img src='"+img+"'/><div class='cover' style='display:none;'><img src='delete2.png'/></div>"); 
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
            //show delete icon
            showimg.hover(function(){$(".cover").css("display","block")},function(){$(".cover").css("display","none")});
            //Delete file
            showimg.on('click',function(){ 
              var con = confirm("Confirm deleting?");
              if(con){
                var pic = $(".delimg").attr("rel"); 
                $.post("action.php?act=delimg",{imagename:pic},function(msg){ 
                  if(msg==1){ 
                    files.html("Deleted Successful."); 
                    showimg.css("display","none"); //file empty 
                    progress.hide(); //hide progress bar 
                    $("#isfile").val(0);
                  }else{ 
                    alert(msg); 
                  }
                });
              }
            }); 
          });
          $('#price').on('input', function() {
            var number = $(this).val().replace(/[^\d.]/g, '')
            $(this).val(number)
          });
          $('#city').on('input', function() {
            var number = $(this).val().replace(/[^A-Za-z ]/g, '')
            $(this).val(number)
          });
          $('#sellsubmit').click(function() {
            if(!$("#pro_name").val() || !$("#pro_des").val() || !$("#price").val() || !$("#city").val() || $("#isfile").val() != 1){  
              $('#sellmodal').modal('show');
              var note='';
              if(!$("#pro_name").val()){note = '● Product Name </br>';}
              if(!$("#pro_des").val()){note += '● Product Description </br>';}
              if(!$("#price").val()){note += '● Price </br>';}
              if(!$("#city").val()){note += '● City </br>';}
              if($("#isfile").val() != 1){note += '● Please select a picture </br>';}
              $('#sellmodal .modal-title').html("Please fix the following error(s)");
              $('#sellmodal .modal-body').html("<font color='#FF3300'>"+note+"</font>");
            }else{
              
              var name = $("#pro_name").val();
              var des =  $("#pro_des").val();
              var price = $("#price").val();
              var item_condition = $("#item_condition").val();
              var seller = $("#seller").val();
              var city = $("#city").val();
              var state = $("#state").val();
              var path = $(".delimg").attr("rel");
              
              $.post("hi.php",{act:"sell", name:name, description:des, price:price, item_condition:item_condition, seller:seller, city:city, state:state, path:path, issold:"0", buyer:"N/A"},function(msg){ 
                if(msg == 1){
                  $('#upldnotice').removeClass();
                  $('#upldnotice').addClass('alert alert-success');
                  $('#upldnotice').html('<div class="media-left"><img src="success.png" class="media-object"/></div><div class="media-right"><h4 class="media-heading">Product information uploaded successful.</h4><br/>Redirect in 3 seconds...</div>');
                  $('#sellform').remove();
                  setTimeout(function () {
                    location.href="product.php"; 
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
