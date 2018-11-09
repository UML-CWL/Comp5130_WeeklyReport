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
  </style>
</head>
<body>
<?php
require("config.php");
require("navbar.php");
?>
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
          <form class="form-horizontal" role="form" action="" id="loginform">
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
            <input type="button" class="btn btn-primary btn-block" value="Next" data-toggle="modal"  id ="sgnupsubmit" disabled="disabled"/>
            <?php } ?>
          
            <!-- button modal -->
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
          </form>
        </div>
      </div>
    </div>
    <!-- End of Sign up section -->
  </div><!-- Register -->
</div><!-- Container -->

<br>
</body>
</html>
