<?php

include_once("config.php");


if (isset($_POST['update'])) {

  $id4 =  $_POST['id'];
  $title =  $_POST['title'];
  $text = $_POST['text'];
  $image = $_FILES['image']['name'];
  $target = "postimg/" . basename($image);
  $desc = substr($text, 0, 170) . "...";
  $update2 = "UPDATE category SET * = '$category'";
  $category = $_POST['cat_id'];

  $post = 'SELECT * FROM post ';

  $result1 = mysqli_query($mysqli, $post);

  if (mysqli_num_rows($result1) > 0) {

    while ($row = mysqli_fetch_assoc($result1)) {


      if (empty($image)) {

        $edit2 = mysqli_query($mysqli, $update2);

        $edit = mysqli_query($mysqli, "UPDATE post SET   title = '$title' ,  text = '$text' , description = '$desc', cat_id = '$category'  WHERE id=$id4");

        $_SESSION['updated-post'] = "<span style='color:green'>You Updated It Successfully</span>";

        header('Location: post-list.php');
      } else {

        $sql_u1 = "SELECT image FROM post WHERE image='$image'";
        $res_u1 = mysqli_query($mysqli, $sql_u1);
        if (mysqli_num_rows($res_u1) > 0) {
          $_SESSION['image-error-2'] = "<span style='color:red'>Please Change Image Name</span>";
          header("Refresh:0;url=update.php?id=" .  $row['id']);
        } else {

          $edit2 = mysqli_query($mysqli, $update2);
          $edit = mysqli_query($mysqli, "UPDATE post SET title = '$title' , image = '$image', text = '$text' , description =
'$desc', cat_id = '$category' WHERE id=$id4");

          if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $_SESSION['updated-post'] = "<span style='color:green'>You Updated It Successfully</span>";
            header('Location: post-list.php');
          } else {
            $msg = "Failed to upload image";
          }
        }
      }
      $query = mysqli_query($mysqli, "SELECT * from post where id=$id4");

      $data = mysqli_fetch_array($query);

      $post = 'SELECT email FROM users';
      $result = mysqli_query($mysqli, $post);

      if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

          $to_email = $row['email'];
          $subject = "Post Updated";
          $body = "Post " . $data['title'] . " has been updated.";
          $headers = "From: digitalshchooltest@gmail.com";

          if (mail($to_email, $subject, $body, $headers)) {
          } else {
            echo ("Email sending failed...");
          }
        }
      }
    }
  }
}
