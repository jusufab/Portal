<?php

include_once("config.php");



if (isset($_POST['submit-reg'])) {


    $id4 =  $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $temppassword = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];


    $password = password_hash($temppassword, PASSWORD_DEFAULT);

    if ($temppassword !== $passwordConf) {
        $_SESSION['passwordc'] = "password not matched";
        header("Location:profile.php");
    } else {

        if (!empty($_POST['password'])) {

            $edit = mysqli_query($mysqli, "UPDATE users SET username = '$username', email = '$email' , password = '$password'  WHERE id=$id4");
        } else {
            $edit = mysqli_query($mysqli, "UPDATE users SET username = '$username', email = '$email'   WHERE id=$id4");
        }
        if ($edit) {
            $_SESSION['passwordsuccess'] = "Updated Successfully .</br> Please Login";

            header('Location: login.php');
        } else {
            echo "update failed";
        }
    }
}