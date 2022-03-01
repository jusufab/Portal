<?php 
    session_start();
    $url = "http://localhost/Portal-main";
    $mysqli = new mysqli("localhost","root","","db_portal");


    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }
 ?>
