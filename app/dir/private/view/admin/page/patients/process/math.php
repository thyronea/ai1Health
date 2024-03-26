<?php

$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);

// Count Male
$query = "SELECT count(*) FROM diversity WHERE groupID='$groupID' AND gender='Male' ";
$query_run = mysqli_query($con, $query);
$male = mysqli_fetch_array($query_run);

// Count Female
$query = "SELECT count(*) FROM diversity WHERE groupID='$groupID' AND gender='Female' ";
$query_run = mysqli_query($con, $query);
$female = mysqli_fetch_array($query_run);

// Count All Patients
$query = "SELECT count(*) FROM patients WHERE groupID='$groupID' ";
$query_run = mysqli_query($con, $query);
$all = mysqli_fetch_array($query_run);

// Count Pediatric
$query = "SELECT count(*) FROM patients WHERE groupID='$groupID' AND (YEAR(NOW()) - YEAR(dob)) BETWEEN 0 AND 18";
$query_run = mysqli_query($con, $query);
$peds = mysqli_fetch_array($query_run);

// Count Adult
$query = "SELECT count(*) FROM patients WHERE groupID='$groupID' AND (YEAR(NOW()) - YEAR(dob)) BETWEEN 19 AND 100";
$query_run = mysqli_query($con, $query);
$adult = mysqli_fetch_array($query_run);
?>
