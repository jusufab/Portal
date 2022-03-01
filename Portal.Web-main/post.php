<?php

include_once("config.php");
include_once("header.php");


$id1 = $_GET['id'];

$singlepost = "SELECT * FROM post WHERE id=$id1";

$result = mysqli_query($mysqli, $singlepost);

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
        $title_field = "title";
        $content_field = "text";

        if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'al') {
            $title_field = "text_al";
            $content_field = "text_al";
        }
        if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'mk') {
            $title_field = "text_mk";
            $content_field = "text_mk";
        }
        $id = $row['id'];
        $title = $row[$title_field];
        $content = $row[$content_field];
?>

<div class="container">
    <div class="row">
        <!-- Post content-->
        <div class="col-lg-12">
            <!-- Title-->
            <div class="title" style="text-align:center; padding: 10px">
                <h1 class="mt-4"><?php echo $title; ?></h1>
                <!-- Author-->
            </div>


            <br>
            <!-- Preview image-->
            <div class="image" style="text-align:center; padding: 10px">
                <img src="../Portal-main/postimg/<?= $row['image']; ?>">
            </div>
            <br>
            <div class="text-content">
                <p><?php echo $content; ?></p>
            </div>


            <hr />

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