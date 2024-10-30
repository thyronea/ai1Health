<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);

// User Edit
if(isset($_POST['userdeletebtn']))
{
  $user_fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $user_lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $engineID = mysqli_real_escape_string($con, $_POST['delete_engineID']);
  $delete_userID = mysqli_real_escape_string($con, $_POST['delete_userID']);
  $fname = mysqli_real_escape_string($con, $_POST['delete_fname']);
  $lname = mysqli_real_escape_string($con, $_POST['delete_lname']);
  $type = mysqli_real_escape_string($con, "Deleted");

  // Encrypt Activity Data and insert
  $fullname = "$user_fname $user_lname";
  $act_message = "$type $fname $lname";
  $encrypt_fullname = encryptthis($fullname, $key);
  $encrypt_type = encryptthis($type, $key);
  $encrypt_act_message = encryptthis($act_message, $key);
  $activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activity);
  $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_act_message);
  $stmt->execute();

  // Delete from engine table
  $engine = "DELETE FROM engine WHERE engineID=? ";
  $stmt = $con->prepare($engine);
  $stmt->bind_param("s", $engineID);
  $stmt->execute();

  // Delete from admin table
  $users = "DELETE FROM admin WHERE userID=? ";
  $stmt = $con->prepare($users);
  $stmt->bind_param("s", $delete_userID);
  $stmt->execute();

  // Delete from profile table
  $profile = "DELETE FROM profile WHERE userID=? ";
  $stmt = $con->prepare($profile);
  $stmt->bind_param("s", $delete_userID);
  $stmt->execute();

  // Delete from diversity table
  $diversity = "DELETE FROM diversity WHERE userID=? ";
  $stmt = $con->prepare($diversity);
  $stmt->bind_param("s", $delete_userID);
  $stmt->execute();

  // Delete from address table
  $address = "DELETE FROM address WHERE userID=? ";
  $stmt = $con->prepare($address);
  $stmt->bind_param("s", $delete_userID);
  $stmt->execute();

  // Delete from contact table
  $contact = "DELETE FROM contact WHERE userID=? ";
  $stmt = $con->prepare($contact);
  $stmt->bind_param("s", $delete_userID);
  $stmt->execute();

  // Delete from token table
  $profile = "DELETE FROM token WHERE userID=? ";
  $stmt = $con->prepare($profile);
  $stmt->bind_param("s", $delete_userID);
  $stmt->execute();

  // Delete profile image
  $check_image = "SELECT * FROM profile_image WHERE userID='$delete_userID' ";
  $check_image_run = mysqli_query($con, $check_image);
  $image = mysqli_fetch_assoc($check_image_run);
  if($image['filename'] !== "default-profile-pic.jpeg"){
    $folder = '../../../../image/profile';
    unlink('../../../../image/profile/'.$image['filename']);
    $delete_profile_image = "DELETE FROM profile_image WHERE userID=? ";
    $stmt = $con->prepare($delete_profile_image);
    $stmt->bind_param("s", $delete_userID);
    $stmt->execute();
  }
  else{
    $delete_profile_image = "DELETE FROM profile_image WHERE userID=? ";
    $stmt = $con->prepare($delete_profile_image);
    $stmt->bind_param("s", $delete_userID);
    $stmt->execute();
  }
  

  // Delete background image
  $check_image = "SELECT * FROM background_image WHERE userID='$delete_userID' ";
  $check_image_run = mysqli_query($con, $check_image);
  $background_image = mysqli_fetch_assoc($check_image_run);
  if($background_image['filename'] !== "default-background.jpg"){
    $folder = '../../../../image/background';
    unlink('../../../../image/background/'.$background_image['filename']);
    $delete_background_image = "DELETE FROM background_image WHERE userID=? ";
    $stmt = $con->prepare($delete_background_image);
    $stmt->bind_param("s", $delete_userID);
    $stmt->execute();
  }
  else{
    $delete_background_image = "DELETE FROM background_image WHERE userID=? ";
    $stmt = $con->prepare($delete_background_image);
    $stmt->bind_param("s", $delete_userID);
    $stmt->execute();
  }

  if($stmt->execute())
  {
    $_SESSION['success'] = "User Successfully Deleted!";
    header("Location: ../../manager/index.php");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Delete $fname $lname!";
    header("Location: ../../manager/index.php");
    exit(0);
  }
}

?>
