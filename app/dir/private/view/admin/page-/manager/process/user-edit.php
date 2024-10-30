<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');

// User Edit
if(isset($_POST['update_btn']))
{
  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
  $user_fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $user_lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $fname = mysqli_real_escape_string($con, $_POST['fname']);
  $lname = mysqli_real_escape_string($con, $_POST['lname']);
  $user_email = mysqli_real_escape_string($con, $_POST['email']);
  $role = mysqli_real_escape_string($con, $_POST['role']);
  $type = mysqli_real_escape_string($con, "Updated");
  $message = mysqli_real_escape_string($con, ": Account");

  // Encrypt Activity Data and insert to Activities table
  $user_fullname = "$user_fname $user_lname";
  $act_message = "$type $fname $lname $message";
  $encrypt_fullname = encryptthis($user_fullname, $key);
  $encrypt_type = encryptthis($type, $key);
  $encrypt_act_message = encryptthis($act_message, $key);
  $activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activity);
  $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_act_message);
  $stmt->execute();

  // Update engine table
  $full_name = "$fname $lname";
  $engine  = "UPDATE engine SET keyword1=?, keyword2=?, keyword3=? WHERE engineID='$engineID' ";
  $stmt = $con->prepare($engine);
  $stmt->bind_param("sss", $full_name, $role, $user_email);
  $stmt->execute();

  // Update users table
  $users  = "UPDATE admin SET email=?, role=? WHERE engineID='$engineID' ";
  $stmt = $con->prepare($users);
  $stmt->bind_param("ss", $user_email, $role);
  $stmt->execute();

  // Encrypt Profile Data and insert to Profile table
  $encrypt_user_email = encryptthis($user_email, $key);
  $encrypt_role = encryptthis($role, $key);
  $profile  = "UPDATE profile SET fname=?, lname=?, email=?, role=? WHERE engineID='$engineID' ";
  $stmt = $con->prepare($profile);
  $stmt->bind_param("ssss", $fname, $lname, $encrypt_user_email, $encrypt_role);
  $stmt->execute();

  if($stmt->execute())
  {
    $_SESSION['success'] = "$fname $lname Successfully Updated!";
    header("Location: ../../manager/index.php");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Update $fname $lname!";
    header("Location: ../../manager/index.php");
    exit(0);
  }
}

?>
