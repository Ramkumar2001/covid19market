<?php

session_start();
include 'header.php';
include 'dbs_conn.php';

$username = $_SESSION['username'];

if((isset($_SESSION['$username'])) && ($_SESSION['role']=='Customer')){
?>
<head>
<link rel="stylesheet" type="text/css" href="styles2.css">
<style type="text/css">
	table{
		border: 3px solid black;
		margin: 20px auto;
		font-size: 26px;
	}

	table th,td{
		text-align: center;
		border: 1px solid black;
	}

	table a{
		text-decoration: none;
		color: red;
	}
    p{
    	text-align: center;
    }

	p a{
		text-align: center;
		text-decoration: none;
		color: green;
		font-size: 30px;
	}

	p a:hover{
		color: blue;
	}
</style>
</head>
<div class='wrapper_customer'>
		<nav class='navbar_customer'>
			<ul>
				<li class='element'><a style='display:block;' href="searchitem-customer.php">Search Item</a> </li>
				<li class='element'><a style='display:block;' href="products-customer.php">Products</a> </li>
				<li class='element'><a style='display:block;' href="incart-customer.php">In Cart</a> </li>
				<li class='element'><a style='display:block;'  href="history-customer.php">History</a> </li>
				<li style='background-color: red;'><a style='display:block;' href='logout.php'>Log Out</a></li>
			</ul>
		</nav>

		<div class='item-list'>
			<table class='table'>
				<tr>
					<th width='40%'>Item Name</th>
					<th width='10%'>Quantity</th>
					<th width='15%'>Price</th>
					<th width='15%'>Total</th>
					<th width='20%'>Action</th>
				</tr>	
					<?php  
					$mysql = "SELECT productsincart FROM users where username = '{$username}'";

						$result = mysqli_query($conn, $mysql);

						$row = mysqli_fetch_assoc($result);

						$total=0;
					
					    if($row['productsincart']!='YTowOnt9'){
							$item_details_decode = unserialize(base64_decode($row['productsincart']));
							foreach($item_details_decode as $key => $value){ 
							?>
							<tr>
								<td width='40%'><?php echo $value['item_name']; ?></td>

								<td width='10%'><?php echo $value['item_qty']; ?></td>
								<td width='15%'><?php echo $value['item_price']; ?></td>
								<td width='15%'><?php echo ($value['item_qty'] * $value['item_price']) ?></td>
								<?php echo "<td width='20%'><a href='remove-item.php?action=remove&item_id={$key}'>Remove</a></td>"; 
								$total+=($value['item_qty']*$value['item_price']);
								?>
							</tr>
							<?php 

					}
                            ?>
                            <tr>
                            	<td style='border:none;'><p><br><br></p></td>
                            </tr>
					        <tr>
								<td style='background-color: powderblue;' colspan='2'>Total Cost</td>
								<td style='background-color: powderblue;' colspan = '3'><?php echo $total ?></td>
							</tr>

						</table>

							<?php

                     }
						

					 else {

						header('location: products-customer.php?cart=empty');
					}
					?>

					<p><a href="proceed-to-checkout.php">Proceed to checkout</a></p>


					
		</div>
</div>

<?php 

}
else
{
	header('location: login-page.php');
}
?>