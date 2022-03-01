<?php

include_once("config.php");
include("header.php");

$post = 'SELECT * FROM content';
$result = mysqli_query($mysqli, $post);

if (mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){

?>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <h3><?php echo $row['aboutus_title']; ?></h3>
            <p><?php echo $row['aboutus_text']; ?></p>
        </div>
    </div>
</div>

<?php

}
}else{
    echo "0 results";
}
mysqli_close($mysqli);

include('footer.php');

?>
