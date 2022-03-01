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
                $post = 'SELECT * FROM post ORDER BY date_created DESC, id DESC ';
            } else {
                $post = "SELECT * FROM post  WHERE cat_id = '$cat'  ORDER BY date_created DESC, id ASC";
            }
            $_SESSION['dashboard_category'] = "all";
            $result = mysqli_query($mysqli, $post);

            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) {
                    $title_field = "title";
                    $content_field = "text";

                    if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'al') {
                        $title_field = "title_al";
                        $content_field = "title_al";
                    }
                    if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'mk') {
                        $title_field = "title_mk";
                        $content_field = "text_mk";
                    }
                    $id = $row['id'];
                    $title = $row[$title_field];
                    $content = $row[$content_field];
                    $discription = substr($content, 0, 160) . "...";
            ?>

            <div class="container">
                <div class="row ">
                    <div class="col-5">
                        <img style="width:100%;" class="img-fluid mb-9 img-thumbnail"
                            src="../Portal-main/postimg/<?= $row['image']; ?>">
                    </div>
                    <div class="col-7">
                        <a href="post.php?id=<?= $row['id'] ?>"><?php echo $title; ?></a>
                        <p><?php $date = $row['date_created'];
                                    echo date("F j, Y ", strtotime($date)); ?></p>
                        <p style="font-size: 20px;"> <?php echo $discription; ?></p>
                    </div>


                </div>
                <hr
                    style=" width: 100%; border: 2px solid; border-color : #ededed ; margin-left : 5px ; border-radius:10px ; background-color:lightgray">

            </div>
            <?php
                }; ?>
            <!-- idea based on example from: https://dev.to/monalishamondol/amazing-pagination-design-using-only-html-css-7gf -->

        </div>
        <div class="col-sm-2 sidenav">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>




            <div class="h2" style="align-items: center;">
                <h2 style="text-align: center;"><?php echo $lang['MENU_Categories']; ?></h2>
            </div>
            <ul name="cat_id" style="text-align: center;">
                <li><a href="index.php">All</a></li>
                <?php
                $result1 = mysqli_query($mysqli, "SELECT * FROM category");
                if (mysqli_num_rows($result1)) {
                    while ($row1 = mysqli_fetch_assoc($result1)) {
                ?>
                <li><a href="index.php?cat=<?php echo ($row1['id']); ?> "><?php echo ($row1['category_name']); ?></a>
                </li>

                <?php
                    }
                }
                ?>
            </ul>
        </div>

        <div class="col-sm-2 sidenav">
            <div class="well">

            </div>
        </div>
    </div>
</div>


<?php


            } else {
                echo "0 results";
            }
            mysqli_close($mysqli);

            include("footer.php");

?>
