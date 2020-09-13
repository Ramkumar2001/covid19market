<?php

session_start();

include 'dbs_conn.php';

if(isset($_SESSION['$username']) && $_SESSION['role']=='Seller'){
if(isset($_GET['item_id'])){
	$item_id = $_GET['item_id'];

	$sql = "DELETE FROM items WHERE item_id='{$item_id}'";
	mysqli_query($conn,$sql);

	$mysql = "SELECT productsincart,username FROM users";
	$result = mysqli_query($conn,$mysql);

	while($row=mysqli_fetch_assoc($result)){
		$productsincart = unserialize(base64_decode($row['productsincart']));
		$item_id_array = array_column($productsincart,'item_id');
		for ($i=0; $i<count($productsincart);$i++){
			if($productsincart[$i]['item_id']==$item_id){
				unset($productsincart[$i]);
				$mod = array_values($productsincart);
				$mod_encode = base64_encode(serialize($mod));
				$sql = "UPDATE users SET productsincart = '{$mod_encode}' WHERE username = '{$row['username']}'";
			mysqli_query($conn,$sql);
			}
		}
		
			
		}

		header('Location:items-in-store.php');
	



}

}
else{
	header('Location:login-page.php');
}