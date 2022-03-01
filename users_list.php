<?php

include_once("config.php");
include("header.php");

?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="people-nearby">
                <h1 style="text-align: center;">Users List</h1>

                <div class="nearby-user">

                    <div class="row">
                        <?php
                        $result = mysqli_query($mysqli, "SELECT * FROM users");
                        ?>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                        ?>

                        <?php
                            $i = 0;
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                        <div class="col-md-2 ">
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="user"
                                class="profile-photo-lg">
                        </div>
                        <div class="col-md-7 col-sm-7">
                            <h5><a href="#" class="profile-link"><?php echo $row["username"]; ?></a></h5>
                            <p class="text-muted"><?php echo $row["email"]; ?></p>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <a data-toggle="modal" data-target="#userModal" class="btn btn-danger">DELETE</a>

                        </div>
                        <div class="modal fade" id="userModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure ?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Are you sure to delete this user?</div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button"
                                            data-dismiss="modal">Cancel</button>
                                        <a class="btn btn-danger"
                                            href='delete_user.php?id=<?php echo $row["id"]; ?>'>Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                                $i++;
                            }
                            ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<?php
                        } else {
                            echo "No result found";
                        }
?>
<?php

include("footer.php");

?> <style>
.people-nearby .google-maps {
    background: #f8f8f8;
    border-radius: 4px;
    border: 1px solid #f1f2f2;
    padding: 30px;
    margin-bottom: 20px;
}

.people-nearby .google-maps .map {
    height: 300px;
    width: 100%;

    border: none;
}

.people-nearby .nearby-user {
    padding: 40px 0;
    border-top: 1px solid #f1f2f2;
    border-bottom: 1px solid #f1f2f2;
    margin-bottom: 20px;
}

img.profile-photo-lg {
    height: 70px;
    width: 70px;
    border-radius: 50%;
    border: 1px solid #000000;
}
</style>
