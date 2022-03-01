<?php

include_once("config.php");

$cat_id = $_GET["value"];

$_SESSION['dashboard_category'] = $cat_id;