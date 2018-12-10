<?php
   require("config.php");
   //reg.php
   if($_POST['act'] == "signup"){
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
	   $phone = $_POST['phone'];
	   $addr = $_POST['addr'];
	   $city = $_POST['city'];
	   $state = $_POST['state'];
	   $zip = $_POST['zip'];

		$reg = "INSERT INTO account(username, password, fname, mname, lname, email, phone, addr, city, state, zip) 
		   		VALUES ('".$username."', '".$password."', '".$first_name."', '".$middle_name."', '".$last_name."', '".$email."', '".$phone."', '".$addr."', '".$city."', '".$state."', '".$zip."')";
		$query = mysqli_query($link, $reg);
		echo "Thank you for your registration.<br/>Redirect to where you came from in 3 seconds...";
		
	}else if($_POST['act'] == "sell"){ 
		// sell.php
		$name = $_POST['name'];
		$des = mysqli_real_escape_string($link,$_POST['description']);
		$price = $_POST['price'];
		$item_condition = $_POST['item_condition'];
		$seller = $_POST['seller'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$path = $_POST['path'];
		$issold = $_POST['issold'];
		$buyer = $_POST['buyer'];
		
		$sell = "INSERT INTO product(name, description, price, item_condition, seller, city, state, pic, issold, buyer) 
		   		VALUES ('".$name."', '".$des."', '".$price."', '".$item_condition."', '".$seller."', '".$city."', '".$state."', '".$path."', '".$issold."', '".$buyer."')";
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
	}else if($_POST['act'] == "offer"){ 
		// detail.php -> make offer
		$sender = $_POST['sender'];
		$receiver = $_POST['receiver'];
		$content = mysqli_real_escape_string($link,$_POST['content']);
		
		$chat = "INSERT INTO chat(sender, receiver, content) 
		   		VALUES ('".$sender."', '".$receiver."', '".$content."')";
		$query = mysqli_query($link, $chat);
		echo 1;
	}else if($_POST['act'] == "updateacc"){ 
		//detail.php -> updateaccount, mymanage.php
		$first_name = $_POST['fname'];
		$middle_name = $_POST['mname'];
		$last_name = $_POST['lname'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$addr = $_POST['addr'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zip = $_POST['zip'];
		$username = $_POST['username'];

		$updateacc = "UPDATE account SET fname='".$first_name."', mname='".$middle_name."', lname='".$last_name."', email='".$email."', phone='".$phone."', addr='".$addr."', city='".$city."', state='".$state."', zip='".$zip."' WHERE username='".$username."'";
		$updateacc_query = mysqli_query($link, $updateacc);
		echo 1;
	}else if($_POST['act'] == "buy"){ 
		// detail.php -> make offer
		$itemid = $_POST['itemid'];
		$item = $_POST['item'];
		$buyer = $_POST['buyer'];
		$seller = $_POST['seller'];
		$price = $_POST['price'];
		$rand = rand(100, 999); 
		$orderid = date("YmdHis").$rand;
		$send = "Hello, I have placed an order(#<b>".$orderid."</b>), please confirm it for me, thanks.";
		
		$buy = "INSERT INTO buy(orderid, itemid, item, buyer, seller, price, status) 
		   		VALUES ('".$orderid."', '".$itemid."', '".$item."', '".$buyer."', '".$seller."', '".$price."','0')";
		$buy_query = mysqli_query($link, $buy);
		$buy_mark = "UPDATE product SET issold='1', buyer='".$buyer."' WHERE id='".$itemid."'";
		$buy_mark_query = mysqli_query($link, $buy_mark);
		$chat = "INSERT INTO chat(sender, receiver, content) 
		   		VALUES ('".$buyer."', '".$seller."', '".$send."')";
		$query = mysqli_query($link, $chat);
		echo 1;
	}else if($_POST['act'] == "ordercheck"){ 
		// detail.php -> make offer
		$orderid = $_POST['orderid'];
		
		$ordercheckstr = "SELECT * FROM buy WHERE orderid = ".$orderid;
		$ordercheck_query = mysqli_query($link, $ordercheckstr);
		$ordercheck = mysqli_fetch_array($ordercheck_query);
		$arr = array( 
        'itemid'=>$ordercheck["itemid"], 
        'item'=>$ordercheck["item"], 
        'buyer'=>$ordercheck["buyer"],
        'seller'=>$ordercheck["seller"],
        'price'=>$ordercheck["price"],
        'status'=>$ordercheck["status"],
        'order_time'=>$ordercheck["order_time"]
    	); 
    	echo json_encode($arr);
	}else if($_POST['act'] == "delitem"){ 
		// my.php -> delete sale item
		$itemid = $_POST['itemid'];
		
		$delitem = "DELETE FROM product WHERE id='".$itemid."'";
		$delitem_query = mysqli_query($link, $delitem);
		echo 1;
	}else if($_POST['act'] == "edititemcheck"){ 
		// my.php -> edit sale item
		$itemid = $_POST['itemid'];
		$itemstr = "SELECT * FROM product WHERE id = ".$itemid;
		$item_query = mysqli_query($link, $itemstr);
		$item = mysqli_fetch_array($item_query);
		$arr = array( 
        'name'=>$item["name"], 
        'description'=>$item["description"], 
        'price'=>$item["price"],
        'item_condition'=>$item["item_condition"],
        'city'=>$item["city"],
        'state'=>$item["state"],
        'pic'=>$item["pic"]
    	); 
    	echo json_encode($arr);
	}else if($_POST['act'] == "edititem"){ 
		// my.php -> edit sale item
		$itemid = $_POST['itemid'];
		$name = $_POST['name'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$item_condition = $_POST['item_condition'];
		$city = $_POST['city'];
		$state = $_POST['state']; 

		$upitem_mark = "UPDATE product SET name='".$name."', description='".$description."', item_condition='".$item_condition."', price='".$price."', city='".$city."', state='".$state."' WHERE id='".$itemid."'";
		$buy_mark_query = mysqli_query($link, $upitem_mark);
		echo 1;
	}else if($_POST['act'] == "ordrupstatus"){ 
		// my.php -> update order status
		$orderid = $_POST['orderid'];

		$curstatus = "SELECT status FROM buy WHERE orderid = ".$orderid;
		$curstatus_query = mysqli_query($link, $curstatus);
		$num = mysqli_fetch_array($curstatus_query);
		$next_num = $num["status"]+1;
		
		$uporder = "UPDATE buy SET status='".$next_num."' WHERE orderid='".$orderid."'";
		$buy_mark_query = mysqli_query($link, $uporder);
		echo 1;
	}else if($_POST['act'] == "delorder"){ 
		// my.php -> update order status
		$orderid = $_POST['orderid'];
		$itemid = $_POST['itemid'];
		$sender = $_POST['sender'];
		$receiver = $_POST['receiver'];
		$content = "Hello, I have cancelled the order(#<b>".$orderid."</b>), sorry for the inconvenience.";

		$re_product = "UPDATE product SET issold='0',buyer='N/A' WHERE id='".$itemid."'";
		$re_product_query = mysqli_query($link, $re_product);
		
		$uporder = "DELETE FROM buy WHERE orderid='".$orderid."'";
		$buy_mark_query = mysqli_query($link, $uporder);
		
		$chat = "INSERT INTO chat(sender, receiver, content) 
		   		VALUES ('".$sender."', '".$receiver."', '".$content."')";
		$query = mysqli_query($link, $chat);
		echo 1;
	}else if($_POST['act'] == "buyerinfo"){ 
		// my.php -> update order status
		$username = $_POST['username'];

		$usrstr = "SELECT * FROM account WHERE username = '".$username."'";
		$usr_query = mysqli_query($link, $usrstr);
		$usr = mysqli_fetch_array($usr_query);
		$arr = array( 
        'fname'=>$usr["fname"], 
        'mname'=>$usr["mname"], 
        'lname'=>$usr["lname"],
        'phone'=>$usr["phone"],
        'addr'=>$usr["addr"],
        'city'=>$usr["city"],
        'state'=>$usr["state"],
        'zip'=>$usr["zip"]
    	); 
    	echo json_encode($arr);
	}else{
		echo "Nothing comes in";
	}
?>