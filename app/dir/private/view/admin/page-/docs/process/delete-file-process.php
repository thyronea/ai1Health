<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);

// User Edit
if(isset($_POST['filedeletebtn']))
{
  $user_fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $user_lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $delete_ID = mysqli_real_escape_string($con, $_POST['file_ID']);
  $delete_userID = mysqli_real_escape_string($con, $_POST['file_userID']);
  $delete_groupID = mysqli_real_escape_string($con, $_POST['file_groupID']);
  $delete_docname = mysqli_real_escape_string($con, $_POST['file_docname']);
  $delete_type = mysqli_real_escape_string($con, $_POST['file_type']);
  $type = mysqli_real_escape_string($con, "Deleted");
  $message = mysqli_real_escape_string($con, "a Document");

  // Encrypt Activity Data and insert
  $fullname = "$user_fname $user_lname";
  $act_message = "$type $message";
  $encrypt_fullname = encryptthis($fullname, $key);
  $encrypt_type = encryptthis($type, $key);
  $encrypt_act_message = encryptthis($act_message, $key);
  $activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activity);
  $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_act_message);
  $stmt->execute();

  // Delete from admin table
  $check_file = "SELECT * FROM docs WHERE id='$delete_ID' ";
  $check_file_run = mysqli_query($con, $check_file);
  $doc = mysqli_fetch_assoc($check_file_run);
  unlink('../../../../docs/'.$doc['docname']);
  $file = "DELETE FROM docs WHERE id=? ";
  $stmt = $con->prepare($file);
  $stmt->bind_param("s", $delete_ID);
  $stmt->execute();

  if($stmt->execute())
  {
    $_SESSION['success'] = "File Successfully Deleted!";
    header("Location: /private/view/admin/page/docs/index.php");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Delete File!";
    header("Location: /private/view/admin/page/docs/index.php");
    exit(0);
  }
}

?>
