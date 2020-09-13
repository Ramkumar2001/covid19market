<?php
session_start();
if((isset($_SESSION['$username'])) && ($_SESSION['role']=='Seller')){	

include 'header.php';

if(isset($_GET['items'])){
	echo "<script>
	alert('No items in store');
	</script>";
}
if(isset($_GET['customerinfo'])){
	echo "<script>
	alert('No items sold!');
	</script>";
}

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

		<div class="welcome_msg">
			<?php 
			if(isset($_SESSION['username'])){
				$username = $_SESSION['username'];
				$role = $_SESSION['role'];

			echo "<h1>Welcome $username</h1><br>";
			      echo "<h3>Domain: $role</h3>";
			   }

			?>

			<p></p>
		</div>

	</div>

<?php 

}

else{
	header('Location: login-page.php');
}

?>
