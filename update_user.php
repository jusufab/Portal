<?php

include_once("config.php");
include("header.php"); 



$id = $_GET['id']; // get id through query string

$qry = mysqli_query($mysqli,"SELECT * from users where id='$id'"); // select query

$data = mysqli_fetch_array($qry); // fetch data



?>
<form style="margin-left:10px;width:75%;" method="POST" action="update_user_logic.php" enctype="multipart/form-data">
    <input type="hidden" id="id" name="id" value="<?php echo $data['id']; ?>" placeholder="name..." readonly> <br><br>

        <div class="mb-3">
            <label class="form-label">What is the new Username?</label>
            <input type="text" name="username" value="<?php echo $data['username']; ?>"  class="form-control create_input">
            <label class="form-label">What is the new Email?</label>
            <input type="email" name="email" value="<?php echo $data['email']; ?>"  class="form-control create_input">
            <label class="form-label">What is the new Password?</label>
            <input type="password" name="password" class="form-control create_input">
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
<?php
include("footer.php");
?>