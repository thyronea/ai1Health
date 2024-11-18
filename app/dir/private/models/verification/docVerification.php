<?php
$check_file = "SELECT * FROM docs WHERE userID='$userID' AND docname='$docname' ";
$check_file_run = mysqli_query($con, $check_file);
?>