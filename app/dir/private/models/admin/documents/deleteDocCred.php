<?php
$delete_ID = mysqli_real_escape_string($con, $_POST['file_ID']);
$delete_userID = mysqli_real_escape_string($con, $_POST['file_userID']);
$delete_groupID = mysqli_real_escape_string($con, $_POST['file_groupID']);
$delete_docname = mysqli_real_escape_string($con, $_POST['file_docname']);
$delete_type = mysqli_real_escape_string($con, $_POST['file_type']);
$type = mysqli_real_escape_string($con, "Deleted");
$message = mysqli_real_escape_string($con, "a Document");
?>