<?php
require_once 'emailController.php';


$errors = array();
$username = "";
$email = "";

function verifyUser($token)
{
  global $mysqli;
  $sql = "SELECT * FROM users WHERE token ='$token' LIMIT 1";
  $result = mysqli_query($mysqli, $sql);
  
  if(mysqli_num_rows($result)>0){
      $user = mysqli_fetch_assoc($result);
      $update_query = "UPDATE users SET verified =1 WHERE token='$token'";
      
      if(mysqli_query($mysqli, $update_query)){
        
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['verified'] = 1;
        
        $_SESSION['message'] = "You are verified!";
        $_SESSION['alert-class'] = "alert-success";
        


      }else{
          echo 'User not found!';
      }
  } 
}