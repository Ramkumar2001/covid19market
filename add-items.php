<?php

session_start();
include 'header.php';
include 'dbs_conn.php';

if(isset($_GET['add'])){
	if($_GET['add']=='success'){
	echo "<script>
		alert('Item added successfully!');
		</script>";
	}
}



if((isset($_SESSION['$username'])) && ($_SESSION['role']=='Seller')){

	?>

	<head>
	<link rel="stylesheet" type="text/css" href="styles2.css">
    </head>
	<div class='wrapper_customer'>
		<nav class='navbar_customer'>
			<ul>
				<li class='element'><a style='display:block;' href="items-in-store.php">Items in store</a> </li>
				<li class='element'><a style='display:block;' href="add-items.php">Add Items</a> </li>
				<li class='element'><a style='display:block;' href="customer-information.php">Customer Information</a> </li>
				<li style='background-color: red;'><a style='display:block;' href='logout.php'>Log Out</a></li>
			</ul>
		</nav>

		<div class='newitem' style='border:2px solid black; padding:30px; margin-top: 20px;'>
			<h2 style='text-align: center; padding:5px;'>ENTER DETAILS OF NEW ITEM TO BE ADDED</h2>
			<form action='add-new-item.php' method='POST'>
				<p style='text-align: center'><input style='font-size:20px; padding:3px; margin-bottom:5px;' type='text' name='item_name' placeholder='Item Name' required><br></p>
				<p style='text-align: center'><input style='font-size:20px; padding:3px; margin-bottom: 5px;' type='text' name='item_img' placeholder='Item Image URL' required><br></p>
				<p style='text-align: center'><input style='font-size:20px; padding:3px; margin-bottom: 5px;' type='text' name='item_qty' placeholder='Item Quantity' required><br></p>
				<p style='text-align: center'><input style='font-size:20px; padding:3px; margin-bottom: 5px;' type='text' name='item_desc' placeholder='Item Description' required><br></p>
				<p style='text-align: center'><input style='font-size:20px; padding:3px; margin-bottom: 5px;' type='text' name='item_price' placeholder='Item Price' required><br></p>
				<p style='text-align: center'><button type='submit' name='submit'>ADD NEW ITEM</button></p>
			</form>
		</div>	

	<?php
}

else{
	header('Location: login-page.php');
}

?>