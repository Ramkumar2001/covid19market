<?php

session_start();

include 'dbs_conn.php';

if((isset($_SESSION['$username'])) && ($_SESSION['role']=='Seller')){

if(isset($_POST['submit'])){
	$item_qty = $_POST['item_qty'];
	$item_name = $_POST['item_name'];
	$item_price = $_POST['item_price'];
	$item_desc = $_POST['item_desc'];
	$item_img = $_POST['item_img'];
	$item_seller = $_SESSION['username'];

	$sql = "INSERT INTO items (item_qty, item_name, item_price, item_description, item_img, item_seller) 
	        VALUES('{$item_qty}', '{$item_name}', '{$item_price}', '{$item_desc}', '{$item_img}', '{$item_seller}')";

	mysqli_query($conn,$sql);

	header('Location: add-items.php?add=success');         

}

}
else{
	header('Location:login-page.php');
}