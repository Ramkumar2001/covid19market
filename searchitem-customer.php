<?php 

session_start();

include 'dbs_conn.php';
include 'header.php';

if(isset($_SESSION['$username']) && $_SESSION['role']=='Customer'){


	?>

	<head>
	<link rel="stylesheet" type="text/css" href="styles2.css">
</head>
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
        <div style='margin: 20px auto'>
		<form action='searchitem-customer.php' method='POST'>
			<input type="text" name="searchitem" placeholder='Enter Item Name or Description' style='width: 80%; font-size:25px;'><br><br>
			<button type='submit' name='search' style='font-size:25px;'>Search</button>
		</form>
        </div>
	<?php

	if(isset($_POST['search'])){
		$searchitem = mysqli_real_escape_string($conn, $_POST['searchitem']);
		$mysql = "SELECT * FROM items WHERE item_name LIKE '%$searchitem%' OR item_description LIKE '%$searchitem%'";
		$result = mysqli_query($conn,$mysql);

		if(!mysqli_num_rows($result)){
			echo "<script>
			alert('No items matched what you entered!');
			</script>";
		}
		else{
			while($row= mysqli_fetch_assoc($result)){
	 echo" <div class='items' style='display:flex;'>
	 
	  <img style='object-fit:scale-down; width:100px; height:100px; margin-left:20px; margin-top:15px;' src='".$row['item_img']." '>
	 
	 <div class='item_descr'>
	 <p class='item_desc'>Name: ".$row['item_name']."</p>
	 <p class='item_desc'>About Item: " .$row['item_description']."</p>
	 <p class='item_desc'>Quantity of item remaining: <span class='ava_qty'>".$row['item_qty']."</span></p>
	 <p class='item_desc'>Price of the item: ". $row['item_price']."</p>
	 </div>
     <div class='enterqty' style=''>
	 <form action='additem-customer.php?action=add&item_id=".$row['item_id']." ' method='post'>

	 <input type='text' name='item_qty' value='1'>
	 <input type='hidden' name='item_name' value='".$row['item_name']."'>
	 <input type='hidden' name='item_price' value='".$row['item_price']."'>
	 <input type='hidden' name='item_seller' value='".$row['item_seller']."'>
	 <button type='submit' name='AddToCart'>Add to Cart</button>
     </div> 
	 </form>

	</div>";
}
		}

	}
}
else{
	header('Location: login-page.php');
}