<?php 
require("config.php");

if(isset($_POST['username']) && isset($_POST['password'])){
	$loginusr = trim($_POST['username']);
	$loginpwd = md5(trim($_POST['password']));
	$login_chk = "SELECT id FROM account WHERE username = '".$loginusr."' AND password = '".$loginpwd."'";
	$login_query = mysqli_query($link, $login_chk);
	if(mysqli_num_rows($login_query)){
        session_regenerate_id(true);
        $_SESSION['loginUser'] = $loginusr;
		echo 1;
	}else{
		echo 0;
	}
}else if(isset($_POST['username'])){
	$username = trim($_POST['username']); 
	$usr_chk = "SELECT username FROM account WHERE username = '".$username."'";
	$usr_query = mysqli_query($link, $usr_chk);
	if(mysqli_num_rows($usr_query)){
		echo 1;
	}else{
		echo 0;
	}
}else if(isset($_POST['email'])){
	$email = trim($_POST['email']); 
	$email_chk = "SELECT email FROM account WHERE email = '".$email."'";
	$email_query = mysqli_query($link, $email_chk);
	if(mysqli_num_rows($email_query)){
		echo 1;
	}else{
		echo 0;
	}
}else if(isset($_POST['phone'])){
	$phone = trim($_POST['phone']); 
	$phone_chk = "SELECT phone FROM account WHERE phone = '".$phone."'";
	$phone_query = mysqli_query($link, $phone_chk);
	if(mysqli_num_rows($phone_query)){
		echo 1;
	}else{
		echo 0;
	}
}else{
	echo "Nothing comes in";
}

?>