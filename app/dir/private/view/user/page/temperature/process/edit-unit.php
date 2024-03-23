<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]); 

// Edit Storage Unit
if(isset($_POST['updatestorage_btn']))
{
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $storageID = htmlspecialchars($_POST['id']);
  $engineID = htmlspecialchars($_POST['engineID']);
  $location = htmlspecialchars($_POST['location']);
  $unit_position = htmlspecialchars($_POST['position']);
  $unit_type = htmlspecialchars($_POST['unit_type']);
  $unit_grade = htmlspecialchars($_POST['unit_grade']);
  $unit_name = htmlspecialchars($_POST['unit_name']);
  $type = htmlspecialchars("Updated");
  $for = htmlspecialchars("for");

  // Encrypt Activity Data and insert
  $fullname = htmlspecialchars("$fname $lname");
  $org_message = htmlspecialchars("$type $unit_position: $unit_name $for $location");
  $encrypt_fullname = encryptthis($fullname, $key);
  $encrypt_org_message = encryptthis($org_message, $key);
  $org_activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
  $stmt = $con->prepare($org_activity);
  $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_org_message);
  $stmt->execute();

  // Update engine table
  $location_unit_grade = "$location - $unit_type - $unit_grade";
  $engine  = "UPDATE engine SET keyword1=?, keyword2=?, keyword3=? WHERE engineID='$engineID' ";
  $stmt = $con->prepare($engine);
  $stmt->bind_param("sss", $unit_name, $location_unit_grade, $unit_type);
  $stmt->execute();

  // Encrypt and update storage table
  $encrypt_position = encryptthis($unit_position, $key);
  $encrypt_grade = encryptthis($unit_grade, $key);
  $encrypt_name = encryptthis($unit_name, $key);
  $storage  = "UPDATE storage SET location=?, position=?, type=?, grade=?, name=? WHERE engineID='$engineID' ";
  $stmt = $con->prepare($storage);
  $stmt->bind_param("sssss", $location, $encrypt_position, $unit_type, $encrypt_grade, $encrypt_name);
  $stmt->execute();

  if($stmt->execute())
  {
    $_SESSION['success'] = "$unit_name Successfully Updated!";
    header("Location: ../../temperature/index.php");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Update $unit_name!";
    header("Location: ../../temperature/index.php");
    exit(0);
  }
}

?>