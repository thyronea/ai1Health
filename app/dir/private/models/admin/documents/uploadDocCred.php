<?php
$maxsize = 2097152;
$rand_name = rand(1000,9999);
$status = mysqli_real_escape_string($con, "Uploaded a");
$type = mysqli_real_escape_string($con, $_POST['type']);
$message = mysqli_real_escape_string($con, "document");
$docname = $_FILES["docname"]["name"];
$tempname = $_FILES["docname"]["tmp_name"];
$folder = '../../../uploads';
?>