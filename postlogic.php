<?php
include_once('config.php');
$msg = "";
$errors = array();

if (isset($_POST['submit'])) {

  $title =  $_POST['title'];
  $text =  $_POST['content'];

  $title_al =  $_POST['title_al'];
  $text_al =  $_POST['content_al'];

  $title_mk =  $_POST['title_mk'];
  $text_mk =  $_POST['content_mk'];

  $admin =  $_POST['admin'];
  $image = $_FILES['image']['name'];
  $target = "postimg/" . basename($image);
  $date = date('d-m-Y');
  $desc = substr($text, 0, 170) . "...";
  $category = $_POST['cat_id'];

  $_SESSION['title1'] = $title;
  $_SESSION['text1'] = $text;



  if (empty($text) || empty($title)) {
    $_SESSION['content'] = "<span style='color:red'>please insert content</span>";
    $_SESSION['title'] = "<span style='color:red'>please insert title</span>";
    header("Location:createpost.php");
  } else {

    $sql_u1 = "SELECT image FROM post WHERE image='$image'";
    $res_u1 = mysqli_query($mysqli, $sql_u1);
    if (mysqli_num_rows($res_u1) == 1) {
      $_SESSION['message'] = "<span style='color:red'>please change image name</span>";
      header("Refresh:0.2; url=createpost.php");
    } else {

      $sql_e = "SELECT id FROM category WHERE category_name='$category'";

      $insert = "INSERT INTO post(title,title_al,title_mk,text,text_al,text_mk,image,date_created,description,admin_name,cat_id) VALUES ('$title','$title_al','$title_mk','$text','$text_al','$text_mk','$image',UTC_TIMESTAMP(),'$desc','$admin','$category')";
      $insert2 = "INSERT INTO category(id) VALUES ('$category')";


      mysqli_query($mysqli, $insert);
      mysqli_query($mysqli, $insert2);

      if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        unset($_SESSION['title1']);
        unset($_SESSION['text1']);

        header('Location: post-list.php');
      } else {
        $msg = "Failed to upload image";
      }
      $email = mysqli_query($mysqli, "SELECT email FROM users ");

      if (mysqli_num_rows($email) > 0) {
        while ($row = mysqli_fetch_assoc($email)) {

          if ($row > 0) {
            $to_email = $row['email'];
            $subject = "Digital School";
            $body = "Admin : $admin just created a new Post with the title : $title on : $date";
            $headers = "From: digitalSchool@gmail.com";

            if (mail($to_email, $subject, $body, $headers)) {
              $_SESSION['done'] = "<span style='color:green'>Post was Created Successfully</span>";

              header('Location: post-list.php');
            } else {
              echo ("Email sending failed...");
            }
          }
        }
      } else {
        echo " nuk ban $username";
      }
    }
  }
}