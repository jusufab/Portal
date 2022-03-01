<?php

include_once("config.php");
include("header.php");

?>

<body>
    <div class="bs-example">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                     <div class="page-header clearfix">
                        <h2 class="pull-left">Categories</h2>
                        <div class="new-cat">
                            <a href="create_new_category.php" class=" btn btn-primary ">Create New Category</a>
                        </div>
                    <?php
                    $result = mysqli_query($mysqli, "SELECT * FROM category");
                    ?>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                    ?>
                    <table class='table table-bordered table-striped'>
                        <tr>
                            <td>
                                <h3> Category Name</h3>
                            </td>
                            <td>
                                <h3>Update</h3>
                            </td>
                            <td>
                                <h3>Delete</h3>
                            </td>


                        </tr>
                        <?php
                            $i = 0;
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                        <tr>
                            <td>
                                <h4><?php echo $row["category_name"]; ?><h4>
                            </td>

                            <td><a class="btn btn-success"
                                    href="update_category.php?id=<?php echo $row["id"]; ?>">Update</a></td>
                            <td><a data-toggle="modal" data-target="#deleteModal" class="btn btn-danger"
                                    href="delete_category.php?id=<?php echo $row["id"]; ?>">Delete</a></td>


                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Are you sure to delete this
                                            category and all posts in this category?</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button"
                                                data-dismiss="modal">Cancel</button>
                                            <a class="btn btn-danger"
                                                href="delete_category.php?id=<?php echo $row["id"]; ?>">Delete</a></td>

                                        </div>
                                    </div>
                                </div>
                            </div>




                        </tr>
                        <?php
                                $i++;
                            }
                            ?>
                    </table>
                    <?php
                    } else {
                        echo "No result found";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

<?php

include("footer.php");

?>
    <style>
    .page-header {
    position: relative;
}


.new-cat {
    position: absolute;
    top: 0px;
    right: 0px;
}
    </style>
