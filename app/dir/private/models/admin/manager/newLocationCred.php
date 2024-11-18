<?php
$engineID = mysqli_real_escape_string($con, $_POST['engineID']);
$poc = mysqli_real_escape_string($con, $_POST['poc']);
$name = mysqli_real_escape_string($con, $_POST['name']);
$address1 = mysqli_real_escape_string($con, $_POST['address1']);
$address2 = mysqli_real_escape_string($con, $_POST['address2']);
$city = mysqli_real_escape_string($con, $_POST['city']);
$state = mysqli_real_escape_string($con, $_POST['state']);
$zip = mysqli_real_escape_string($con, $_POST['zip']);
$phone = mysqli_real_escape_string($con, $_POST['phone']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$link = mysqli_real_escape_string($con, $_POST['link']);
$type = mysqli_real_escape_string($con, "Added");

// Check if address exist
$checkaddress = "SELECT * FROM location WHERE address1='$address1'";
$checkaddress_run = mysqli_query($con, $checkaddress);
?>