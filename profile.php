<?php include('config.php'); ?>
<?php include('header.php'); ?>


<?php

$username = $_SESSION['username'];

$qry = mysqli_query($mysqli, "SELECT * from users where username='$username'"); // select query

$data = mysqli_fetch_array($qry); // fetch data


?>
<link href="css/sb-admin-2.min.css" rel="stylesheet">

<body class="bg-gradient-primary">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-12 col-md-9">


                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col">
                                <div class="p-5">
                                    <div class="text-center">

                                        <h1 class="h4 text-gray-900 mb-4">Profile</h1>
                                    </div>
                                    <?php if (isset($_SESSION['passwordc'])) : ?>
<div class="alert alert-warning sty  " style=" color:red">
    <?php
        echo $_SESSION['passwordc'];
        unset($_SESSION['passwordc']);
        unset($_SESSION['alert-class']);
        ?>
</div>
<?php endif; ?>
                                    
                                
                                    <form class="user" method="POST" action="profile-update-logic.php">
                                        <input type="hidden" name="id" value="<?php echo $data['id'] ?>">




                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                value="<?php echo $data['email'] ?>" id="exampleInputEmail"
                                                placeholder="Email Address" required>

                                        </div>
                                        <div class="form-group ">

                                            <input type="text" name="username" class="form-control form-control-user"
                                                value="<?php echo $data['username'] ?>" id="exampleFirstName"
                                                placeholder="Username" required>

                                        </div>
                                        <div class="form-group">

                                            <input type="password" name="password"
                                                class="form-control form-control-user" id="exampleLastName"
                                                placeholder="Password" required>


                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="passwordConf"
                                                class="form-control form-control-user" id="exampleInputEmail"
                                                placeholder="Confirm Password" required>
                                        </div>
                                        <input type="submit" value="Update Account" name="submit-reg"
                                            class="btn btn-primary btn-user btn-block">
                                </div>







                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>










        </div>
    </div>

    </div>

    <?php include('footer.php'); ?>