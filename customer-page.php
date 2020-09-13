<?php
session_start();
if((isset($_SESSION['$username'])) && ($_SESSION['role']=='Customer')){	

include 'header.php';

if(isset($_GET['store'])){
	echo "<script>
	alert('Store is Empty!');
	</script>";
}

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

		<div class="welcome_msg">
			<?php 
				$username = $_SESSION['$username'];
				$role = $_SESSION['role'];

			echo "<h1>Welcome $username</h1><br>";
			      echo "<h3>Domain: $role</h3>";
			   

			?>

			<p>Click on products to find avaliable items and them to cart!</p>
		</div>

	</div>

<?php 

}

else{
	header('Location: login-page.php');
}

?>