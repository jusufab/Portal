<?php
include_once 'config.php';
$sql = "DELETE FROM category WHERE id='" . $_GET["id"] . "'";
if (mysqli_query($mysqli, $sql)) {
    header('Location: display_category.php');

} else {
echo "Error deleting record: " . mysqli_error($mysqli);
}
mysqli_close($mysqli);
?>