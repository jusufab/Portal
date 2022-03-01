<?php

include_once("config.php");

if(isset($_POST['update'])) 
{  

    $title =  $_POST['aboutus_title'];   
    $text = $_POST['aboutus_text'];

    $sql = "UPDATE content SET aboutus_title='$title', aboutus_text='$text'";

    if ($mysqli->query($sql) === TRUE) {
        echo "Record updated successfully";
        header('Location: about_us.php');
    } else {
        echo "Error updating record: " . $mysqli->error;
    }

    $mysqli->close();

}

?>