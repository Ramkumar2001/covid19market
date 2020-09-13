<?php

include 'header.php';
include 'dbs_conn.php';

session_start();
$username = $_SESSION['$username'];
if((isset($_SESSION['$username'])) && ($_SESSION['role']=='Seller')){
	?>

	<head>
	<link rel="stylesheet" type="text/css" href="styles2.css">
	<style>
		table{
			border: 2px solid black;
			margin: 30px auto;
			font-size: 20px;
			text-align: center;
		}

		table th,td{
			border: 1px solid black;
			padding: 9px;
		}

	</style>	
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


	<?php

	$mysql = "SELECT historycart, username, emailid FROM users WHERE role='Customer' ";
	$result = mysqli_query($conn,$mysql);

	echo "<table>
					<tr>
						<th>Date of Purchase</th>
						<th>Name of Customer</th>
						<th>Email ID of Customer</th>
						<th>Name of Item purchased</th>
						<th>Quantity</th>
					</tr>";
	
	while($row = mysqli_fetch_assoc($result)){
		$historycart = unserialize(base64_decode($row['historycart']));
		$usernameCus = $row['username'];
		$email = $row['emailid'];

		foreach ($historycart as $key => $value) {
			if($value['item_seller']==$username){
				$flag=1;
				?>
				<tr>
					<td><?php echo $value['purchase_date']; ?></td>
					<td><?php echo $usernameCus; ?></td>
					<td><?php echo $email; ?></td>
					<td><?php echo $value['item_name']; ?></td>
					<td><?php echo $value['item_qty']; ?></td>
				</tr>

				<?php
			}
		}
	
}
if($flag!=1){
	header('Location: seller-page.php?customerinfo=none');
}

echo "<p>Click <a href='graph.php'>here</a> to view the number of items sold on a monthly basis</p>";

}
else{
	header('Location: login-page.php');
}