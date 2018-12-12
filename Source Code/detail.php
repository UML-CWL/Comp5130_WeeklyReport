<?php
if(!isset($_GET['id'])){
header("Location:product.php");
exit;
}else{
  $id = $_GET['id'];
}
require("config.php");
require("navbar.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Product Detail</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  img{
    max-height:350px;
    myheight:expression(onload=function(){ this.style.height=(this.offsetheight > 350)?'350px':'auto'});
  }
  .jumbotron {margin-bottom: 0; text-align : center;}
  .buybtn{cursor:pointer;outline:none;border-radius:0.25rem;-webkit-appearance:none;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;display:-webkit-inline-box;display:-moz-inline-box;display:-ms-inline-flexbox;display:-webkit-inline-flex;display:inline-flex;font-weight:600;background-color:#00ab80;border:1px solid #00ab80;border-bottom-color:#009770;color:#ffffff;padding:8px 20px;font-size:20px;line-height:26px;}
  .buybtn:disabled{opacity:.65;pointer-events:none;}
  .buybtn:hover{background-color:#009770;border-color:#009770;}
  .buybtn:focus{border-color:#009770;}
  .buybtn:active{background-color:#008765;}
  .offerbtn{cursor:pointer;outline:none;border-radius:0.25rem;-webkit-appearance:none;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;display:-webkit-inline-box;display:-moz-inline-box;display:-ms-inline-flexbox;display:-webkit-inline-flex;display:inline-flex;font-weight:600;background-color:#ffffff;border:1px solid #00ab80;color:#00ab80;padding:8px 20px;font-size:20px;line-height:26px;}
  .offerbtn:disabled{opacity:.65;pointer-events:none;}
  .offerbtn:hover{background-color:rgba(0, 171, 128, 0.1);}
  .offerbtn:active{background-color:rgba(0, 151, 112, 0.1);}
  hr.style-one {border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0));}
  .sellerarea{position:relative;border:1px solid #d8d8d8;border-radius:6px;padding:16px;background-color:white;}
  </style>
</head>
<body>
<?php 
  $product = "SELECT * FROM product WHERE id = ".$id;
  $productresult = mysqli_query($link, $product);
  $product_row = mysqli_fetch_array($productresult);
  $sellername = $product_row["seller"];
  
  $seller = "SELECT city,state FROM account WHERE username = '".$sellername."'";
  $sellerresult = mysqli_query($link, $seller);
  $seller_row = mysqli_fetch_array($sellerresult);

  if(isset($_SESSION['loginUser'])){
    $buyer = "SELECT * FROM account WHERE username = '".$_SESSION['loginUser']."'";
    $buyerresult = mysqli_query($link, $buyer);
    $buyer_row = mysqli_fetch_array($buyerresult);
  }
?>
<br/>
<br/>
<div class="jumbotron">
  <img src="pics/<?php echo $product_row['pic']; ?>"/>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-offset-3">
      <div class="media-left" style="color:green; font-size:38px;">$<?php echo $product_row["price"]; ?></div>
      <div class="media-body" style=" font-size:27px;"><?php echo $product_row["name"]; ?></div>
    </div>
    <div class="col-md-offset-3">
      <div class="col-md-8">
        <div style=" font-size:20px;"><?php echo $product_row["city"]; ?>, <?php echo $product_row["state"]; ?></div>
        <div style=" font-size:20px;">Posted: <?php echo $product_row["time"]; ?></div>
        <span class="label label-default"><?php echo $product_row["item_condition"]; ?></span>
      </div>
      <div class="media-right">
        <div class="sellerarea">
          <p style=" font-size:20px;">Seller: <?php echo $product_row["seller"]; ?>
          <input type = "hidden" name="seller" id="seller" value ="<?php echo $product_row["seller"]; ?>">
          <input type = "hidden" name="product_name" id="product_name" value ="<?php echo $product_row["name"]; ?>">
          <input type = "hidden" name="product_id" id="product_id" value ="<?php echo $id; ?>">        
          <?php if(isset($_SESSION['loginUser'])){ ?>
            <button type="button" id="sellermsgbtn" class="btn btn-primary btn-xs" data-toggle="modal">Message</button></p>
            <?php if($product_row["issold"] != 1){ ?>
            <form class="form-inline">
              <button type="button" class="offerbtn" id="offerbtn" data-toggle="modal">Make Offer</button>
              <button type="button" class="buybtn" id="buybtn" data-toggle="modal">Buy</button>
              <input type = "hidden" name="acc" id="acc" value ="<?php echo $_SESSION['loginUser']; ?>">
           </form>
            <?php }else{?>
              <label>This product has been sold out.</label> 
            <?php } ?>
          <?php }else{ ?>
          <script type="text/javascript">
            var path = location.pathname;
            var search = location.search;
            var url = path + search;
          </script>
          <p>Please <a href="#" onclick="javascript:location.href='reg.php?redirect='+ url+'#in'">log in</a> or <a href="#" onclick="javascript:location.href='reg.php?redirect='+ url+'#up'">sign up</a> for further action</p>
        <?php } ?>
        </div>
      </div>
      <hr class="style-one"/>
    </div>
    <div class="col-md-offset-3">
      <div style=" font-size:20px;"><?php echo nl2br($product_row["description"]); ?></div>
    </div>
    <!-- msg modal -->
    <div class="modal fade" id="msgmodal" tabindex="-1" role="dialog" aria-labelledby="msglabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h4 class="modal-title" id="msglabel">Message to <?php echo $product_row["seller"]; ?></h4>
          </div>
          <div class="modal-body">
            <form class="form">
              <label for="msgcontent">Content</label>
              <textarea class="form-control" rows="3" id="msgcontent" name="msgcontent"></textarea>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="msgbtn" data-loading-text="Loading...">Submit</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal -->
    </div>
    <!-- offer modal -->
    <div class="modal fade" id="offermodal" tabindex="-1" role="dialog" aria-labelledby="offerlabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h4 class="modal-title" id="offerlabel">Make An Offer to <?php echo $product_row["name"]; ?></h4>
          </div>
          <div class="modal-body">
            <form class="form" role="form">
              <label for="offercontent">Enter your ideal price</label>
              <div class="input-group">
                <span class="input-group-addon">$</span>
                <input type="text" class="form-control" id="offercontent" name="offercontent" placeholder="Price"/>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="offersbmt" data-loading-text="Loading...">Submit</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal -->
    </div>
    <!-- buy modal -->
    <div class="modal fade" id="buymodal" tabindex="-1" role="dialog" aria-labelledby="buylabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h4 class="modal-title" id="buylabel">Please fill in the form below</h4>
          </div>
          <div class="modal-body">
            <form class="form" role="form">
              <div class="col-lg-12">
                <label>Product</label><h4><b><?php echo $product_row["name"]; ?></b></h4>
              </div>
              <div class="form-group">
                <span style="color:red">*</span><label for="buyprice">Price</label>
                <span>(Can change if the seller accept your offer; otherwise, remain the original price.)</span>
                <div class="input-group">
                  <span class="input-group-addon">$</span>
                  <input type="text" class="form-control" id="buyprice" name="buyprice" value="<?php echo $product_row["price"]; ?>"/>
                </div>
              </div>
              <div class="row">
              <div class="col-lg-4">
                <span style="color:red">*</span><label for="fname">First Name</label> <span id="fnamewarn"></span><input type="text" class="form-control" id="fname" name="fname" value="<?php echo $buyer_row["fname"]; ?>" />
              </div>
              <div class="col-lg-4">
                <label for="mname">Middle Name</label><span id="mnamewarn"></span><input type="text" class="form-control" id="mname" name="mname" value="<?php echo $buyer_row["mname"]; ?>"/>
              </div>
              <div class="col-lg-4">
                <span style="color:red">*</span><label for="lname">Last Name</label> <span id="lnamewarn"></span><input type="text" class="form-control" id="lname" name="lname" value="<?php echo $buyer_row["lname"]; ?>"/>
              </div>
            </div>
            <div class="form-group">
              <span style="color:red">*</span><label for="email">Email Address</label> <span id="emailwarn" style="font-weight:bold;"></span><input type="email" class="form-control" id="email" name="email" value="<?php echo $buyer_row["email"]; ?>"/>
              <input type="hidden" class="form-control" id="emailcheck" name="emailcheck" value="0"/>
            </div>
            <div class="form-group">
              <span style="color:red">*</span><label for="phone">Phone Number</label> <span id="phonewarn" style="font-weight:bold;"></span><input type="text" class="form-control" id="phone" name="phone" value="<?php echo $buyer_row["phone"]; ?>"/>
              <input type="hidden" class="form-control" id="phonecheck" name="phonecheck" value="0"/>
            </div>
            <div class="form-group">
              <span style="color:red">*</span><label for="addr">Address</label> <span id="addrwarn"></span ><input type="text" class="form-control" id="addr" name="addr" value="<?php echo $buyer_row["addr"]; ?>"/>
            </div>
            <div class="row">
              <div class="col-lg-5">
                <span style="color:red">*</span><label for="city">City</label> <span id="citywarn"></span><input type="text" class="form-control" id="city" name="city" value="<?php echo $buyer_row["city"]; ?>"/>
              </div>
              <div class="col-lg-4">
                <label for="state">State</label>
                <select class="form-control" id="state" name="state">
                  <option value="AL" <?php if($buyer_row["state"] == 'AL') echo 'selected';?>>Alabama</option>
                  <option value="AK" <?php if($buyer_row["state"] == 'AK') echo 'selected';?>>Alaska</option>
                  <option value="AZ" <?php if($buyer_row["state"] == 'AZ') echo 'selected';?>>Arizona</option>
                  <option value="AR" <?php if($buyer_row["state"] == 'AR') echo 'selected';?>>Arkansas</option>
                  <option value="CA" <?php if($buyer_row["state"] == 'CA') echo 'selected';?>>California</option>
                  <option value="CO" <?php if($buyer_row["state"] == 'CO') echo 'selected';?>>Colorado</option>
                  <option value="CT" <?php if($buyer_row["state"] == 'CT') echo 'selected';?>>Connecticut</option>
                  <option value="DE" <?php if($buyer_row["state"] == 'DE') echo 'selected';?>>Delaware</option>
                  <option value="DC" <?php if($buyer_row["state"] == 'DC') echo 'selected';?>>District Of Columbia</option>
                  <option value="FL" <?php if($buyer_row["state"] == 'FL') echo 'selected';?>>Florida</option>
                  <option value="GA" <?php if($buyer_row["state"] == 'GA') echo 'selected';?>>Georgia</option>
                  <option value="HI" <?php if($buyer_row["state"] == 'HI') echo 'selected';?>>Hawaii</option>
                  <option value="ID" <?php if($buyer_row["state"] == 'ID') echo 'selected';?>>Idaho</option>
                  <option value="IL" <?php if($buyer_row["state"] == 'IL') echo 'selected';?>>Illinois</option>
                  <option value="IN" <?php if($buyer_row["state"] == 'IN') echo 'selected';?>>Indiana</option>
                  <option value="IA" <?php if($buyer_row["state"] == 'IA') echo 'selected';?>>Iowa</option>
                  <option value="KS" <?php if($buyer_row["state"] == 'KS') echo 'selected';?>>Kansas</option>
                  <option value="KY" <?php if($buyer_row["state"] == 'KY') echo 'selected';?>>Kentucky</option>
                  <option value="LA" <?php if($buyer_row["state"] == 'LA') echo 'selected';?>>Louisiana</option>
                  <option value="ME" <?php if($buyer_row["state"] == 'ME') echo 'selected';?>>Maine</option>
                  <option value="MD" <?php if($buyer_row["state"] == 'MD') echo 'selected';?>>Maryland</option>
                  <option value="MA" <?php if($buyer_row["state"] == 'MA') echo 'selected';?>>Massachusetts</option>
                  <option value="MI" <?php if($buyer_row["state"] == 'MI') echo 'selected';?>>Michigan</option>
                  <option value="MN" <?php if($buyer_row["state"] == 'MN') echo 'selected';?>>Minnesota</option>
                  <option value="MS" <?php if($buyer_row["state"] == 'MS') echo 'selected';?>>Mississippi</option>
                  <option value="MO" <?php if($buyer_row["state"] == 'MO') echo 'selected';?>>Missouri</option>
                  <option value="MT" <?php if($buyer_row["state"] == 'MT') echo 'selected';?>>Montana</option>
                  <option value="NE" <?php if($buyer_row["state"] == 'NE') echo 'selected';?>>Nebraska</option>
                  <option value="NV" <?php if($buyer_row["state"] == 'NV') echo 'selected';?>>Nevada</option>
                  <option value="NH" <?php if($buyer_row["state"] == 'NH') echo 'selected';?>>New Hampshire</option>
                  <option value="NJ" <?php if($buyer_row["state"] == 'NJ') echo 'selected';?>>New Jersey</option>
                  <option value="NM" <?php if($buyer_row["state"] == 'MN') echo 'selected';?>>New Mexico</option>
                  <option value="NY" <?php if($buyer_row["state"] == 'NY') echo 'selected';?>>New York</option>
                  <option value="NC" <?php if($buyer_row["state"] == 'NC') echo 'selected';?>>North Carolina</option>
                  <option value="ND" <?php if($buyer_row["state"] == 'ND') echo 'selected';?>>North Dakota</option>
                  <option value="OH" <?php if($buyer_row["state"] == 'OH') echo 'selected';?>>Ohio</option>
                  <option value="OK" <?php if($buyer_row["state"] == 'OK') echo 'selected';?>>Oklahoma</option>
                  <option value="OR" <?php if($buyer_row["state"] == 'OR') echo 'selected';?>>Oregon</option>
                  <option value="PA" <?php if($buyer_row["state"] == 'PA') echo 'selected';?>>Pennsylvania</option>
                  <option value="RI" <?php if($buyer_row["state"] == 'RI') echo 'selected';?>>Rhode Island</option>
                  <option value="SC" <?php if($buyer_row["state"] == 'SC') echo 'selected';?>>South Carolina</option>
                  <option value="SD" <?php if($buyer_row["state"] == 'SD') echo 'selected';?>>South Dakota</option>
                  <option value="TN" <?php if($buyer_row["state"] == 'TN') echo 'selected';?>>Tennessee</option>
                  <option value="TX" <?php if($buyer_row["state"] == 'TX') echo 'selected';?>>Texas</option>
                  <option value="UT" <?php if($buyer_row["state"] == 'UT') echo 'selected';?>>Utah</option>
                  <option value="VT" <?php if($buyer_row["state"] == 'VT') echo 'selected';?>>Vermont</option>
                  <option value="VA" <?php if($buyer_row["state"] == 'VA') echo 'selected';?>>Virginia</option>
                  <option value="WA" <?php if($buyer_row["state"] == 'WA') echo 'selected';?>>Washington</option>
                  <option value="WV" <?php if($buyer_row["state"] == 'WV') echo 'selected';?>>West Virginia</option>
                  <option value="WI" <?php if($buyer_row["state"] == 'WI') echo 'selected';?>>Wisconsin</option>
                  <option value="WY" <?php if($buyer_row["state"] == 'WY') echo 'selected';?>>Wyoming</option>
                </select>
              </div>
              <div class="col-lg-3">
                <span style="color:red">*</span><label for="zip">Zip Code</label> <span id="zipwarn"></span><input type="text" class="form-control" id="zip" name="zip" value="<?php echo $buyer_row["zip"]; ?>"/>
              </div>
            </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="buysbmt" data-loading-text="Loading...">Submit</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal -->
    </div>
  </div>
</div>
<script>
  /* message */
  $('#sellermsgbtn').click(function() {
    var seller = $('#seller').val();
    var acc = $('#acc').val();
    if(seller == acc){
      alert("You Cannot Message to Yourself !!");
    }else{
      $('#msgmodal').modal('show');
    }
  });
  /* message modal */
  $('#msgbtn').click(function() {
    var seller = $('#seller').val();
    var acc = $('#acc').val();
    var content = $("#msgcontent").val();
    if(content){
      var con_title = "<b><a href='detail.php?id="+$('#product_id').val()+"'>RE: "+$('#product_name').val()+"</a></b>\n";
      var msgall = con_title+content;
      $('#msgbtn').prop('disabled', 'disabled');
      $.post("hi.php",{act:"chat", sender:acc, receiver:seller, content:msgall},function(msg){ 
        if(msg == 1){
          $('#msgmodal .modal-body').html("Message has successfully sent.");
          setTimeout(function () {
            $('#msgmodal').modal('hide');
            $('#msgbtn').prop('disabled', false);
            $('#msgmodal .modal-body').html("<form class='form'><label for='msgcontent'>Content</label><textarea class='form-control' rows='3' id='msgcontent' name='msgcontent'></textarea></form>");
          }, 2000);
        }else{
          alert("Send message error, please try again later.");
        }
      });
    }else{
      alert("Write something in content!");
    }
  });
  /* Offer */
  $('#offerbtn').click(function() {
    var seller = $('#seller').val();
    var acc = $('#acc').val();
    if(seller == acc){
      alert("Please edit product information instead of making offer for your product !!");
    }else{
      $('#offermodal').modal('show');
    }
  });
  /* Offer modal */
  $('#offersbmt').click(function() {
    var seller = $('#seller').val();
    var acc = $('#acc').val();
    var offerprice = $("#offercontent").val();
    var itemid = $("#product_id").val();
    if(offerprice){
      var offerall = "Hello, I would like to buy <b><a href='detail.php?id="+itemid+"'>this product</a></b> in $"+offerprice;
      $('#offersbmt').prop('disabled', 'disabled');
      $.post("hi.php",{act:"chat", sender:acc, receiver:seller, content:offerall},function(msg){ 
        if(msg == 1){
          $('#offermodal .modal-body').html("Offer has successfully sent to the seller.");
          setTimeout(function () {
            $('#offermodal').modal('hide');
            $('#offermodal .modal-body').html("You have been made an offer, please go to chat center to see if the seller has responded.");
          }, 2000);
        }else{
          alert("Send message error, please try again later.");
        }
      });
    }else{
      alert("Enter the price !!");
    }
  });
  /* Buy */
  $('#buybtn').click(function() {
    var seller = $('#seller').val();
    var acc = $('#acc').val();
    if(seller == acc){
      alert("You cannot buy your own product !!");
    }else{
      $('#buymodal').modal('show');
    }
  });
  $('#phone, #zip, #buyprice').on('input', function() {
    var number = $(this).val().replace(/[^\d]/g, '')
    $(this).val(number)
  });
  $('#city').on('input', function() {
    var number = $(this).val().replace(/[^A-Za-z ]/g, '')
    $(this).val(number)
  });
  /* Buy modal */
  $('#buysbmt').click(function() {
    var seller = $('#seller').val();
    var acc = $('#acc').val();
    var buyprice = $("#buyprice").val();
    var item = $("#product_name").val();
    var itemid = $("#product_id").val();

    var fname = $("#fname").val();
    var mname = $("#mname").val();
    var lname = $("#lname").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var addr = $("#addr").val();
    var city = $("#city").val();
    var state = $("#state").val();
    var zip = $("#zip").val();

    if(!$("#buyprice").val()){$("#buyprice").focus(); return false;}
    if(!fname){$("#fname").focus(); return false;}
    if(!lname){$("#lname").focus();return false;}              

    if(!email.match(/([^@]+@[^@]+\.[a-zA-Z]{2,6})/)){
      $("#email").focus();return false;
    }
    if(phone.length != 10){
      $("#phone").focus();return false;
    }
    if(!addr){$("#addr").focus();return false;}
    if(!city){$("#city").focus();return false;}
    if(zip.length != 5){
      $("#zip").focus();return false;
    }
    $.post('hi.php', { act:"updateacc", fname:fname, mname:mname, lname:lname, email:email,  phone:phone, addr:addr, city:city, state:state, zip:zip, username:acc}, function (updata){
      if(updata == 1){
        $.post("hi.php",{act:"buy", itemid:itemid, item:item, buyer:acc, seller:seller, price:buyprice},function(buydata){ 
          
          if(buydata == 1){
            $('#buysbmt').prop('disabled', 'disabled');
            $('#buymodal .modal-body').html("Your order has been placed.");
            setTimeout(function () {
              location.href="my.php";
            }, 2000);
          }else{
            alert("Order placed failed, please try again later.");
          }
        });
      }else{
        alert("Account update failed, please try again later.");
      } 
    });
  });
  
</script>
<!--
<footer class="container-fluid text-center ">
  <p style=" font-size:20px;">Seller: <?php echo $product_row["seller"]; ?></p>  
  <form class="form-inline">
    <button type="button" class="askbtn">Ask</button>
    <button type="button" class="offerbtn">Make Offer</button>
  </form>
</footer>-->
</body>
</html>
