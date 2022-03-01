<?php
  include_once('config.php');
  
  if (isset($_POST['submit']) && !empty($_POST['category'])) {   


    $cat = $_POST['category'];

    $query = "INSERT into category (category_name) VALUES ('$cat')";
    $result = mysqli_query($mysqli,$query);

    if($result){
        header('Location: display_category.php');
    }
    else {
        echo "failed to create new category";
    }


  }
  else {
      echo "fill all";
  }
  
  ?>