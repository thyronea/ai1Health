<?php
$userID = mysqli_real_escape_string($con, $_SESSION['userID']);
$engineID = mysqli_real_escape_string($con, $_SESSION['engineID']);
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$email = mysqli_real_escape_string($con, $_SESSION['email']);
$dob = mysqli_real_escape_string($con, $_POST['dob']);
$gender = mysqli_real_escape_string($con, $_POST['gender']);
$race = mysqli_real_escape_string($con, $_POST['race']);
$ethnicity = mysqli_real_escape_string($con, $_POST['ethnicity']);
$address1 = mysqli_real_escape_string($con, $_POST['address1']);
$address2 = mysqli_real_escape_string($con, $_POST['address2']);
$city = mysqli_real_escape_string($con, $_POST['city']);
$state = mysqli_real_escape_string($con, $_POST['state']);
$zip = mysqli_real_escape_string($con, $_POST['zip']);
$phone = mysqli_real_escape_string($con, $_POST['phone']);
$mobile = mysqli_real_escape_string($con, $_POST['mobile']);
?>