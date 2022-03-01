<?php
require('config.php');

if (isset($_REQUEST['title']) && !empty($_REQUEST['title'])){
 
        $title   = stripslashes($_REQUEST['title']);
        $title    = mysqli_real_escape_string($mysqli,$title);
        $content = stripslashes($_REQUEST['content']);
        $content    = mysqli_real_escape_string($mysqli,$content);

        $query = "INSERT into `draft` (title,content)
        VALUES ( '$title','$content')";
        $result = mysqli_query($mysqli,$query);
        header('Location: dashboard.php');
      }
        ?>