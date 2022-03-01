<?php

include_once("config.php");
include("header.php");






?>

<?php

$id1 = $_GET['id']; // get id through query string

$qry = mysqli_query($mysqli, "SELECT * from post where id='$id1'"); // select query

$data = mysqli_fetch_array($qry); // fetch data



?>
<div class="container-fluid">

    <form method="POST" action="updatelogic.php" enctype="multipart/form-data">
        <input type="hidden" id="id" name="id" value="<?php echo $data['id'] ?>" placeholder="name..." readonly>
        <br><br>
        <div class="row">
            <div class="col-sm-8">



                <div class="mb-3 ">
                    <?php if (isset($_SESSION['message'])) : ?>
                    <div class="alert alert-warning " style="width:70%">
                        <?php
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                            unset($_SESSION['alert-class']);
                            ?>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['image-error-2'])) : ?>
                    <div class="alert alert-warning sty  " style="width:70%">
                        <?php
                            echo $_SESSION['image-error-2'];
                            unset($_SESSION['image-error-2']);
                            unset($_SESSION['alert-class']);
                            ?>
                    </div>
                    <?php endif; ?>
                    <label class="form-label ">What is the title of your post?</label>
                    <input type="text" name="title" class="form-control" value="<?php echo $data['title'] ?>"
                        style="width: 80%;" placeholder="Title">

                </div>
                <div style="width: 80%;">
                    <div class="mb-3 ">
                        <label class="form-label ">Post:</label>

                        <textarea name="text" id="editor">
                        <?php echo $data['text'] ?>

  </textarea>
                    </div>
                </div>


                <div class="mb-3">
                    <label class="form-label">Upload Image:</label>
                    <main class="main_full">

                        <div class="container">
                            <div class="panel">
                                <div class="button_outer">
                                    <div class="btn_upload">
                                        <i class="fas fa-upload"></i>
                                        <input id="upload_file" type="file" name="image" />

                                        Upload Image
                                    </div>
                                    <div class="processing_bar"></div>
                                    <div class="success_box"></div>
                                </div>
                            </div>

                        </div>
                    </main>
                </div>



                <input type="hidden" name="admin" value="<?php echo $_SESSION['username']; ?>" class="form-control">
                <button type="submit" name="update" class="btn btn-primary" style="width: 200px; height:50px;">
                    Update</button>
            </div>
            <div class="col-sm-4" style="background-color:#f2f4f5;">

                <main class="main_full">
                    <div class="mb-3">
                        <label class="form-label">What category does your post fit in to?</label>

                        <select name="cat_id" style="width:200px;">
                            <?php
                            $result = mysqli_query($mysqli, "SELECT * FROM category");
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>

                            <option value="<?php echo ($row['id']); ?>"><?php echo ($row['category_name']); ?></option>

                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <?php
                    $post = "SELECT image From post Where id = " . $id1;
                    $result = mysqli_query($mysqli, $post);

                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_assoc($result)) {

                    ?>


                    <div class="container" style="height: 400px;">
                        <div class="panel">
                            <h4>New Image</h4>

                            <div class="uploaded_file_view" id="uploaded_view">

                                <span class="file_remove">X</span>

                            </div>
                            <div class="current-img">
                                <h4>Current Image</h4>
                                <img class="img-fluid mb-3 img-thumbnail" src="postimg/<?= $row['image']; ?>">
                            </div>

                        </div>

                        <?php
                        }
                    }; ?>
                </main>
            </div>
        </div>
    </form>
</div>

<style>
.current-img {
    position: absolute;
    top: 50%
}

.ck p {
    width: 70%;
    height: 400px;
}

.container {
    max-width: 1100px;
    padding: 0 20px;
    margin: 0 auto;
}

.panel {
    max-width: 500px;
    text-align: center;
}

.button_outer {
    background: #4e73df;
    border-radius: 30px;
    text-align: center;
    height: 50px;
    width: 200px;
    display: inline-block;
    transition: 0.2s;
    position: relative;
    overflow: hidden;
}

.btn_upload {
    padding: 17px 30px 12px;
    color: #fff;
    text-align: center;
    position: relative;
    display: inline-block;
    overflow: hidden;
    z-index: 3;
    white-space: nowrap;
}

.btn_upload input {
    position: absolute;
    width: 100%;
    left: 0;
    top: 0;
    width: 100%;
    height: 105%;
    cursor: pointer;
    opacity: 0;
}

.file_uploading {
    width: 100%;
    height: 10px;
    margin-top: 20px;
    background: #ccc;
}

.file_uploading .btn_upload {
    display: none;
}

.processing_bar {
    position: absolute;
    left: 0;
    top: 0;
    width: 0;
    height: 100%;
    border-radius: 30px;
    background: #4e73df;
    transition: 3s;
}

.file_uploading .processing_bar {
    width: 100%;
}

.success_box {
    display: none;
    width: 50px;
    height: 50px;
    position: relative;
}

.success_box:before {
    content: "";
    display: block;
    width: 17px;
    height: 26px;
    border-bottom: 6px solid #fff;
    border-right: 6px solid #fff;
    -webkit-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(42deg);
    position: absolute;
    left: 17px;
    top: 10px;
}

.file_uploaded .success_box {
    display: inline-block;
}

.file_uploaded {
    margin-top: 0;
    width: 50px;
    background: #83ccd3;
    height: 50px;
}

.uploaded_file_view {
    max-width: 500px;
    margin: 10px auto;
    text-align: center;
    position: relative;
    transition: 0.2s;
    opacity: 0;
    border: 2px solid #ddd;
    padding: 15px;
}

.uploaded_file_view img {
    width: 300px;

}

.file_remove {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: block;
    position: absolute;
    background: #aaa;
    line-height: 30px;
    color: #fff;
    font-size: 12px;
    cursor: pointer;
    right: -15px;
    top: -15px;
}

.file_remove:hover {
    background: #222;
    transition: 0.2s;
}

.uploaded_file_view img {
    max-width: 100%;
}

.uploaded_file_view.show {
    opacity: 1;
}

.error_msg {
    text-align: center;
    color: black;
}
</style>

<?php


include("footer.php");




?>
