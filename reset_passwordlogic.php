<?php
include_once('config.php');
require_once 'emailController.php';

$errors = array();
$username = "";
$email = "";

if(isset($_POST['submit'])){
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];
    
    if(empty($password) ){
     $errors['password'] = "password required";
 }
 
 if($password !== $passwordConf){
     $errors['password'] = "password not matched";
 }
 
 $password = password_hash($password, PASSWORD_DEFAULT);
 $email = $_SESSION['email'];
 
  if(count($errors)== 0){
      $sql = "UPDATE users SET password='$password' where email='$email'";
      $result = mysqli_query($mysqli, $sql);
      if($result){
          header('location: login.php');
      }
     }
 
 }

 ?>