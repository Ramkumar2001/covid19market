<?php

if(!isset($_POST['submit'])){
  header("Location:registration-form.php");
  exit();
}

else{

require 'dbs_conn.php';

  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $role = $_POST['role'];

  if(empty($email) || empty($role) || empty($username) || empty($password)){
    header('Location: registration-page.php?fields=empty');
    exit();
  }
  else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    header('Location: registration-page.php?email=incorrect');
    exit();
  }
  else if(!preg_match('#[0-9]+#', $password) || !preg_match('#[A-Z]+#', $password) || !preg_match('#[a-z]+#', $password) || strlen($password)<8){
    header('Location: registration-page.php?pw=mismatch');
    exit();
  }

  else{
    $sql = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck!=0){
      header('Location: registration-page.php?username=exist');
      exit();
    }
  }
  if($role=='Customer'){
  $sqlipushdata = "INSERT INTO users(username, emailid, role, password,productsincart,historycart) VALUES ('$username', '$email', '$role', '$password','YTowOnt9','YTowOnt9')";
  mysqli_query($conn, $sqlipushdata);
}
else{
  $sqlipushdata = "INSERT INTO users(username, emailid, role, password) VALUES ('$username', '$email', '$role', '$password')";
  mysqli_query($conn, $sqlipushdata);

}
  header('Location: registration-page.php?registration=successful');
  exit();

}