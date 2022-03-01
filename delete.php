<?php
include_once 'config.php';
$sql = "DELETE FROM post WHERE id='" . $_GET["id"] . "'";
$email = mysqli_query($mysqli, "SELECT email FROM users ");
$post = mysqli_query($mysqli, "SELECT * FROM post WHERE id='" . $_GET["id"] . "' ");
$post2 = mysqli_num_rows($post);
$data = mysqli_fetch_assoc($post);

if (mysqli_num_rows($email) > 0) {
    while ($row = mysqli_fetch_assoc($email)) {

        //if($row > 0){


        $to_email = $row['email'];


        if ($data > 0) {
            $subject = "Digital School Post Updates";
            $body = "Admin : " . $data['admin_name'] . " just deleted a post with the title : " . $data['title'] . " on : " . $data['date_created'];
            $headers = "From: digitalSchool@gmail.com";
            if (mail($to_email, $subject, $body, $headers)) {
                echo $data['admin_name'];
            } else {
                echo ("Email sending failed...");
            }

            // }else {
            //         echo "te dhenat nuk u kapen";
            //     }



        }
    }
} else {
    echo " nuk ban $username";
}

if (mysqli_query($mysqli, $sql)) {
    $_SESSION['delete-post'] = "<span style='color:green'>you deleted it successfully</span>";
    header('Location: post-list.php');
} else {
    echo "Error deleting record: " . mysqli_error($mysqli);
}
mysqli_close($mysqli);