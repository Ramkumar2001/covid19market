<?php
session_start();
include 'dbs_conn.php';
include 'header.php';
$username = $_SESSION['username'];

if((isset($_SESSION['$username'])) && ($_SESSION['role']=='Customer')){
?>
<div class='wrapper_customer'>
		<nav class='navbar_customer'>
			<ul>
				<li class='element'><a style='display:block;' href="searchitem-customer.php">Search Item</a> </li>
				<li class='element'><a style='display:block;' href="products-customer.php">Products</a> </li>
				<li class='element'><a style='display:block;' href="incart-customer.php">In Cart</a> </li>
				<li class='element'><a style='display:block;' href="history-customer.php">History</a> </li>
				<li style='background-color: red;'><a style='display:block;' href='logout.php'>Log Out</a></li>
			</ul>
		</nav>

	<?php

	$mysql = "SELECT historycart FROM users WHERE username = '{$username}'";
	$result = mysqli_query($conn,$mysql);
	$row = mysqli_fetch_assoc($result);
	$historycart = unserialize(base64_decode($row['historycart']));

	?>
	 		<table style='margin: 20px auto; border:3px solid black; font-size: 26px; text-align: center;'>
	 			<tr>
	 				<th width='25%' style='padding:3px; border:1px solid black;'>Date of purchase</th>
	 				<th width='25%' style='padding:3px; border:1px solid black;'> Item Name </th>
	 				<th width='25%' style='padding:3px; border:1px solid black;'> Quantity </th>
	 				<th width='25%' style='padding:3px; border:1px solid black;'> Total Price </th>
	 			</tr>	
	 			
	 	<?php		

	foreach ($historycart as $key => $value) {

		?>
		<tr>
			<td width='25%' style='padding:3px; border:1px solid black;'><?php echo $value['purchase_date']; ?> </td>
			<td width='25%' style='padding:3px; border:1px solid black;'><?php echo $value['item_name']; ?> </td>
			<td width='25%' style='padding:3px; border:1px solid black;'><?php echo $value['item_qty']; ?> </td>
			<td width='25%' style='padding:3px; border:1px solid black;'><?php echo $value['item_price']*$value['item_qty']; ?> </td>
		</tr> 	




	 	<?php
	 } 
}
else{
	header('Location: login-page.php');
}