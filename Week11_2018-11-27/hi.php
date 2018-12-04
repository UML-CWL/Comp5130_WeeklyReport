<?php
   require("config.php");
   //reg.php
   if(isset($_POST['fname'])){
	   $first_name = $_POST['fname'];
	   if($_POST['mname'] == ''){
	   	$middle_name = NULL;
	   }else{
	   	$middle_name = $_POST['mname'];
		}
	   $last_name = $_POST['lname'];
	   $username = $_POST['username'];
	   $password = md5($_POST['password']);
	   $email = $_POST['email'];
	   $gender = $_POST['gender'];
	   $phone = $_POST['phone'];
	   $addr = $_POST['addr'];
	   $city = $_POST['city'];
	   $state = $_POST['state'];
	   $zip = $_POST['zip'];

		$reg = "INSERT INTO account(username, password, fname, mname, lname, email, gender, phone, addr, city, state, zip) 
		   		VALUES ('".$username."', '".$password."', '".$first_name."', '".$middle_name."', '".$last_name."', '".$email."', '".$gender."', '".$phone."', '".$addr."', '".$city."', '".$state."', '".$zip."')";
		$query = mysqli_query($link, $reg);
		echo "Thank you for your registration.<br/>Redirect to where you came from in 3 seconds...";
		
	}else if($_POST['act'] == "sell"){ 
		// sell.php
		$name = $_POST['name'];
		$des = mysqli_real_escape_string($link,$_POST['description']);
		$quan = $_POST['quantity'];
		$price = $_POST['price'];
		$type = $_POST['type'];
		$seller = $_POST['seller'];
		$path = $_POST['path'];
		$issold = $_POST['issold'];
		$buyer = $_POST['buyer'];
		
		$sell = "INSERT INTO product(name, description, quantity, price, category, seller, pic, issold, buyer) 
		   		VALUES ('".$name."', '".$des."', '".$quan."', '".$price."', '".$type."', '".$seller."', '".$path."', '".$issold."', '".$buyer."')";
		$query = mysqli_query($link, $sell);
		echo 1;
	}else if($_POST['act'] == "chat"){ 
		// chat.php
		$sender = $_POST['sender'];
		$receiver = $_POST['receiver'];
		$content = mysqli_real_escape_string($link,$_POST['content']);
		
		$chat = "INSERT INTO chat(sender, receiver, content) 
		   		VALUES ('".$sender."', '".$receiver."', '".$content."')";
		$query = mysqli_query($link, $chat);
		echo 1;
	}else{
		echo "Nothing comes in";
	}
?>