<?php

session_start();

if(!isset($_POST['submit'])){
	header('Location: login-page.php');
	exit();
}

else{

	include 'dbs_conn.php';

	$username = $_POST['username'];
	$password = $_POST['password'];

	$mysql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

	$result = mysqli_query($conn, $mysql);


	if(!mysqli_num_rows($result)){
		header('Location: login-page.php?login=invalid');
		exit();
	}

	else{

		$row = mysqli_fetch_array($result);

		if($row['role']=='Customer'){
			header('Location: customer-page.php?username='.$username.'&role='.$row['role']);
			$_SESSION['username'] = $username;
			$_SESSION['$username'] = $username;
			$_SESSION['role'] = $row['role'];
			exit();
		}

		else if($row['role']=='Seller'){
			header('Location: seller-page.php?username='.$username.'&role='.$row['role']);
			$_SESSION['username'] = $username;
			$_SESSION['$username'] = $username;
			$_SESSION['role'] = $row['role'];
            exit();
		}
	}
}