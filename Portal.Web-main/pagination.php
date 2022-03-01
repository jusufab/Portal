<?php
//define total number of results you want per page  
$results_per_page = 5;

//find the total number of results stored in the database  
$query = "SELECT * From post";
$result = mysqli_query($mysqli, $query);
$number_of_result = mysqli_num_rows($result);

//determine the total number of pages available  
$number_of_page = ceil($number_of_result / $results_per_page);

//determine which page number visitor is currently on  
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

//determine the sql LIMIT starting number for the results on the displaying page  
$page_first_result = ($page - 1) * $results_per_page;

//retrieve the selected results from database   
$query = "SELECT * FROM post LIMIT " . $page_first_result . ',' . $results_per_page;
$result = mysqli_query($mysqli, $query);
?>
<?php
//display the retrieved result on the webpage  
while ($row = mysqli_fetch_array($result)) {

?>
<div class="container">
    <div class="row ">
        <div class="col">
            <img style="width:300px;" class="img-fluid mb-9 img-thumbnail" src="../Portal-main/postimg/<?= $row['image']; ?>">
        </div>
        <div class="col-6">
            <a style="font-size:30px;color:black" href="post.php?id=<?= $row['id'] ?>"><?php echo $row['title']; ?></a>
            <p><?php echo $row['date_created']; ?></p>
            <p style="font-size: 20px;"><?php echo $row['description']; ?></p>
        </div>


    </div>
    <p> Admin:<?php echo $row['admin_name']; ?></p>

</div>
<?php
}; ?>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
  <?php
//display the link of the pages in URL  
for ($page = 1; $page <= $number_of_page; $page++) {

    echo '<li class="page-item"><a class="page-link" href = "index.php?page=' . $page . '">' . $page . ' </a> </li>';
}
?>
  </ul>
</nav>
