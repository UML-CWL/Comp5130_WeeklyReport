<!DOCTYPE html>
<html lang="en">
<head>
  <title>Account Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
require("config.php");
require("navbar.php");
?>
<br/>
<?php if(!isset($_SESSION['loginUser'])){  
  require("notlogin.php");
 }else{ ?>
<div class="container">
  <?php require("myside.php");?>
  <script>
    $('#myside li:eq(1) a').tab('show');
  </script>
  <?php 
    $buyer = "SELECT * FROM account WHERE username = '".$_SESSION['loginUser']."'";
    $buyerresult = mysqli_query($link, $buyer);
    $buyer_row = mysqli_fetch_array($buyerresult);
  ?>
  <div class="col-sm-9">
    <h4><small>Account Management</small></h4>
    <hr>
    <h2>Account Editing</h2>
    <form class="form" role="form">
      <div class="row">
        <div class="col-lg-4">
          <label for="fname">First Name</label><input type="text" class="form-control" id="fname" name="fname" value="<?php echo $buyer_row["fname"]; ?>" />
        </div>
        <div class="col-lg-4">
          <label for="mname">Middle Name</label><input type="text" class="form-control" id="mname" name="mname" value="<?php echo $buyer_row["mname"]; ?>"/>
        </div>
        <div class="col-lg-4">
          <label for="lname">Last Name</label><input type="text" class="form-control" id="lname" name="lname" value="<?php echo $buyer_row["lname"]; ?>"/>
        </div>
      </div>
      <div class="form-group">
        <label for="email">Email Address</label><input type="email" class="form-control" id="email" name="email" value="<?php echo $buyer_row["email"]; ?>"/>
        <input type="hidden" class="form-control" id="emailcheck" name="emailcheck" value="0"/>
      </div>
      <div class="form-group">
        <label for="phone">Phone Number</label><input type="text" class="form-control" id="phone" name="phone" value="<?php echo $buyer_row["phone"]; ?>"/>
        <input type="hidden" class="form-control" id="phonecheck" name="phonecheck" value="0"/>
      </div>
      <div class="form-group">
        <label for="addr">Address</label><input type="text" class="form-control" id="addr" name="addr" value="<?php echo $buyer_row["addr"]; ?>"/>
      </div>
      <div class="row">
        <div class="col-lg-5">
          <label for="city">City</label><input type="text" class="form-control" id="city" name="city" value="<?php echo $buyer_row["city"]; ?>"/>
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
          <label for="zip">Zip Code</label><input type="text" class="form-control" id="zip" name="zip" value="<?php echo $buyer_row["zip"]; ?>"/>
        </div>
      </div>
      <br/>
      <button type="button" class="btn btn-primary btn-block" id="acc_edit">Submit</button>
      <input type = "hidden" name="acc" id="acc" value ="<?php echo $_SESSION['loginUser']; ?>">
    </form>
    <script>
      $('#phone, #zip').on('input', function() {
        var number = $(this).val().replace(/[^\d]/g, '')
        $(this).val(number)
      });
      $('#city').on('input', function() {
        var number = $(this).val().replace(/[^A-Za-z ]/g, '')
        $(this).val(number)
      });
      $('#acc_edit').click(function() {
        var acc = $('#acc').val();
        var fname = $("#fname").val();
        var mname = $("#mname").val();
        var lname = $("#lname").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var addr = $("#addr").val();
        var city = $("#city").val();
        var state = $("#state").val();
        var zip = $("#zip").val();
             

        if(email && !email.match(/([^@]+@[^@]+\.[a-zA-Z]{2,6})/)){
          $("#email").focus();return false;
        }
        if(phone && phone.length != 10){
          $("#phone").focus();return false;
        }
        if(zip && zip.length != 5){
          $("#zip").focus();return false;
        }
        
        $.post('hi.php', { act:"updateacc", fname:fname, mname:mname, lname:lname, email:email,  phone:phone, addr:addr, city:city, state:state, zip:zip, username:acc}, function (updata){
          if(updata == 1){
            location.reload();
          }else{
            alert("Account update failed, please try again later.");
          } 
        });
      });
    </script>
  </div><!-- end col-sm-9 -->
</div>
<?php } ?>
<br/>
<br/>

</body>
</html>
