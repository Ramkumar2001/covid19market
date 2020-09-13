<?php

include 'dbs_conn.php';

session_start();
$username = $_SESSION['$username'];

if(isset($_SESSION['$username']) && $_SESSION['role']=='Customer'){

	if(isset($_POST['AddToCart'])){

	$mysql = "SELECT productsincart FROM users where username = '{$username}'";
	$result = mysqli_query($conn,$mysql);
	$row = mysqli_fetch_assoc($result);
	$cart_items = unserialize(base64_decode($row['productsincart']));
	$countItems = count($cart_items);
	$_SESSION['cart'] = $cart_items;
	$item_array_id = array_column($_SESSION['cart'], 'item_id');
	    if(!in_array($_GET['item_id'], $item_array_id)){
	    	$item_id = $_GET['item_id'];
	    	$mysqli = "SELECT item_qty FROM items WHERE item_id = '{$item_id}'";
	    	$result = mysqli_query($conn,$mysqli);
	    	$rowQty = mysqli_fetch_assoc($result);
	    	if($_POST['item_qty'] <= $rowQty['item_qty']){
			$item_array = array(
           'item_id' => $_GET['item_id'],
           'item_name' => $_POST['item_name'],
           'item_price' => $_POST['item_price'],
           'item_qty' => $_POST['item_qty'],
           'purchase_date' => date('Y/m/d'),
           'item_seller' => $_POST['item_seller'],
           'month_sold' => date('n')
		   );
			//array_push($_SESSION['store'], $item_array);
			$_SESSION['cart'][$countItems] = $item_array;
			$item_detail_encode = base64_encode(serialize($_SESSION['cart']));

			$sql = "UPDATE users SET productsincart = '{$item_detail_encode}' WHERE username = '{$username}'";

			mysqli_query($conn,$sql);
		}
		else{
			header('Location: products-customer.php?item=excess');
			exit();

		}
		}
		else{

			header('Location: products-customer.php?item=alreadyincart');
			exit();
		}

		header('Location: products-customer.php');
		exit();
}
}
else{
	header('Location: login-page.php');
	exit();
}