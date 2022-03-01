<?php

if (isset($_POST['submit'])) {


  $name =  $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $message = $_POST['message'];


  if (empty($name)) {
    $_SESSION['name'] = "<span style='color:red'>Name is Empty</span>";
    header("refresh:0; url=contact.php");
  } elseif (empty($email)) {

    $_SESSION = "Email is empty";
  } elseif (empty($phone)) {
    $_SESSION = "Phone Number is empty";
  } elseif (empty($message)) {
    $_SESSION = "Message is empty";
  } else {

    $to_email = $email;
    $subject = "Message From User";
    $body =  "You have received a new message from your website contact form.\n\n" . "Here are the details:\n\nName: $name\n\nEmail: $email\n\nPhone: $phone\n\nMessage:\n$message";
    $headers = "From: digitalschooltest@gmail.com";

    if (mail($to_email, $subject, $body, $headers)) {

      $_SESSION['sent'] = "<span style='color:lightgreen'>Email was Sent</span>";
      header("refresh:0; url=contact.php?sent");
    } else {
      echo "Not sent";
    }

    $to_email2 = "digitalschooltest@gmail.com";
    $subject2 = "Message From User";
    $body2 =  "You have received a new message from your website contact form.\n\n" . "Here are the details:\n\nName: $name\n\nEmail: $email\n\nPhone: $phone\n\nMessage:\n$message";
    $headers2 = "From: " . $email;

    if (mail($to_email2, $subject2, $body2, $headers2)) {

      $_SESSION['sent'] = "<span style='color:lightgreen'>Email was Sent</span>";
      header("refresh:0; url=contact.php?sent");
    } else {
      echo "Not sent";
    }
  }
}