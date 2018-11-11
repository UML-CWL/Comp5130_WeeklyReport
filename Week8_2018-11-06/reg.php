<?php
//session_cache_limiter('private');
require("config.php");
require("navbar.php");
//$sql = "SELECT * FROM account";
//$result = mysqli_query($link, $sql);
//$total_records = mysqli_num_rows($result);
//mysqli_close($link);
//$row = mysqli_fetch_array($query)
//while($row = mysqli_fetch_array($query)){echo $row[‘title‘];}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="pwdcheck.js"></script>
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    /*
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    */
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }
    #signupform .short{
      font-weight:bold;
      color:#FF0000;
      font-size:larger;
    }
    #signupform .weak{
      font-weight:bold;
      color:orange;
      font-size:larger;
    }
    #signupform .good{
      font-weight:bold;
      color:#2D98F3;
      font-size:larger;
    }
    #signupform .strong{
      font-weight:bold;
      color: limegreen;
      font-size:larger;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>
<body>
<br/>

<br/>
<br/>
<?php if(isset($_SESSION['loginUser'])){ ?>
<div class="container" style="">
  <div class="row col-md-7 col-md-offset-2">
    <div class="alert alert-danger text-center"><img src="fail.png"/> Your are currently Logged In !!</div>
  </div>
</div>
<script>
  setTimeout(function () {
    location.replace('./'); 
  }, 2000);
</script>
<?php }else{ ?>

<div class="container" style="">
  <div class="row">
    <div class="col-md-3 "></div>
    <div class="col-md-5 ">
      <ul id="singtab" class="nav nav-tabs nav-justified">
        <li class="active">
          <a href="#signin" data-toggle="tab">Sign In</a></li>
        <li><a href="#signup" data-toggle="tab">Sign Up</a></li>
      </ul>
    </div>
  </div>

  <br>

  <div id="Register" class="tab-content">
    <!-- Sign in section -->
    <div class="tab-pane fade in active" id="signin">
      <div class="row">
        <div class="col-md-5 col-md-offset-3 column">
          <form class="form-horizontal" role="form" action="check.php" id="loginform">
            <div class="form-group" id="loginnotice">
              <span id="loginfail" class="col-sm-10 col-sm-offset-2"></span>
            </div>
            <div class="form-group">
              <label for="loginusr" class="col-sm-2 control-label">Uername</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="loginusr" />
              </div>
            </div>
            <div class="form-group">
              <label for="loginpwd" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="loginpwd" />
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label><input type="checkbox" />Remember me</label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-default" id="loginsubmit" >Sign In</button>
              </div>
            </div>
          </form>
        </div>
      </div>    
    </div>
    <!-- End of Sign in section -->
    <!-- Sign up section -->
    <div class="tab-pane fade" id="signup">
      <div class="row">
        <div class="col-md-5 col-md-offset-3 column">
          <form role="form" id="signupform" method="post" action="hi.php">
            <div class="row">
              <div class="col-lg-4">
                <span style="color:red">*</span><label for="fname">First Name</label> <span id="fnamewarn"></span><input type="text" class="form-control" id="fname" name="fname" />
              </div>
              <div class="col-lg-4">
                <label for="mname">Middle Name</label><span id="mnamewarn"></span><input type="text" class="form-control" id="mname" name="mname"/>
              </div>
              <div class="col-lg-4">
                <span style="color:red">*</span><label for="lname">Last Name</label> <span id="lnamewarn"></span><input type="text" class="form-control" id="lname" name="lname"/>
              </div>
            </div>
            <div class="form-group">
              <span style="color:red">*</span><label for="username">Username</label> <span id="userwarn" style="background: rgba(0%,10%,20%,0.1);-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px; color:#CC6600; font-weight:bold;"></span><input type="text" class="form-control" id="username" name="username"/>
              <input type="hidden" class="form-control" id="usrcheck" name="usrcheck" value="0"/>
            </div>
            <div class="form-group">
              <span style="color:red">*</span><label for="password">Password</label> <span id="pwdwarn" style="background: rgba(0%,10%,20%,0.1);-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px; color:#CC6600; font-weight:bold;"></span><input type="password" class="form-control" id="password" name="password"/>
              <span id="result"></span>
            </div>
            <div class="form-group">
              <span style="color:red">*</span><label for="password">Confirm Password</label> <span id="pwdconwarn" style="background: rgba(0%,10%,20%,0.1);-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px; color:#CC6600; font-weight:bold;"></span><input type="password" class="form-control" id="pwdconfirm"/>
            </div>
            <div class="form-group">
              <span style="color:red">*</span><label for="email">Email Address</label> <span id="emailwarn" style="font-weight:bold;"></span><input type="email" class="form-control" id="email" name="email"/>
              <input type="hidden" class="form-control" id="emailcheck" name="emailcheck" value="0"/>
            </div>
            <div class="form-group">
                <span style="color:red">*</span><label for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender">
                  <option value="M">Male</option>
                  <option value="F">Female</option>
                  <option value="N">Do not want to answer</option>
                </select>
              </div>
            <div class="form-group">
              <span style="color:red">*</span><label for="phone">Phone Number</label> <span id="phonewarn" style="font-weight:bold;"></span><input type="text" class="form-control" id="phone" name="phone"/>
              <input type="hidden" class="form-control" id="phonecheck" name="phonecheck" value="0"/>
            </div>
            <div class="form-group">
              <span style="color:red">*</span><label for="addr">Address</label> <span id="addrwarn"></span ><input type="text" class="form-control" id="addr" name="addr"/>
            </div>
            <div class="row">
              <div class="col-lg-5">
                <span style="color:red">*</span><label for="city">City</label> <span id="citywarn"></span><input type="text" class="form-control" id="city" name="city"/>
              </div>
              <div class="col-lg-4">
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
              <div class="col-lg-3">
                <span style="color:red">*</span><label for="zip">Zip Code</label> <span id="zipwarn"></span><input type="text" class="form-control" id="zip" name="zip"/>
              </div>
            </div>
            <br/>
            <!--<button type="submit" class="btn btn-default">Submit</button>-->

            <input type="button" class="btn btn-primary btn-block" value="Next" data-toggle="modal"  id ="sgnupsubmit" disabled="disabled"/>
            <?php } ?>
          
            <!-- button modal -->
            <!--<button class="btn btn-primary" data-toggle="modal" data-target="#signupmodal">Submit</button>-->
            <!-- Modal -->
            <div class="modal fade" id="signupmodal" tabindex="-1" role="dialog" aria-labelledby="signuplabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h4 class="modal-title" id="signuplabel">Information Confirmation</h4>
                  </div>
                  <div class="modal-body">
                    <table class="table">
                      <caption>Please make sure all the information you provided is correct.</caption>
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
                          <th>Username</th>
                          <td id="username_modal"></td>
                      </tr>
                      <tr>
                          <th>Email</th>
                          <td id="email_modal"></td>
                      </tr>
                      <tr>
                          <th>Gender</th>
                          <td id="gender_modal"></td>
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
                    <button type="button" class="btn btn-primary" id="signupbtn" data-loading-text="Loading...">Submit</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal -->
            </div>

            <div class="modal fade" id="signupnotice" tabindex="-1" role="dialog" aria-labelledby="noticelabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h4 class="modal-title" id="noticelabel"></h4>
                  </div>
                  <div class="modal-body">
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal -->
            </div>

            <script>
              //Login Section
              $('#loginsubmit').click(function() {
                
                if(!$('#loginusr').val() || !$('#loginpwd').val()){
                  $("#loginfail").html("<img src='error.png'/> <font color='red'>All filed are Required!</font>");
                }else{

                  $.post( "check.php", { username: $("#loginusr").val(),password: $("#loginpwd").val()}, function (data){
                    if(data != 1){
                      $("#loginfail").html("<img src='error.png'/> <font color='red'>Username or password does not match! Please try again!</font>");
                    }else{
                      $('#loginnotice').removeClass();
                      $('#loginnotice').addClass('alert alert-success');
                      $('#loginnotice').html('<div class="media-left"><img src="success.png" class="media-object"/></div><div class="media-right"><h4 class="media-heading">Login Successful</h4>Welcom back '+$("#loginusr").val()+'<br/>Redirect in 3 seconds...</div>');
                      $('.form-group').remove();
                      setTimeout(function () {
                        location.replace(location.search.substr(10)); 
                      }, 3000);
                    }
                  });
                }

              });


              //Sign Up Section
              /* On FOCUS*/
              $('#username').on('focus', function () {
                $("#userwarn").html("Charactors between 6 ~ 20 ");
              });
              $('#password').on('focus', function () {
                $("#pwdwarn").html("At least 6 characters");
              });
              $('#pwdconfirm').on('focus', function () {
                $("#pwdconwarn").html("Enter Password Again");
              });
              /* On BLUR*/
              $('#fname').on('blur', function () {
                // First name
                if($('#fname').val()){
                  $("#fnamewarn").html("<img src='correct.png'/>");
                  $("#fname").css('background-color','');
                }else{
                  $("#fnamewarn").html("<img src='error.png'/>");
                  $("#fname").css('background-color','pink');
                }
              });
              $('#lname').on('blur', function () {
                // Last name
                if($('#lname').val()){
                  $("#lnamewarn").html("<img src='correct.png'/>");
                  $("#lname").css('background-color','');
                }else{
                  $("#lnamewarn").html("<img src='error.png'/>");
                  $("#lname").css('background-color','pink');
                }
              });
              $('#username').on('blur', function () {
                // Username
                var usr = $('#username').val();
                if(usr.length >= 6){
                  if(usr.match(/([^A-Za-z0-9_-])/) ){
                    $("#userwarn").html("<img src='error.png'/> <font color='red'>Special Characters are Not Allowed</font>");
                    $("#username").css('background-color','pink');
                    $("#usrcheck").val(0);
                  }else{
                    $.post( "check.php", { username: $("#username").val() }, function (data){
                      if(data != 0){
                       $("#userwarn").html("<img src='error.png'/> <font color='red'>Username has been taken</font>");
                       $("#username").css('background-color','pink');
                       $("#usrcheck").val(0);
                      }
                      else{
                       $("#userwarn").html("<img src='correct.png'/>");
                       $("#username").css('background-color','');
                       $("#usrcheck").val(1);
                      }
                    });
                  }
                }else{
                  if(!usr){
                    $("#userwarn").html("<img src='error.png'/> <font color='red'>Username is Required</font>");
                  }else if(usr && usr.length < 6){
                    $("#userwarn").html("<img src='error.png'/> <font color='red'>Username needs at least 6 characters</font>");
                  }
                  $("#username").css('background-color','pink');
                  $("#usrcheck").val(0);
                } 
              });
              
              $('#password').on('keyup blur', function () {
                //password
                if($('#password').val().length >= 6){
                    $("#pwdwarn").html("<img src='correct.png'/>");
                      $("#password").css('background-color','');
                  }else{
                      $("#pwdwarn").html("<img src='error.png'/>");
                      $("#password").css('background-color','pink');
                  }
              });
              $('#pwdconfirm').on('keyup blur', function () {
                //password
                if( !$('#pwdconfirm').val() || $('#password').val() != $('#pwdconfirm').val()){
                    $("#pwdconwarn").html("<img src='error.png'/> <font color='red'>Password Not Match</font>");
                      $("#pwdconfirm").css('background-color','pink');
                  }else{
                      $("#pwdconwarn").html("<img src='correct.png'/> <font color='#339900'>Password Match</font>");
                      $("#pwdconfirm").css('background-color','');
                  }
              });
              $('#email').on('blur', function () {
                // Email
                if(!$("#email").val().match(/([^@]+@[^@]+\.[a-zA-Z]{2,6})/)){
                  $("#emailwarn").html("<img src='error.png'/> <font color='red'>Wrong Format</font>");
                  $("#email").css('background-color','pink');
                  $("#emailcheck").val(0);
                }else{
                  $.post( "check.php", { email: $("#email").val() }, function (data){
                    if(data != 0){
                      $("#emailwarn").html("<img src='error.png'/> <font color='red'>This Email has been registered</font>");
                      $("#email").css('background-color','pink');
                      $("#emailcheck").val(0);
                    }
                    else{
                      $("#emailwarn").html("<img src='correct.png'/>");
                      $("#email").css('background-color','');
                      $("#emailcheck").val(1);
                    }
                  });
                } 
              });
              $('#phone').on('input', function() {
                var number = $(this).val().replace(/[^\d]/g, '')
                $(this).val(number)
              });
              $('#phone').on('blur', function () {
                // phone
                if($('#phone').val().length != 10){
                  $("#phonewarn").html("<img src='error.png'/> <font color='red'>Phone Number should be 10 digits long</font>");
                  $("#phone").css('background-color','pink');
                  $("#phonecheck").val(0);
                }else{
                  $.post( "check.php", { phone: $("#phone").val() }, function (data){
                    if(data != 0){
                      $("#phonewarn").html("<img src='error.png'/> <font color='red'>This Phone Number has been registered</font>");
                      $("#phone").css('background-color','pink');
                      $("#phonecheck").val(0);
                    }
                    else{
                      $("#phonewarn").html("<img src='correct.png'/>");
                      $("#phone").css('background-color','');
                      $("#phonecheck").val(1);
                    }
                  });
                } 
              });
              $('#addr').on('blur', function () {
                // Address
                if(!$('#addr').val()){
                  $("#addrwarn").html("<img src='error.png'/> <font color='red'>Required!</font>");
                  $("#addr").css('background-color','pink');
                }else{
                  $("#addrwarn").html("<img src='correct.png'/>");
                  $("#addr").css('background-color','');
                } 
              });
              $('#city').on('input', function() {
                var number = $(this).val().replace(/[^A-Za-z]/g, '')
                $(this).val(number)
              });
              $('#city').on('blur', function () {
                // City
                if(!$('#city').val()){
                  $("#citywarn").html("<img src='error.png'/> <font color='red'>Required!</font>");
                  $("#city").css('background-color','pink');
                }else{
                  $("#citywarn").html("<img src='correct.png'/>");
                  $("#city").css('background-color','');
                } 
              });
              $('#zip').on('input', function() {
                var number = $(this).val().replace(/[^\d]/g, '')
                $(this).val(number)
              });
              $('#zip').on('blur', function () {
                // Zipcode
                if($('#zip').val().length != 5){
                  $("#zipwarn").html("<img src='error.png'/>");
                  $("#zip").css('background-color','pink');
                }else{
                  $("#zipwarn").html("<img src='correct.png'/>");
                  $("#zip").css('background-color','');
                } 
              });
              $('#signupform input').on('keyup blur', function () {
                var fnameval = $("#fname").val();
                var lnameval = $("#lname").val();
                var usrnameval = 0;                
                if($("#username").val()){
                    usrnameval = 1;
                }
                var pwdval = 0;
                if($('#password').val().length >= 6){
                  pwdval = 1;
                }
                var pwdcon = 0;
                if( $('#pwdconfirm').val() && $('#password').val() == $('#pwdconfirm').val()){
                  pwdcon = 1;
                }
                var emailvar = 0;
                if($("#email").val().match(/([^@]+@[^@]+\.[a-zA-Z]{2,6})/)){
                    emailvar = 1;
                }
                var phonevar = 0;
                if($('#phone').val().length == 10){
                    phonevar = 1;
                }
                var addrvar = $("#addr").val();
                var cityvar = $("#city").val();
                var zipvar = 0;
                if($('#zip').val().length == 5){
                  zipvar = 1;
                }
                //if ($('#signupform').valid()) {
                if (fnameval && lnameval && usrnameval && pwdval && pwdcon && emailvar && phonevar && addrvar && cityvar && zipvar) {
                //if (usrnameval && emailvar && phonevar) {
                  $('#sgnupsubmit').prop('disabled', false);
                } else {
                  $('#sgnupsubmit').prop('disabled', 'disabled');
                }
              });

              $('#sgnupsubmit').click(function() {
                if($("#usrcheck").val() != 1 || $("#phonecheck").val() != 1 || $("#emailcheck").val() != 1){
                  $('#signupnotice').modal('show');
                  var alert='';
                  if($("#usrcheck").val() != 1){alert = '● Username </br>';}
                  if($("#phonecheck").val() != 1){alert += '● Phone </br>';}
                  if($("#emailcheck").val() != 1){alert += '● Email </br>'}
                  $('#signupnotice .modal-title').html("Please fix the following error(s)");
                  $('#signupnotice .modal-body').html("<font color='#FF3300'>"+alert+"</font>");
                  }else{
                  $('#signupmodal').modal('show');
                   /* when the button in the form, display the entered values in the modal */
                  $('#fname_modal').text($('#fname').val());
                  $('#mname_modal').text($('#mname').val());
                  $('#lname_modal').text($('#lname').val());
                  $('#username_modal').text($('#username').val());
                  $('#email_modal').text($('#email').val());
                  if($('#gender').val() == 'M'){
                    $('#gender_modal').text('Male');
                  }else if($('#gender').val() == 'F'){
                    $('#gender_modal').text('Female');
                  }else{
                    $('#gender_modal').text('Do not want to tell')
                  }
                  $('#phone_modal').text($('#phone').val());
                  $('#addr_modal').text($('#addr').val());
                  $('#city_modal').text($('#city').val());
                  $('#state_modal').text($('#state').val());
                  $('#zip_modal').text($('#zip').val());
                }                
              });    

              // when the submit button in the modal is clicked 
              $('#signupbtn').click(function(){
                //result for submission
                $("#signupform").on("submit", function(e) {
                  var postData = $(this).serializeArray();
                  var formURL = $(this).attr("action");
                  $.post( formURL, { fname:$('#fname').val(), mname:$('#mname').val(), lname:$('#lname').val(), username:$('#username').val(),password:$('#password').val(), email:$('#email').val(), gender:$('#gender').val(), phone:$('#phone').val(), addr:$('#addr').val(), city:$('#city').val(), state:$('#state').val(), zip:$('#zip').val()}, function (data){              
                    $('#signupmodal .modal-body').html(data); 
                  });
                  e.preventDefault();
                  setTimeout(function () {
                     location.replace(location.search.substr(10)); 
                  }, 3000);
                });

                // button show loading...
                $(this).button('loading').delay(1000).queue(function() { });
                // modal change
                $('#signupmodal .modal-header .modal-title').html("");
                $('#signupmodal .modal-body').html('<img style="display: block;margin: 0 auto;" src="loading.gif"/>');
                // delay 2 sec, then submit form
                setTimeout(function () {
                     $('#signupform').submit(); 
                  }, 2000);
              });
              $(function () {
                if(location.hash == '#up'){
                  $('#singtab li:eq(1) a').tab('show');
                }else{
                  $('#singtab li:eq(0) a').tab('show');
                }
              });
            </script>
          </form>
        </div>
      </div>
    </div>
    <!-- End of Sign up section -->
  </div><!-- Register -->
</div><!-- Container -->

<br>
<!--
<footer class="container-fluid text-center">
  <p>Online Store Copyright</p>  
  <form class="form-inline">Get deals:
    <input type="email" class="form-control" size="50" placeholder="Email Address">
    <button type="button" class="btn btn-danger">Sign Up</button>
  </form>
</footer>
-->
</body>
</html>
