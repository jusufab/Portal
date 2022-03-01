<?php

include_once("config.php");
include("header.php");

$post = 'SELECT * FROM content';
$result = mysqli_query($mysqli, $post);

if (mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){

?>

<form style="width:75%;margin-left:10px;" method="POST" action="contact_logic.php">

        <div class="mb-3">
            <label class="form-label">New title?</label>
            <input type="text" name="contact_title" value="<?php echo $row['contact_title'] ?>"  class="form-control create_input">
        </div>
        <div class="mb-3">
            <label class="form-label">Post:</label>
            <textarea name="contact_text" id="editor" value="<?php echo $row['contact_text'] ?>"></textarea>
        </div>
        <button type="submit" name="update" class="btn btn-primary">update</button>
</form>

<?php

}
}else{
    echo "0 results";
}
mysqli_close($mysqli);

include('footer.php');

?>