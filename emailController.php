<?php

require_once 'vendor/autoload.php';
include_once("config.php");

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
  ->setUsername('digitalschooltest@gmail.com ')
  ->setPassword('digitalschool');;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);



function sendVerificationEmail($userEmail, $token)
{
  global $mailer;

  $body = '<!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       
       <title>Verify email</title>
   </head>
   <body>
       <div class="wrapper">
       <p>
         Thank you for signing up on our email!!
       </p>
       <a href="http://localhost/Portal-main/dashboard.php?token=' . $token . '">
       Verify your email address
       </a>
   
       </div>
   </body>
   </html> 
   ';
  // Create a message
  $message = (new Swift_Message('Verify your email'))
    ->setFrom('21leodinho21@gmail.com')
    ->setTo($userEmail)
    ->setBody($body, 'text/html');

  // Send the message
  $result = $mailer->send($message);
}


function sendPasswordResetLink($userEmail, $token)
{

  global $mailer;

  $body = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        
        <title>Verify email</title>
    </head>
    <body>
        <div class="wrapper">
        <p>
          Click on the link to reset your password
        </p>
        <a href="http://localhost/Portal-main/dashboard.php?password-token=' . $token . '">
        Reset your password
        </a>
    
        </div>
    </body>
    </html>';

  // Create a message
  $message = (new Swift_Message('Reset your password'))
    ->setFrom('digitalschooltest@gmail.com')
    ->setTo($userEmail)
    ->setBody($body, 'text/html');

  // Send the message
  $result = $mailer->send($message);
}