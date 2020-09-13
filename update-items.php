<?php

session_start();

include 'dbs_conn.php';

if((isset($_SESSION['$username'])) && ($_SESSION['role']=='Seller')){
if(isset($_POST['submit'])){
	if(isset($_GET['item_id'])){
		$item_qty; 
		$item_name;
		$item_img;
		$item_desc;
		$item_price;
		$item_id = $_GET['item_id'];
		$item_seller = $_SESSION['username'];

		$mysql = "SELECT * FROM items WHERE item_id = '{$item_id}' AND item_seller = '{$item_seller}'";
		$result = mysqli_query($conn,$mysql);
		$row = mysqli_fetch_assoc($result);

		if($_POST['item_qty']!=''){
			$item_qty = $_POST['item_qty'];
		}
		else{
			$item_qty = $row['item_qty'];
		}
		if($_POST['item_desc']!=''){
			$item_desc = $_POST['item_desc'];
		}
		else{
			$item_desc = $row['item_description'];
		}
		if($_POST['item_name']!=''){
			$item_name = $_POST['item_name'];
		}
		else{
			$item_name = $row['item_name'];
		}
		if($_POST['item_img']!=''){
			$item_img = $_POST['item_img'];
		}
		else{
			$item_img = $row['item_img'];
		}
		if($_POST['item_price']!=''){
			$item_price = $_POST['item_price'];
		}
		else{
			$item_price = $row['item_price'];
		}

		echo $item_qty, $item_name, $item_price;

 		$sql = "UPDATE items SET item_qty='{$item_qty}', item_name='{$item_name}', item_img='{$item_img}', item_description='{$item_desc}', item_price='{$item_price}' WHERE  item_id='{$item_id}' AND item_seller='{$item_seller}'";
		mysqli_query($conn,$sql);
	}

}

header('Location:items-in-store.php');

}

else{
	header('location: login-page.php');
}


