<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');

if(isset($_POST['inventorydeletebtn']))
{
  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $name = mysqli_real_escape_string($con, $_POST['delete_vaccine_name']);
  $type = htmlspecialchars("Deleted");

  // Encrypt Activity Data
  $fullname = "$fname $lname";
  $org_message = "$type $name";
  $encrypt_fullname = encryptthis($fullname, $key);
  $encrypt_org_message = encryptthis($org_message, $key);

  // Insert to activity table
  $activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activity);
  $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_org_message);
  $stmt->execute();

  // Delete from engine table
  $engine = "DELETE FROM engine WHERE engineID=? ";
  $stmt = $con->prepare($engine);
  $stmt->bind_param("s", $engineID);
  $stmt->execute();

  // Delete from vaccines table
  $vaccines = "DELETE FROM inventory WHERE engineID=? ";
  $stmt = $con->prepare($vaccines);
  $stmt->bind_param("s", $engineID);
  $stmt->execute();

  if($stmt->execute())
  {
    $_SESSION['success'] = "Inventory Successfully Deleted";
    header("Location: ../../inventory/index.php");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Delete Inventory";
    header("Location: ../../inventory/index.php");
    exit(0);
  }
}

?>