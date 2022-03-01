<?php
include_once 'config.php';
$sql = "DELETE FROM users WHERE id='" . $_GET["id"] . "'";
if (mysqli_query($mysqli, $sql)) {
    header('Location: users_list.php');

} else {
echo "Error deleting record: " . mysqli_error($mysqli);
}
mysqli_close($mysqli);
?>