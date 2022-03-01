<?php

include_once("config.php");

if(isset($_POST['update'])) 
{  

    $title =  $_POST['contact_title'];   
    $text = $_POST['contact_text'];

    $sql = "UPDATE content SET contact_title='$title', contact_text='$text'";

    if ($mysqli->query($sql) === TRUE) {
        echo "Record updated successfully";
        header('Location: contact.php');
    } else {
        echo "Error updating record: " . $mysqli->error;
    }

    $mysqli->close();

}

?>