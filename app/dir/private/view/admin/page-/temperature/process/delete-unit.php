<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]); 

// Delete Storage Unit
if(isset($_POST['storagedeletebtn']))
{
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $id = htmlspecialchars($_POST['id']);
  $engineID = htmlspecialchars($_POST['engineID']);
  $storage_location = htmlspecialchars($_POST['delete_storage_location']);
  $storage_name = htmlspecialchars($_POST['delete_storage_name']);
  $type = mysqli_real_escape_string($con, "Deleted");
  $from = mysqli_real_escape_string($con, "from");

  // Encrypt Activity Data and insert
  $fullname = htmlspecialchars("$fname $lname");
  $org_message = htmlspecialchars("$type $storage_name $from $storage_location");
  $encrypt_fullname = encryptthis($fullname, $key);
  $encrypt_org_message = encryptthis($org_message, $key);
  $org_activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
  $stmt = $con->prepare($org_activity);
  $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_org_message);
  $stmt->execute();

  // Delete from storage table
  $storage = "DELETE FROM storage WHERE engineID=? ";
  $stmt = $con->prepare($storage);
  $stmt->bind_param("s", $engineID);
  $stmt->execute();

  // Delete from engine table
  $engine = "DELETE FROM engine WHERE engineID=? ";
  $stmt = $con->prepare($engine);
  $stmt->bind_param("s", $engineID);
  $stmt->execute();

  if($stmt->execute())
  {
    $_SESSION['success'] = "$storage_name Successfully Updated!";
    header("Location: ../../temperature/index.php");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Update $storage_name!";
    header("Location: ../../temperature/index.php");
    exit(0);
  }
}

?>