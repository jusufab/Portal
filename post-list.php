<?php


include_once("config.php");
include("header.php");

$cat = "all";
if (isset($_GET['cat'])) {
    $cat = $_GET["cat"];
}


?>
<!-- cat_id from GET-->
<div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    <select name="cat_id" class="selectpicker" id="headSelector">
        <option value="all">All</option>
        <?php
        $result1 = mysqli_query($mysqli, "SELECT * FROM category");
        if (mysqli_num_rows($result1)) {
            while ($row1 = mysqli_fetch_assoc($result1)) {
        ?>

        <option value="<?php echo ($row1['id']); ?>"><?php echo ($row1['category_name']); ?></option>

        <?php
            }
        }
        ?>
    </select>


    <script>
    $("#headSelector").change(function(e) {
        //get the value of the selected index.
        value = $(this).val();
        //make an ajax request now
        $.ajax({
            url: 'ajax.php',
            type: 'GET',
            data: {
                value: value
            },
            success: function(success) {
                console.log("success:" + value);
                window.location.href = 'post-list.php?cat=' + value;


            }
        })
    })
    </script>
    <script>
    window.onload = function() {
        var selItem = sessionStorage.getItem("#headSelector");
        $('#headSelector').val(selItem);
    }
    $('#headSelector').change(function() {
        var selVal = $(this).val();
        sessionStorage.setItem("#headSelector", selVal);
    });
    </script>
</div>
<div style="height: 20px;"></div>
<?php
if ($cat == "all") {
    $post = 'SELECT * FROM post ORDER BY date_created DESC, id DESC ';
} else {
    $post = "SELECT * FROM post  WHERE cat_id = '$cat'  ORDER BY date_created DESC, id ASC";
}
$_SESSION['dashboard_category'] = "all";
$result = mysqli_query($mysqli, $post);

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

?>
<?php if (isset($_SESSION['done'])) : ?>
<div class="alert alert-warning sty  " style="width:50%; background-color:#d5d1d1">
    <?php
                echo $_SESSION['done'];
                unset($_SESSION['done']);
                unset($_SESSION['alert-class']);
                ?>
</div>
<?php endif; ?>
<?php if (isset($_SESSION['delete-post'])) : ?>
<div class="alert alert-warning sty  " style="width:50%">
    <?php
                echo $_SESSION['delete-post'];
                unset($_SESSION['delete-post']);
                unset($_SESSION['alert-class']);
                ?>
</div>
<?php endif; ?>
<?php if (isset($_SESSION['updated-post'])) : ?>
<div class="alert alert-warning sty  " style="width:50%">
    <?php
                echo $_SESSION['updated-post'];
                unset($_SESSION['updated-post']);
                unset($_SESSION['alert-class']);
                ?>
</div>
<?php endif; ?>
<div style="height: 20px;"></div>
<div class=" container">
    <div class="row ">
        <div class="col">
            <img class="img-fluid mb-3 img-thumbnail" src="postimg/<?= $row['image']; ?>">
        </div>
        <div class="col-6">
            <a style="font-size:20px;color:black"
                href="../Portal.Web-main/post.php?id=<?= $row['id'] ?>"><?php echo $row['title']; ?></a>


            <p><?php echo $row['date_created']; ?></p>
            <p> By:<?php echo $row['admin_name']; ?></p>

            <p><?php echo $row['description']; ?></p>

        </div>
        <div class="col">
            <a class="btn btn-success" href="update.php?id=<?= $row['id'] ?>">Edit </a>
            <a data-toggle="modal" data-target="#postModal" class="btn btn-danger">DELETE</a>

        </div>

    </div>

</div>



<div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Are you sure to delete this post?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href='delete.php?id=<?php echo $row["id"]; ?>'>Delete</a>
            </div>
        </div>
    </div>
</div>
<?php

    }
} else {
    echo "0 results";
}
mysqli_close($mysqli);

include("footer.php");

?>
<style>
#headSelector {
    width: 128px;
    border-radius: 20px;
    background-color: #4e73df;
    color: white;
    padding: 3px;
    box-sizing:content-box;
}

.selectpicker {
    position: relative;
    left: 76%;
}

.selectpicker option {
    width: 128px;
    color: black;
    background-color: white;
    border-radius: 10px;
}
    div {
    word-wrap: break-word;
}

div .text-content {
    width: 100%;
    word-wrap: break-word;
}
</style>
