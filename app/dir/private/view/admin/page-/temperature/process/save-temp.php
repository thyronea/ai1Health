<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]); 

// Add Daily Temp
if(isset($_POST['save_temp_btn']))
{
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $r_date = htmlspecialchars($_POST['r_date']);
  $r_time = htmlspecialchars($_POST['r_time']);
  $refrigerator = htmlspecialchars($_POST['refrigerator']);
  $r_initials = htmlspecialchars($_POST['r_initials']);
  $r_current = htmlspecialchars($_POST['r_current']);
  $r_min = htmlspecialchars($_POST['r_min']);
  $r_max = htmlspecialchars($_POST['r_max']);
  $f_date = htmlspecialchars($_POST['f_date']);
  $f_time = htmlspecialchars($_POST['f_time']);
  $freezer = htmlspecialchars($_POST['freezer']);
  $f_initials = htmlspecialchars($_POST['f_initials']);
  $f_current = htmlspecialchars($_POST['f_current']);
  $f_min = htmlspecialchars($_POST['f_min']);
  $f_max = htmlspecialchars($_POST['f_max']);
  $type = htmlspecialchars("Logged");
  $and = mysqli_real_escape_string($con, "and");

  // Encrypt Refrigerator Temperature Data
  $encrypt_refrigerator = encryptthis($refrigerator, $key);
  $encrypt_r_initials = encryptthis($r_initials, $key);
  $encrypt_r_current = encryptthis($r_current, $key);
  $encrypt_r_min = encryptthis($r_min, $key);
  $encrypt_r_max = encryptthis($r_max, $key);

  // Insert in fridgetemp table
  $fridgetemp = "INSERT INTO fridgetemp (groupID, refrigerator, date, time, initials, current, min, max) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($fridgetemp);
  $stmt->bind_param("ssssssss", $groupID, $encrypt_refrigerator, $r_date, $r_time, $r_initials, $r_current, $r_min, $r_max);
  $stmt->execute();

  // Encrypt Freezer Temperature Data
  $encrypt_freezer = encryptthis($freezer, $key);
  $encrypt_f_initials = encryptthis($f_initials, $key);
  $encrypt_f_current = encryptthis($f_current, $key);
  $encrypt_f_min = encryptthis($f_min, $key);
  $encrypt_f_max = encryptthis($f_max, $key);

  // Insert in freezertemp table
  $freezertemp = "INSERT INTO freezertemp (groupID, freezer, date, time, initials, current, min, max) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($freezertemp);
  $stmt->bind_param("ssssssss", $groupID, $encrypt_freezer, $f_date, $f_time, $f_initials, $f_current, $f_min, $f_max);
  $stmt->execute();

  // Encrypt Activity Data
  $fullname = htmlspecialchars("$fname $lname");
  $org_message = htmlspecialchars("$type: $r_current / $r_min / $r_max $and $f_current / $f_min / $f_max");
  $encrypt_fullname = encryptthis($fullname, $key);
  $encrypt_org_message = encryptthis($org_message, $key);

  // Insert in activity table
  $activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activity);
  $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_org_message);
  $stmt->execute();

  if($stmt = $con->prepare($activity))
  {
    $_SESSION['success'] = "Temperature Logged Successfully";
    header("Location: ../../temperature/index.php");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Data Error! Unable to ";
    header("Location: ../../temperature/index.php");
    exit(0);
  }
}

?>