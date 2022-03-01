<?php include("config.php"); ?>
<?php include("header.php"); ?>


<div class="container-fluid text-center">
    <div class="row content">

        <div class="col-sm-10 text-left">
            <?php

            $cat = "all";
            if (isset($_GET['cat'])) {
                $cat = $_GET["cat"];
            }
            ?>
            <?php
            if ($cat == "all") {
                $post = 'SELECT * FROM post';
            } else {
                $post = 'SELECT * FROM post WHERE cat_id = ' . $cat;
            }
            $_SESSION['dashboard_category'] = "all";
            $result = mysqli_query($mysqli, $post);


            if (isset($_GET['pageno'])) {

                $pageno = $_GET['pageno'];
            } else {
                $pageno = 1;
            }
            $no_of_records_per_page = 4;
            $offset = ($pageno - 1) * $no_of_records_per_page;


            $total_pages_sql = "SELECT COUNT(*) FROM post";
            $result = mysqli_query($mysqli, $total_pages_sql);
            $total_rows = mysqli_fetch_array($result)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);


            $sql = "SELECT * FROM post LIMIT $offset, $no_of_records_per_page";
            $res_data = mysqli_query($mysqli, $sql);
            while ($row = mysqli_fetch_array($res_data)) {
                //here goes the data

            ?>
            <div class="container">
                <div class="row ">
                    <div class="col">
                        <img class="img-fluid mb-9 img-thumbnail" src="../Portal-main/postimg/<?= $row['image']; ?>">
                    </div>
                    <div class="col-6">
                        <a style="font-size:30px;color:black"
                            href="post.php?id=<?= $row['id'] ?>"><?php echo $row['title']; ?></a>
                        <p><?php echo $row['date_created']; ?></p>
                        <p style="font-size: 20px;"><?php echo $row['description']; ?></p>
                    </div>


                </div>
                <p> Admin:<?php echo $row['admin_name']; ?></p>

            </div>
            <?php
            };
            ?>


        </div>
        <div class="col-sm-2 sidenav">
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
        </div>


    </div>
</div>
<nav aria-label="...">
    <ul class="pagination pagination- lg">
        <li class="page-item disabled"><a class=" page-link" href="index.php?page=1">First</a></li>
        <li class="<?php if ($pageno <= 1) {
                        echo 'disabled';
                    } ?>">
            <a href="<?php if ($pageno <= 1) {
                            echo '#';
                        } else {
                            echo "?page=" . ($pageno - 1);
                        } ?>">Prev</a>
        </li>
        <li class="page-item" class="<?php if ($pageno >= $total_pages) {
                                            echo 'disabled';
                                        } ?>">
            <a href="<?php if ($pageno >= $total_pages) {
                            echo '#';
                        } else {
                            echo "?page=" . ($pageno + 1);
                        } ?>">Next</a>
        </li>
        <li class="page-item"><a class="page-link" href="category.php?page=<?php echo $total_pages; ?>">Last</a></li>
    </ul>
</nav>
<?php



include("footer.php");

?>

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
            window.location.href = 'category.php?cat=' + value;


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