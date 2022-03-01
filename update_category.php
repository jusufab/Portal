<?php

include_once("config.php");
include("header.php"); 



$id = $_GET['id']; // get id through query string

$qry = mysqli_query($mysqli,"SELECT * from category where id='$id'"); // select query

$data = mysqli_fetch_array($qry); // fetch data



?>
<form style="margin-left:10px;width:75%;" method="POST" action="update-category-logic.php" enctype="multipart/form-data">
    <input type="hidden" id="id" name="id" value="<?php echo $data['id']; ?>" placeholder="name..." readonly> <br><br>

        <div class="mb-3">
            <label class="form-label">What is the new title of your category?</label>
            <input type="text" name="category" value="<?php echo $data['category_name']; ?>"  class="form-control create_input">
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
<?php
include("footer.php");
?>