<?php
require('config.php');
require_once 'emailController.php';
require_once 'verifyUser.php';

$errors = array();
$username = "";
$email = "";

if (isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];
  
    if(empty($username)){
        $errors['username'] = "Username required";
    }
   
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "email IS INVALID";
    }

    if(empty($email)){
        $errors['email'] = "email required";
    }

    if(empty($password)){
        $errors['password'] = "password required";
    }

    if($password !== $passwordConf){
        $errors['password'] = "password not matched";
    }
     
    $emailQuery = "SELECT * FROM users WHERE email=? LIMIT 1";
    $stmt = $mysqli->prepare($emailQuery);
    $stmt->bind_param('s',$email);
    $stmt->execute();
    $result = $stmt->get_result();
    $userCount = $result->num_rows;

    if($userCount > 0){
        $errors['email'] = "Email already exists";
    }

    if(count($errors)=== 0){
       $password = password_hash($password, PASSWORD_DEFAULT);
       $token = bin2hex(random_bytes(50));
       $verified = false;

       $sql = "INSERT INTO users (username, email, verified, token, password) VALUES (?,?,?,?,?)";
       $stmt = $mysqli->prepare($sql);
       $stmt->bind_param('ssbss',$username, $email, $verified, $token, $password);
       
       
       if($stmt->execute()){
          
        $user_id = $mysqli->insert_id;
        $_SESSION['id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['verified'] = $verified;
        
        sendVerificationEmail($email, $token);
        
        
        $_SESSION['message'] = "You are now logged in!";
        $_SESSION['alert-class'] = "alert-success";
        header('location: index.php');
        exit();
       } else{
           $errors['db_error'] = "Database error: failed to register";
       }
    }
    
}

?>
