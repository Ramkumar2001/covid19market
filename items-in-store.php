<?php

session_start();
include 'header.php';
include 'dbs_conn.php';

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

		<?php 

		$mysql = "SELECT * FROM items WHERE item_seller = '{$_SESSION['username']}'";
		$result = mysqli_query($conn,$mysql);

		if(!mysqli_num_rows($result)){
			header('Location: seller-page.php?items=empty');
		}
		else{
			while($row= mysqli_fetch_assoc($result)){
	 echo" <div class='items'>
	 
	 <img style='object-fit:scale-down; width:100px; height:100px; margin-left:20px; margin-top:15px;' src='".$row['item_img']." '>
	
	 <div class='item_desc' style='margin:10px;'>
	 <p class='item_desc'>Name: ".$row['item_name']."</p>
	 <p class='item_desc'>About Item: " .$row['item_description']."</p>
	 <p class='item_desc'>Quantity of item remaining: <span class='ava_qty'>".$row['item_qty']."</span></p>
	 <p class='item_desc'>Price of the item: ". $row['item_price']."</p>
	 </div>
	 <form action='update-items.php?item_id=".$row['item_id']."' method = 'POST' style='margin-left: 30px;'>
	 <input type='number' name='item_qty' placeholder='Update Item Quantity'><br>
	 <input type='text' name='item_img' placeholder='Update Image URL of Item'><br>
	 <input type='text' name='item_name' placeholder = 'Update Item Name'><br>
	 <input type='text' name='item_desc' placeholder = 'Update Item Description'><br>
	 <input type='text' name='item_price' placeholder = 'Update Item Price'><br>
	 <button style='margin:9px;' type='submit' name='submit'>Update</button>
	 <button type='submit' name='remove' formaction='drop-item.php?item_id=".$row['item_id']." '>REMOVE</button>
	 </form>

	</div>";
		}
	}

}

else{
	header('Location:login-page.php');
}


?>