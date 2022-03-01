<?php
ob_start();
include_once("config.php");
include_once("header.php");



include_once('authController.php');

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    verifyUser($token);
}

if (isset($_GET['password-token'])) {
    $passwordToken = $_GET['password-token'];
    resetPassword($passwordToken);
}


?>
<?php
if (isset($_SESSION['message'])) : ?>
<div class="alert <?php echo $_SESSION['alert-class']; ?> ">
    <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
</div>
<?php endif; ?>
<?php if ($_SESSION['verified'] == 0) : ?>
<div class="alert alert-warning">
    Verify your Account!!!
    <?php echo $_SESSION['email']; ?>
</div>
<?php endif; ?>
<div class="container-fluid">

    <!-- Page Heading -->


    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="h3 mb-0 font-weight-bold text-gray-800"> Recently Published
                    </div>

                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <?php
                                $post = 'SELECT title FROM post ORDER BY id DESC LIMIT 3';
                                $result = mysqli_query($mysqli, $post);

                                if ($result->num_rows > 0) {

                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <li class="list-group-item"><?= $row['title'] ?></li>
                                <?php
                                    }
                                } else {
                                    echo "0 results";
                                }

                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="h3 mb-0 font-weight-bold text-gray-800">Number of Posts</div>

                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                <div style="height: 10px;"></div>
                                <?php
                                $result = $mysqli->query("SELECT * FROM post");
                                $row_cnt = $result->num_rows;
                                ?>
                                <h5 class="card-title"><i class="fas fa-thumbtack"></i> <?= $row_cnt ?> Posts</h5>
                                <?php

                                ?>
                            </div>

                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="h3 mb-0 mr-3 font-weight-bold text-gray-800">Drafts</div>

                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                <?php
                                $draft = 'SELECT * FROM draft';
                                $result = mysqli_query($mysqli, $draft);

                                if ($result->num_rows > 0) {

                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>

                                <li class="list-group-item"><?= $row['title'] ?></li>

                                <?php
                                    }
                                } else {
                                    echo "0 results";
                                }
                                mysqli_close($mysqli);

                                ?>
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                </div>

                            </div>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->

    </div>


    <div class="col-xl-9 col-lg-10">
        <div class="card shadow mb-4">

            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                <div class="col">
                    <form action="draft.php" method="post">
                        <h3 class="m-0 font-weight-bold text-primary">Create Draft</h3>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Title</label>
                            <input style="width:23rem;" type="text" class="form-control" id="exampleFormControlInput1"
                                name="title">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Content</label>
                            <input style="width:23rem;" class="form-control" id="exampleFormControlTextarea1" rows="3"
                                name="content"></input>
                        </div>
                        <input type="submit" class="btn btn-primary" value="save draft"></input>
                    </form>
                </div>

            </div>


            <?php
            include("footer.php");

            ob_end_flush();
            ?>
