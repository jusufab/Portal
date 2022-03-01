<?php 
    session_start();

    $mysqli = new mysqli("localhost","root","","db_portal");


    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }
 ?>
