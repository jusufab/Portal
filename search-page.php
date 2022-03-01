<?php

include_once("config.php");
include("header.php");

$s_item = $_POST['searchitem'];

$searchsel = "SELECT * FROM post WHERE text LIKE '%" . $s_item . "%' OR title LIKE '%" . $s_item . "%'";

$result = $mysqli->query($searchsel);
if (!mysqli_num_rows($result)) {

    echo "There is no post containing " . $s_item . ".";
}

while ($row = $result->fetch_assoc()) {

?>

<div class=" container">
    <div class="row ">
        <div class="col">
            <img class="img-fluid mb-3 img-thumbnail" src="postimg/<?= $row['image']; ?>">
        </div>
        <div class="col-6">
            <a style="font-size:20px;color:black" href="post.php?id=<?= $row['id'] ?>"><?php echo $row['title']; ?></a>


            <p><?php echo $row['date_created']; ?></p>
            <p> By:<?php echo $row['admin_name']; ?></p>

            <p><?php echo $row['description']; ?></p>

        </div>
        <div class="col">
            <a class="btn btn-success" href="update.php?id=<?= $row['id'] ?>">Edit </a>
            <a onclick="return confirm('Are you sure you want to delete this post?');" class="btn btn-danger"
                href="delete.php?id=<?= $row['id'] ?>"> Delete</a>
        </div>

    </div>

</div>

<?php

}


include("footer.php");

?>