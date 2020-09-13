<?php

session_start();

include 'dbs_conn.php';


if(isset($_GET['item_id'])){
	$keyVal = $_GET['item_id'];
	$username = $_SESSION['username'];

	unset($_SESSION['cart'][$keyVal]);

	$mysql = "SELECT productsincart FROM users where username = '{$username}'";

	$result = mysqli_query($conn, $mysql);
	$row = mysqli_fetch_assoc($result);

	$item_details_decode = unserialize(base64_decode($row['productsincart']));

	unset($item_details_decode[$keyVal]);

	$modified_item_details_decode = array_values($item_details_decode);

	//for($i=$keyVal;$i<count($item_details_decode);$i++)
		//$item_details_decode[$i] = $item_details_decode[$i+1];

	

   print_r($modified_item_details_decode);

	$item_details_encode = base64_encode(serialize($modified_item_details_decode));

	$sql = "UPDATE users SET productsincart = '{$item_details_encode}' WHERE username = '{$username}'";

	mysqli_query($conn,$sql);

	header('Location: incart-customer.php');


}

else{
	header('Location: incart-customer.php');
}