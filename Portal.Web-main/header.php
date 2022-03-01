<?php

// Set Language variable
if (isset($_GET['lang']) && !empty($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];

    if (isset($_SESSION['lang']) && $_SESSION['lang'] != $_GET['lang']) {
        echo "<script type='text/javascript'> location.reload(); </script>";
    }
}

// Include Language file
if (isset($_SESSION['lang'])) {
    include "lang/lang_" . $_SESSION['lang'] . ".php";
} else {
    include "lang/lang_en.php";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Digital School Portal</title>
    <link rel="icon" type="image/x-icon" href="assets/digital-school.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800"
        rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/footer.css" rel="stylesheet" />
</head>

<body>


    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="assets/img/logo.png"></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php"><?php echo $lang['MENU_HOME']; ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php"><?php echo $lang['MENU_ABOUT_US']; ?></a>
                    </li>
                    <li class="nav-item"><a class="nav-link"
                            href="contact.php"><?php echo $lang['MENU_CONTACT_US']; ?></a></li>


                    <li class="nav-item"><a class="nav-link btn btn-primary btn-lg active" role="button"
                            href="../Portal-main/login.php"> <?php echo $lang['MENU_Login']; ?></a></li>
                    <li class="nav-item"> <a href="index.php?lang=al"><img src="assets/img/al.png"
                                style="width: 30px;"></a>
                    </li>

                    <li class="nav-item"> <a href="index.php?lang=en"><img src="assets/img/en.png" style="width: 30px;">
                        </a>
                    </li>
                    <li class="nav-item"> <a href="index.php?lang=mk"><img src="assets/img/mk.png" style="width: 30px;">
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('assets/img/back.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>DigitalSchool</h1>
                        <span class="subheading">A Blog Theme by DigitalSchool Students</span>
                    </div>
                </div>
            </div>
        </div>
    </header>