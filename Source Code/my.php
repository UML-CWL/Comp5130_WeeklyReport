<!DOCTYPE html>
<html lang="en">
<head>
  <title>Account Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  #procs_order,#bot_item, #sol_item {overflow: auto; max-height: 200px;min-height: 200px;}
  #ordermodal th{width: 20%;}
  #showimg img {max-height:300px; min-height:300px;max-width:500px;}
  </style>
</head>
<body>
<?php
  require("config.php");
  require("navbar.php");
?>
<script>
    $('#nvbrleft li:eq(2) a').tab('show');
  </script>
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
<?php 
  $usr = $_SESSION['loginUser'];

  $selling = "SELECT * FROM buy WHERE seller = '".$usr."' AND status < '4' ORDER BY order_time DESC ";
  $buying = "SELECT * FROM buy WHERE buyer = '".$usr."' AND status < '4' ORDER BY order_time DESC ";
  $sale = "SELECT * FROM product WHERE seller = '".$usr."' AND issold = '0' ORDER BY id ASC";

  $sellingresult = mysqli_query($link, $selling);
  $buyingresult = mysqli_query($link, $buying);
  $saleresult = mysqli_query($link, $sale);
  
  $selling_rows = array();
  $buying_rows = array();
  $sale_rows = array();

  while($selling_row = mysqli_fetch_array($sellingresult)) $selling_rows[] = $selling_row;
  while($buying_row = mysqli_fetch_array($buyingresult)) $buying_rows[] = $buying_row;
  while($sale_row = mysqli_fetch_array($saleresult)) $sale_rows[] = $sale_row;
