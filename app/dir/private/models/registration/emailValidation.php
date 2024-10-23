<?php
$check_admin = "SELECT * FROM admin WHERE email='$email'";
$check_admin_run = mysqli_query($con, $check_admin);

?>