<?php

include_once("config.php");
include("header.php");

$post = 'SELECT * FROM content';
$result = mysqli_query($mysqli, $post);

if (mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){

?>
<div style="margin:10px;">
    <h3><?php echo $row['contact_title']; ?></h3>
    <p><?php echo $row['contact_text']; ?></p>
    <a class="btn btn-success" href="update_contact.php">Edit</a>
</div>

<?php

}
}else{
    echo "0 results";
}
mysqli_close($mysqli);

include('footer.php');

?>