?>
<div class="container">
  <?php require("myside.php");?>
  <div class="col-sm-10">
    <h4>Processing Orders</h4>
    <hr>
    <h2>Selling To Others</h2>
    <div id="procs_order">
      <?php if(!mysqli_num_rows($sellingresult)){?>
        <h3 class="text-center">There is no data so far.</h3>
      <?php }else{ ?>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>OrderID</th>
              <th>Buyer</th>
              <th>Price</th>
              <th>Time</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($selling_rows as $sellrow){ ?>
            <tr>
              <td><a href="#" data-toggle="modal" data-id="<?php echo $sellrow["orderid"]; ?>"><?php echo $sellrow["orderid"]; ?></td>
              <td><?php echo $sellrow["buyer"]; ?></td>
              <td>$<?php echo $sellrow["price"]; ?></td>
              <td><?php echo $sellrow["order_time"]; ?></td>
              <?php 
              $statusnum = $sellrow["status"];
              switch($statusnum){
                case '0':
                  $status = "Need your confirmation";
                  break;
                case '1':
                  $status = "Waiting for the payment";
                  break;
                case '2':
                  $status = "Please pack and ship the item ";
                  break;
                case '3':
                  $status = "Waiting for package arriving";
                  break;
                case '4':
                  $status = "Delivered";
                  break;
                case '5':
                  $status = "Order Canceled";
                  break;
              } ?>
              <td><?php echo $status; ?></td>
              <td>
                <?php if($statusnum == 0){?>
                  <button type="button" class="btn btn-xs btn-primary" id="sellaction" data-id="<?php echo $sellrow["orderid"]; ?>">Confirm</button> <button type="button" class="btn btn-xs btn-danger" id="delsell" data-id="<?php echo $sellrow["orderid"];?>" data-rcv="<?php echo $sellrow["buyer"]; ?>" data-snd="<?php echo $sellrow["seller"]; ?>" data-item="<?php echo $sellrow["itemid"]; ?>">Cancel</button>
                <?php }else if($statusnum == 1){?>
                  <button type="button" class="btn btn-xs btn-primary" id="sellaction" data-id="<?php echo $sellrow["orderid"]; ?>">Payment Received</button> <button type="button" class="btn btn-xs btn-danger" id="delsell" data-id="<?php echo $sellrow["orderid"];?>" data-rcv="<?php echo $sellrow["buyer"]; ?>" data-snd="<?php echo $sellrow["seller"]; ?>" data-item="<?php echo $sellrow["itemid"]; ?>">Cancel</button>
                <?php }else if($statusnum == 2){?>
                  <button type="button" class="btn btn-xs btn-warning" id="selldetail" data-buyer="<?php echo $sellrow["buyer"]; ?>">Shipping Information</button>
                  <button type="button" class="btn btn-xs btn-primary" id="sellaction" data-id="<?php echo $sellrow["orderid"]; ?>">Ship</button>
                <?php } ?>
                <button type="button" class="btn btn-xs" id="sellmsg" data-id="<?php echo $sellrow["buyer"]; ?>">Message</button>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php } ?>
    </div>
    <h2>Buying From Others</h2>
    <div id="bot_item">
      <?php if(!mysqli_num_rows($buyingresult)){?>
        <h3 class="text-center">There is no data so far.</h3>
      <?php }else{ ?>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>OrderID</th>
              <th>Seller</th>
              <th>Price</th>
              <th>Time</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <?php foreach($buying_rows as $buyingrow){ ?>
          <tbody>
            <tr>
              <td><a href="#" data-toggle="modal" data-id="<?php echo $buyingrow["orderid"]; ?>"><?php echo $buyingrow["orderid"]; ?></a></td>
              <td><?php echo $buyingrow["seller"]; ?></td>
              <td>$<?php echo $buyingrow["price"]; ?></td>
              <td><?php echo $buyingrow["order_time"]; ?></td>
              <?php 
              $statusnum = $buyingrow["status"];
              switch($statusnum){
                case '0':
                  $status = "Waiting for seller to confirm";
                  break;
                case '1':
                  $status = "Order has been confirmed, please send the payment to the seller";
                  break;
                case '2':
                  $status = "Seller has received the payment, the item will be shipped soon";
                  break;
                case '3':
                  $status = "Item is on the way";
                  break;
                case '4':
                  $status = "Delivered";
                  break;
                case '5':
                  $status = "Order Canceled";
                  break;
              } ?>
              <td><?php echo $status; ?></td>
              <td>
                <?php if($statusnum == 0){?>
                  <button type="button" class="btn btn-xs btn-danger" id="delbuy" data-id="<?php echo $buyingrow["orderid"];?>" data-rcv="<?php echo $buyingrow["seller"]; ?>" data-snd="<?php echo $buyingrow["buyer"]; ?>" data-item="<?php echo $buyingrow["itemid"]; ?>">Cancel the order</button>
                <?php }else if($statusnum == 1){?>
                  <button type="button" class="btn btn-xs btn-danger" id="delbuy" data-id="<?php echo $buyingrow["orderid"];?>" data-rcv="<?php echo $buyingrow["seller"]; ?>" data-snd="<?php echo $buyingrow["buyer"]; ?>" data-item="<?php echo $buyingrow["itemid"]; ?>">Cancel the order</button>
                <?php }else if($statusnum == 3){?>
                  <button type="button" class="btn btn-xs btn-primary" id="buyaction" data-id="<?php echo $buyingrow["orderid"]; ?>">I have received the package</button>
                <?php } ?>
                <button type="button" class="btn btn-xs" id="buymsg" data-id="<?php echo $buyingrow["seller"]; ?>">Message</button>
              </td>
            </tr>
          </tbody>

          <?php } ?>
        </table>
      <?php } ?>
    </div>
    <h2>Items On Sale</h2>
    <div id="sol_item">
      <?php if(!mysqli_num_rows($saleresult)){?>
        <h3 class="text-center">There is no data so far.</h3>
      <?php }else{ ?>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Item</th>
              <th>Price</th>
              <th>Posted</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($sale_rows as $salerow){ ?>
            <tr>
              <td><?php echo $salerow["id"]; ?></td>
              <td><?php echo $salerow["name"]; ?></td>
              <td>$<?php echo $salerow["price"]; ?></td>
              <td><?php echo $salerow["time"]; ?></td>
              <td><button type="button" class="btn btn-xs btn-primary" id="editbtn" data-id="<?php echo $salerow["id"]; ?>">Edit</button> <button type="button" class="btn btn-xs btn-danger" id="delbtn" data-id="<?php echo $salerow["id"]; ?>">Delete</button></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php } ?>
    </div>
    <!-- order modal -->
    <div class="modal fade" id="ordermodal" tabindex="-1" role="dialog" aria-labelledby="orderlabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h4 class="modal-title" id="orderlabel"></h4>
          </div>
          <div class="modal-body">
            <table class="table" >
              <tr>
                <th>Item name</th>
                <td id="item_name_modal"></td>
              </tr>
              <tr>
                <th>Buyer</th>
                <td id="buyer_modal"></td>
              </tr>
              <tr>
                <th>Seller</th>
                <td id="seller_modal"></td>
              </tr>
              <tr>
                <th>Price</th>
                <td id="price_modal"></td>
              </tr>
              <tr>
                <th>Time</th>
                <td id="order_time_modal"></td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal -->
    </div>
    <!-- buyer info modal -->
    <div class="modal fade" id="buyerinfomodal" tabindex="-1" role="dialog" aria-labelledby="buyerinfolabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h4 class="modal-title" id="buyerinfolabel"></h4>
          </div>
          <div class="modal-body">
            <table class="table" >
              <tr>
                <th>First Name</th>
                <td id="fname_modal"></td>
              </tr>
              <tr>
                <th>Middle Name</th>
                <td id="mname_modal"></td>
              </tr>
              <tr>
                <th>Last Name</th>
                <td id="lname_modal"></td>
              </tr>
              <tr>
                <th>Phone Number</th>
                <td id="phone_modal"></td>
              </tr>
              <tr>
                <th>Address</th>
                <td id="addr_modal"></td>
              </tr>
              <tr>
                <th>City</th>
                <td id="city_modal"></td>
              </tr>
              <tr>
                <th>State</th>
                <td id="state_modal"></td>
              </tr>
              <tr>
                <th>Zip Code</th>
                <td id="zip_modal"></td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal -->
    </div>
    <!-- Product modal -->
    <div class="modal fade" id="itemmodal" tabindex="-1" role="dialog" aria-labelledby="itemlabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h4 class="modal-title" id="itemlabel"></h4>
          </div>
          <div class="modal-body">
            <form role="form" id="sellform" method="post" action="">
              <input type="hidden" id="pro_id" name="pro_id"/>
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
                <label for="type">Condition</label>
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
            <div class="row">
              <div class="col-lg-3">
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

            <div id="showimg" style="background-color : #EEE;text-align : center;">
              <img src="" style="vertical-align : middle;"/>
              </div>
            <br/>
          </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="editsbmt" data-loading-text="Loading...">Submit</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal -->
    </div>
    <script>
      /* buy a */
      $(".table-hover").find('tr td a').on('click', function () {
        var orderid = $(this).data('id');
        $('#ordermodal').modal('show');
        $.post("hi.php",{act:"ordercheck", orderid:orderid},function(ordchk){
          if(ordchk){
            var str_ordchk = JSON.parse(ordchk);
            $('#orderlabel').text("Order Detail for # "+orderid);
            $('#item_name_modal').text(str_ordchk.item);
            $('#buyer_modal').text(str_ordchk.buyer);
            $('#seller_modal').text(str_ordchk.seller);
            $('#price_modal').text("$"+str_ordchk.price);
            $('#order_time_modal').text(str_ordchk.order_time);

          }else{
            alert("Send message error, please try again later.");
          }
        });
      });
      /* Sale delete btn */
      $(".table-hover").find('tr td #delbtn').on('click', function () {
        var itemid = $(this).data('id');
        var con = confirm("Confirm deleting item # "+itemid+"?");
        if(con){
          $.post("hi.php",{act:"delitem",itemid:itemid},function(msg){ 
            if(msg==1){ 
              location.reload();
            }else{ 
              alert("System Error, please try again later."); 
            }
          });
        }
      });
      /* Sale edit btn */
      $(".table-hover").find('tr td #editbtn').on('click', function () {
        //alert("edit = "+$(this).data('id'));
        var itemid = $(this).data('id');
        $('#itemmodal').modal('show');
        $.post("hi.php",{act:"edititemcheck", itemid:itemid},function(ordchk){
          if(ordchk){
            var str_ordchk = JSON.parse(ordchk);
            $('#itemlabel').text("Product information for ID "+itemid);
            $('#pro_id').val(itemid);
            $('#pro_name').val(str_ordchk.name);
            $('#pro_des').val(str_ordchk.description);
            $('#price').val(str_ordchk.price);
            $('#item_condition').val(str_ordchk.item_condition);
            $('#city').val(str_ordchk.city);
            $('#state').val(str_ordchk.state);
            $('#showimg').html("<img src='pics/"+str_ordchk.pic+"'/>");
            //$('#showimg img[src]').text(str_ordchk.pic);
          }else{
            alert("Send message error, please try again later.");
          }
        });
      });
      $('#price').on('input', function() {
        var number = $(this).val().replace(/[^\d]/g, '')
        $(this).val(number)
      });
      $('#city').on('input', function() {
        var number = $(this).val().replace(/[^A-Za-z ]/g, '')
        $(this).val(number)
      });
      /* edit item modal */
      $('#editsbmt').click(function() {
        var itemid = $('#pro_id').val();
        var name = $('#pro_name').val();
        var des = $('#pro_des').val();
        var price = $("#price").val();
        var item_condition = $("#item_condition").val();
        var city = $("#city").val();
        var state = $("#state").val();

        if(!name){$("#pro_name").focus(); return false;}
        if(!des){$("#pro_des").focus(); return false;}
        if(!price){$("#price").focus();return false;}    
        if(!city){$("#city").focus();return false;}             

        $.post('hi.php', { act:"edititem", itemid:itemid, name:name, description:des, item_condition:item_condition, price:price, city:city, state:state}, function (edititem){
          
          if(edititem == 1){
            $('#editsbmt').prop('disabled', 'disabled');
            $('#itemmodal .modal-body').html("Product information has been updated.");
            setTimeout(function () {
            location.reload();
          }, 2000);
          }else{
            alert("Update failed, please try again later.");
          } 
          //alert(edititem);
        });
      });
      /* buy,sell action btn */
      $(".table-hover").find('tr td #sellaction,#buyaction').on('click', function () {
        var orderid = $(this).data('id');
        var con = confirm("Confirm action?");
        if(con){
          $.post("hi.php",{act:"ordrupstatus",orderid:orderid},function(msg){ 
            
            if(msg==1){ 
              location.reload();
            }else{ 
              alert("System Error, please try again later."); 
            }
          });
        }
      });
      /* buy,sell del btn */
      $(".table-hover").find('tr td #delbuy,#delsell').on('click', function () {
        var orderid = $(this).data('id');
        var rcv = $(this).data('rcv');
        var snd = $(this).data('snd');
        var itemid = $(this).data('item');
        var con = confirm("Confirm action?");
        if(con){
          $.post("hi.php",{act:"delorder",itemid:itemid, orderid:orderid, sender:snd, receiver:rcv},function(msg){ 
            
            if(msg==1){ 
              location.reload();
            }else{ 
              alert("System Error, please try again later."); 
            }
          });
        }
      });
      /* see buyer info btn */
      $(".table-hover").find('tr td #selldetail').on('click', function () {
        var buyer = $(this).data('buyer');
        $('#buyerinfomodal').modal('show');
          $.post("hi.php",{act:"buyerinfo",username:buyer},function(msg){ 
            if(msg){ 
              var str_buyerinfo = JSON.parse(msg);
              $('#buyerinfolabel').text("Shipping information for "+buyer);
              $('#fname_modal').text(str_buyerinfo.fname);
              $('#mname_modal').text(str_buyerinfo.mname);
              $('#lname_modal').text(str_buyerinfo.lname);
              $('#phone_modal').text(str_buyerinfo.phone);
              $('#addr_modal').text(str_buyerinfo.addr);
              $('#city_modal').text(str_buyerinfo.city);
              $('#state_modal').text(str_buyerinfo.state);
              $('#zip_modal').text(str_buyerinfo.zip);
            }else{ 
              alert("System Error, please try again later."); 
            }
          });
      });
      /* buy, sell msg btn */
      $(".table-hover").find('tr td #buymsg,#sellmsg').on('click', function () {
        var ppl = $(this).data('id');
        location.href="chat.php?rcv="+ppl;
      });

    </script>
  </div><!-- end col-sm-9 -->
</div>
<?php } ?>
<br/>
<br/>

</body>
</html>
