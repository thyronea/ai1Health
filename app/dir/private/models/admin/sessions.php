<?php
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
$iz_key = mysqli_real_escape_string($con, $_SESSION["iz_key"]);
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$userID = mysqli_real_escape_string($con, $_SESSION['userID']);
$myuserID = mysqli_real_escape_string($con, $_SESSION['userID']);
$fname = mysqli_real_escape_string($con, $_SESSION['fname']);
$lname = mysqli_real_escape_string($con, $_SESSION['lname']);
$userEmail = mysqli_real_escape_string($con, $_SESSION['email']);
$fromName = mysqli_real_escape_string($con, $_SESSION['fname']);
$location = mysqli_real_escape_string($con, $_SESSION['location']);
$office = htmlspecialchars($_SESSION['location']);
?>