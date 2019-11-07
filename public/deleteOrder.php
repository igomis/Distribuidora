<?php
require dirname(__FILE__) . "/../config/load.php";
if (isset($_POST['empty']))
    unset($_SESSION['order']);
header("Location: categories.php");
