<?php
   require("config.php");
   if(isset($_POST['username']) && isset($_POST['password'])){
	$loginusr = trim($_POST['username']);
	$loginpwd = trim($_POST['password']);
	$login_chk = "SELECT id FROM account WHERE username = '".$loginusr."' AND password = '".$loginpwd."'";
	$login_query = mysqli_query($link, $login_chk);
	if(mysqli_num_rows($login_query)){
		//$row = mysqli_fetch_assoc($login_query);
		session_start();
        session_regenerate_id(true);
        $_SESSION['loginUser'] = $loginusr;
		echo 1;
	}else{
		echo 0;
	}else if(isset($_POST['fname'])){
	   $first_name = $_POST['fname'];
	   if($_POST['mname'] == ''){
	   	$middle_name = NULL;
	   }else{
	   	$middle_name = $_POST['mname'];
		}
	   $last_name = $_POST['lname'];
	   $username = $_POST['username'];
	   $password = $_POST['password'];
	   $email = $_POST['email'];
	   $phone = $_POST['phone'];
	   $addr = $_POST['addr'];
	   $city = $_POST['city'];
	   $state = $_POST['state'];
	   $zip = $_POST['zip'];

		$reg = "INSERT INTO account(username, password, fname, mname, lname, email, phone, addr, city, state, zip) 
		   		VALUES ('".$username."', '".$password."', '".$first_name."', '".$middle_name."', '".$last_name."', '".$email."', '".$phone."', '".$addr."', '".$city."', '".$state."', '".$zip."')";
		$query = mysqli_query($link, $reg);
		echo "Thank you for your registration.<br/>Redirect to where you came from in 3 seconds...";
		
	}else{
		echo "Nothing comes in";
	}
?>