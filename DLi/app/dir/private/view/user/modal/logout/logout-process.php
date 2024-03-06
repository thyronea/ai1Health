<?php
session_start();
require "../../../private/access/dbcon.php";

// updates vcode
$new_vcode = rand(1000,9999); // Generates random verification token
$update_vcode = "UPDATE token SET v_code='$new_vcode' WHERE userID='$userID' ";
$update_vcode_run = mysqli_query($con, $update_vcode);

session_destroy();
header("Location: /public/page/logout.php");
exit(0);

?>
