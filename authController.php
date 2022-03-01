<?php
include_once('config.php');
include_once('emailController.php');
?>
<?php
$errors = array();
$username = "";
$email = "";

// register.php
if (isset($_POST['submit-reg'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];

    if (empty($username)) {
        $errors['username'] = "Username required";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "email IS INVALID";
    }

    if (empty($email)) {
        $errors['email'] = "email required";
    }

    if (empty($password)) {
        $errors['password'] = "password required";
    }

    if ($password !== $passwordConf) {
        $errors['password'] = "password not matched";
    }

    $sql_u = "SELECT * FROM users WHERE username='$username'";
    $sql_e = "SELECT * FROM users WHERE email='$email'";
    $res_u = mysqli_query($mysqli, $sql_u);
    $res_e = mysqli_query($mysqli, $sql_e);

    if (mysqli_num_rows($res_u) > 0) {
        $errors['username-db'] = "This Username Is Arledy Taken";
    }
    if (mysqli_num_rows($res_e) > 0) {
        $errors['email-db'] = "This Email Is Arledy Taken";
    }

    $emailQuery = "SELECT * FROM users WHERE email=? LIMIT 1";
    $stmt = $mysqli->prepare($emailQuery);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $userCount = $result->num_rows;

    if ($userCount > 0) {
        $errors['email'] = "Email already exists";
    }

    if (count($errors) === 0) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $token = bin2hex(random_bytes(50));
        $verified = false;

        $sql = "INSERT INTO users (username, email, verified, token, password) VALUES (?,?,?,?,?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ssbss', $username, $email, $verified, $token, $password);


        if ($stmt->execute()) {

            $user_id = $mysqli->insert_id;
            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = $verified;

            sendVerificationEmail($email, $token);


            $_SESSION['message'] = "You are now logged in!";
            $_SESSION['alert-class'] = "alert-success";
            header('location: dashboard.php');
            exit();
        } else {
            $errors['db_error'] = "Database error: failed to register";
        }
    }
}




// login.php
if (isset($_POST['submit-log'])) {
    $username = $_POST['username'];

    $password = $_POST['password'];

    if (empty($username)) {
        $errors['username'] = "Username required";
    }


    if (empty($password)) {
        $errors['password'] = "password required";
    }

    if (count($errors) === 0) {
        $sql = "SELECT * FROM users WHERE email=? OR username=? LIMIT 1";
        $wrongUsernames = "SELECT username FROM users ";
        $Result = mysqli_query($mysqli, $wrongUsernames);

        if (mysqli_num_rows($Result) == 0) {
            $errors['wrong-username'] = "This Username Do Not Exist";
        } else {


            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('ss', $username, $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['verified'] = $user['verified'];


                $_SESSION['message'] = "You are now logged in!";
                $_SESSION['alert-class'] = "alert-success";
                header('location: dashboard.php');
                exit();
            } else {
                $errors['login_fail'] = "Wrong credentials";
            }
        }
    }
}




//forgot_password.php
if (isset($_POST['submit-forgot'])) {
    $email = $_POST['email'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "email IS INVALID";
    }

    if (empty($email)) {
        $errors['email'] = "email required";
    }

    if (count($errors) == 0) {
        $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $result = mysqli_query($mysqli, $sql);
        $user = mysqli_fetch_assoc($result);
        $token = $user['token'];
        sendPasswordResetLink($email, $token);
        header('location: password_message.php');
        exit(0);
    }
}




//reset_password.php
if (isset($_POST['submit-reset'])) {
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];

    if (empty($password)) {
        $errors['password'] = "password required";
    }

    if ($password !== $passwordConf) {
        $errors['password'] = "password not matched";
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $email = $_SESSION['email'];

    if (count($errors) == 0) {
        $sql = "UPDATE users SET password='$password' where email='$email'";
        $result = mysqli_query($mysqli, $sql);
        if ($result) {
            header('location: login.php');
            exit(0);
        }
    }
}








function resetPassword($token)
{
    global $mysqli;
    $sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
    $result = mysqli_query($mysqli, $sql);
    $user = mysqli_fetch_assoc($result);
    $_SESSION['email'] = $user['email'];
    header('location: reset_password.php');
    exit(0);
}


function verifyUser($token)
{
    global $mysqli;
    $sql = "SELECT * FROM users WHERE token ='$token' LIMIT 1";
    $result = mysqli_query($mysqli, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $update_query = "UPDATE users SET verified =1 WHERE token='$token'";

        if (mysqli_query($mysqli, $update_query)) {

            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['verified'] = 1;
            $_SESSION['message'] = "You are verified!";
            $_SESSION['alert-class'] = "alert-success";
            header("Location:dashboard.php");
            exit();
        } else {
            echo 'User not found!';
        }
    }
}