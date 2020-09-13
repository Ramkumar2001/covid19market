<?php

session_start();
$username = $_SESSION['username'];
include 'dbs_conn.php';
if((isset($_SESSION['$username'])) && ($_SESSION['role']=='Customer')){
   $sqli = "SELECT productsincart FROM users WHERE username='{$username}'";
   $result = mysqli_query($conn,$sqli);
   $rowS = mysqli_fetch_assoc($result);

   $incart = unserialize(base64_decode($rowS['productsincart']));
    
   foreach ($incart as $key => $value) {
    $sql = "SELECT item_qty FROM items WHERE item_id = '{$value['item_id']}'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $qty_rem = $row['item_qty'];

    if(($qty_rem - $value['item_qty'])>1)
   	$mysql = "UPDATE items SET item_qty = item_qty - '{$value['item_qty']}' WHERE item_id = '{$value['item_id']}'";

   else{
   	$mysql = "UPDATE items SET item_qty = 0 WHERE item_id ='{$value['item_id']}'";
   }

   	mysqli_query($conn,$mysql);

   }

   $sql = "SELECT historycart FROM users WHERE username = '{$username}'";
   $result = mysqli_query($conn,$sql);
   $row = mysqli_fetch_assoc($result);

   $historycartSS = $row['historycart'];

   if($historycartSS=='YTowOnt9'){
   	$historycartS = unserialize(base64_decode($historycartSS));
   	$historycartS=$incart;
   	$historycart = base64_encode(serialize($historycartS));
   	$sql = "UPDATE users SET historycart = '{$historycart}' WHERE username = '{$username}'";
  
   }
   else{
   	$historycart = array_merge(unserialize(base64_decode($historycartSS)), $incart);
   	$historycartS = base64_encode(serialize($historycart));
   	$sql = "UPDATE users SET historycart = '{$historycartS}' WHERE username = '{$username}'";
   	
} 

 	mysqli_query($conn,$sql);



   $sql = "UPDATE users SET productsincart = 'YTowOnt9' WHERE username = '{$username}'";

   mysqli_query($conn,$sql);
   	header('Location:products-customer.php');

    } 
   