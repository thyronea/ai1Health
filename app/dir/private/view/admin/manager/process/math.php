<?php
require_once('../../../initialize.php');
include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');

// Count total Admin
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$query = "SELECT count(*) FROM admin WHERE groupID='$groupID' AND role='Admin' ";
$query_run = mysqli_query($con, $query);
$admin = mysqli_fetch_array($query_run);

// Count total User
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$query = "SELECT count(*) FROM admin WHERE groupID='$groupID' AND role='User' ";
$query_run = mysqli_query($con, $query);
$user = mysqli_fetch_array($query_run);

// Count total Location
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$query = "SELECT count(*) FROM location WHERE groupID='$groupID' ";
$query_run = mysqli_query($con, $query);
$location = mysqli_fetch_array($query_run);

// Count total emails sent
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$query = "SELECT count(*) FROM email WHERE groupID='$groupID' ";
$query_run = mysqli_query($con, $query);
$email = mysqli_fetch_array($query_run);

// Count total activites
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$query = "SELECT count(*) FROM admin_log WHERE groupID='$groupID' ";
$query_run = mysqli_query($con, $query);
$activity = mysqli_fetch_array($query_run);

// Count total user sign-in
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$query = "SELECT count(*) FROM admin_log WHERE groupID='$groupID' AND type='Signed in' ";
$query_run = mysqli_query($con, $query);
$signin = mysqli_fetch_array($query_run);

// Count total updates
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$query = "SELECT count(*) FROM admin_log WHERE groupID='$groupID' AND type='Updated' ";
$query_run = mysqli_query($con, $query);
$updates = mysqli_fetch_array($query_run);

// Count total clear-activity
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$query = "SELECT count(*) FROM admin_log WHERE groupID='$groupID' AND type='Cleared' ";
$query_run = mysqli_query($con, $query);
$clear = mysqli_fetch_array($query_run);

?>
