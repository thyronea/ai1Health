<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');

// Clear Email Log
if(isset($_POST['clear_email']))
{
  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $activity = mysqli_real_escape_string($con, "the Email Log");
  $type = mysqli_real_escape_string($con, "Cleared");
  $sql = "TRUNCATE TABLE email";
  $sql_run = mysqli_query($con, $sql);

  // Encrypt Activity Data and insert
  $fullname = "$fname $lname";
  $act_message = "$type $activity";
  $encrypt_fullname = encryptthis($fullname, $key);
  $encrypt_type = encryptthis($type, $key);
  $encrypt_act_message = encryptthis($act_message, $key);
  $activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activity);
  $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_act_message);
  $stmt->execute();

  if($sql_run)
  {
    $_SESSION['success'] = "Successfully Cleared the Email Log!";
    header("Location: ../../manager/index.php");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Clear the Email Log!";
    header("Location: ../../manager/index.php");
    exit(0);
  }
}

?>
