<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]); 

// Delete Thermometer
if(isset($_POST['thermometerdeletebtn']))
{
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $id = htmlspecialchars($_POST['id']);
  $engineID = htmlspecialchars($_POST['engineID']);
  $thermometer_location = htmlspecialchars($_POST['delete_thermometer_location']);
  $thermometer_name = htmlspecialchars($_POST['delete_thermometer_name']);
  $type = htmlspecialchars("Deleted");
  $from = htmlspecialchars("from");

  // Encrypt Activity Data
  $fullname = htmlspecialchars("$fname $lname");
  $org_message = htmlspecialchars("$type $thermometer_name $from $thermometer_location");
  $encrypt_fullname = encryptthis($fullname, $key);
  $encrypt_org_message = encryptthis($org_message, $key);

  // Insert to activity table
  $activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activity);
  $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_org_message);
  $stmt->execute();

  // Delete from thermometers table
  $thermometers = "DELETE FROM thermometers WHERE id=? ";
  $stmt = $con->prepare($thermometers);
  $stmt->bind_param("s", $id);
  $stmt->execute();

  // Delete from engine table
  $engine = "DELETE FROM engine WHERE engineID=? ";
  $stmt = $con->prepare($engine);
  $stmt->bind_param("s", $engineID);
  $stmt->execute();

  if($stmt->execute())
  {
    $_SESSION['success'] = "$thermometer_name Successfully Updated!";
    header("Location: ../../temperature/index.php");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Update $thermometer_name!";
    header("Location: ../../temperature/index.php");
    exit(0);
  }
}

?>