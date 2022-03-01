<?php

include_once("config.php");





if(isset($_POST['update']) && !empty($_POST['category']))
{

    $id4 =  $_POST['id'];
    $cat = $_POST['category'];
    $edit = mysqli_query($mysqli, "UPDATE category SET   category_name = '$cat'  WHERE id=$id4");

    if($edit)
    {
        header('Location: display_category.php');
    }
    else
    {
        echo "update failed" ;
       }  
}


?>