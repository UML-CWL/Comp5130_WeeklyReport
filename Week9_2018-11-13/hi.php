<?php
   require("config.php");

   if($_POST['act'] == "sell"){ 
		// sell.php
		$name = $_POST['name'];
		$des = $_POST['description'];
		$quan = $_POST['quantity'];
		$price = $_POST['price'];
		$type = $_POST['type'];
		$seller = $_POST['seller'];
		$path = $_POST['path'];
		$issold = $_POST['issold'];
		$buyer = $_POST['buyer'];
		
		$sell = "INSERT INTO product(name, description, quantity, price, type, seller, pic, issold, buyer) 
		   		VALUES ('".$name."', '".$des."', '".$quan."', '".$price."', '".$type."', '".$seller."', '".$path."', '".$issold."', '".$buyer."')";
		$query = mysqli_query($link, $sell);
		echo 1;
	}else{
		echo "Nothing comes in";
	}
?>