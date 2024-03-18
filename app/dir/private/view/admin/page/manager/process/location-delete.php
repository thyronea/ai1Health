<?php
session_start();
include('../../../../../security/dbcon.php'); // database connection
include('../../../../../security/encrypt_decrypt.php'); // Encrypt/Decrypt function

// Office Delete
if(isset($_POST['locationdeletebtn']))
{
  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $id = mysqli_real_escape_string($con, $_POST['delete_locationid']);
  $engineID = mysqli_real_escape_string($con, $_POST['delete_location_engineid']);
  $location_name = mysqli_real_escape_string($con, $_POST['delete_location_name']);
  $type = mysqli_real_escape_string($con, "Deleted");

  // Encrypt Activity Data
  $fullname = htmlspecialchars("$fname $lname");
  $org_message = htmlspecialchars("$type $location_name");
  $encrypt_fullname = encryptthis($fullname, $key);
  $encrypt_org_message = encryptthis($org_message, $key);

  // insert activity timestamp
  $fullname = "$fname $lname";
  $activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activity);
  $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_org_message);
  $stmt->execute();

  // Delete from engine table
  $engine = "DELETE FROM engine WHERE engineID=? ";
  $stmt = $con->prepare($engine);
  $stmt->bind_param("s", $engineID);
  $stmt->execute();

  // Delete from offices table
  $location = "DELETE FROM location WHERE id=? ";
  $stmt = $con->prepare($location);
  $stmt->bind_param("s", $id);
  $stmt->execute();

  if($stmt = $con->prepare($location))
  {
    $_SESSION['success'] = "Location Successfully Deleted!";
    header("Location: ../../manager/index.php");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Delete $name!";
    header("Location: ../../manager/index.php");
    exit(0);
  }
}


?>