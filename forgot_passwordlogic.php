<?php
include_once('config.php');
require_once 'emailController.php';

$errors = array();
$username = "";
$email = "";


if(isset($_POST['submit'])){
    $email= $_POST['email'];
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
     $errors['email'] = "email IS INVALID";
 }
 
 if(empty($email)){
     $errors['email'] = "email required";
 }
 
 if(count($errors)== 0){
     $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
     $result = mysqli_query($mysqli, $sql);
     $user = mysqli_fetch_assoc($result);
     $token = $user['token'];
     sendPasswordResetLink($email ,$token);
     header('location: password_message.php');
 }
 }

?>