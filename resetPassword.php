<?php
require_once 'emailController.php';


$errors = array();
$username = "";
$email = "";


function resetPassword($token){
   global $mysqli;
   $sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
   $result = mysqli_query( $mysqli, $sql);
   $user = mysqli_fetch_assoc($result);
   $_SESSION['email']= $user['email'];
   header('location: reset_password.php');
}
?>