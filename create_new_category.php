<?php
  include_once('config.php');
  include('header.php');
  ?>
<form style="margin-left:10px;width:70%" method="POST" action="create-category-logic.php">
  <div class="mb-3">
    <label class="form-label">New Category</label>
    <input type="text" name="category" class="form-control" require>
    

  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  </form>

  <?php 
  include('footer.php');
  ?>