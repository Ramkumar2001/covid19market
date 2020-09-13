<?php 

include 'header.php';
include 'dbs_conn.php';

session_start();

if(isset($_GET['cart'])){
	echo "<script>
	alert('Cart is empty! Please add items!');
	</script>";
}

if(isset($_GET['item'])){
	if($_GET['item']=='excess'){
		echo "<script>
		alert('Entered Quantity is more than what is left in store!');
		</script>";
	}

	if($_GET['item']=='alreadyincart'){
        echo "<script>
		alert('Item in cart already');
		</script>";
	}
}

unset($_SESSION['cart']);
$username =$_SESSION['username'];

if((isset($_SESSION['$username'])) && ($_SESSION['role']=='Customer')){


?>
<link rel="stylesheet" type="text/css" href="styles2.css">	
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

		<div class='item-list'>
			<?php 

include 'dbs_conn.php';

$sql = "SELECT item_id, item_description, item_price, item_qty, item_name,item_seller,item_img FROM items;";

$result = mysqli_query($conn, $sql);

if(!mysqli_num_rows($result)){
	header('Location: customer-page.php?store=empty');
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



			?>
		</div>
</div>

<?php 

}
else{
	header('location: login-page.php');
}

