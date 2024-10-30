<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]); 

// Edit Thermometer
if(isset($_POST['updatethermometer_btn']))
{
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $id = htmlspecialchars($_POST['id']);
  $engineID = htmlspecialchars($_POST['engineID']);
  $location = htmlspecialchars($_POST['location']);
  $position = htmlspecialchars($_POST['position']);
  $therm_name = htmlspecialchars($_POST['therm_name']);
  $therm_serial = htmlspecialchars($_POST['therm_serial']);
  $therm_expiration = htmlspecialchars($_POST['therm_expiration']);
  $type = htmlspecialchars("Updated");

  // Encrypt Activity Data
  $fullname = htmlspecialchars("$fname $lname");
  $org_message = htmlspecialchars("$type $therm_name: $therm_serial");
  $encrypt_fullname = encryptthis($fullname, $key);
  $encrypt_org_message = encryptthis($org_message, $key);

  // Insert to activity table
  $activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activity);
  $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_org_message);
  $stmt->execute();

  // Update engine table
  $loc_message = "Inside the $position";
  $engine  = "UPDATE engine SET keyword1=?, keyword2=?, keyword3=? WHERE engineID='$engineID' ";
  $stmt = $con->prepare($engine);
  $stmt->bind_param("sss", $therm_name, $location, $loc_message);
  $stmt->execute();

  // Encrypt Thermometer Data and update
  $encrypt_position = encryptthis($position, $key);
  $encrypt_name = encryptthis($therm_name, $key);
  $encrypt_serial = encryptthis($therm_serial, $key);
  $encrypt_expiration = encryptthis($therm_expiration, $key);
  $thermometers  = "UPDATE thermometers SET location=?, position=?, name=?, serial=?, expiration=? WHERE id='$id' ";
  $stmt = $con->prepare($thermometers);
  $stmt->bind_param("sssss", $location, $encrypt_position, $encrypt_name, $encrypt_serial, $encrypt_expiration);
  $stmt->execute();

  if($stmt->execute())
  {
    $_SESSION['success'] = "$therm_name Successfully Updated!";
    header("Location: ../../temperature/index.php");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Update $therm_name!";
    header("Location: ../../temperature/index.php");
    exit(0);
  }
}

?>