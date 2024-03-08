<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);

if(isset($_POST['upload_doc']))
{
  $maxsize = 2097152;
  $rand_name = rand(1000,9999);
  $user_fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $user_lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $status = mysqli_real_escape_string($con, "Uploaded a");
  $type = mysqli_real_escape_string($con, $_POST['type']);
  $message = mysqli_real_escape_string($con, "document");
  $docname = $_FILES["docname"]["name"];
  $tempname = $_FILES["docname"]["tmp_name"];
  $folder = '../../../../docs';

  if(($_FILES['docname']['size'] >= $maxsize) || ($_FILES["docname"]["size"] == 0)) {
    $_SESSION['warning'] = "Unable to Upload File. File must be less than 2MB";
    header("Location: /private/view/admin/page/docs/index.php");
    exit(0);
  }
  else {
    $check_file = "SELECT * FROM docs WHERE userID='$userID' AND docname='$docname' ";
    $check_file_run = mysqli_query($con, $check_file);

    // If file exist
    if(mysqli_num_rows($check_file_run) > 0) {
      $_SESSION['warning'] = "Unable to Upload File. File Already Exist!";
      header("Location: /private/view/admin/page/docs/index.php");
      exit(0);
    }
    else {

      // Encrypt Activity Data and insert
      $fullname = "$user_fname $user_lname";
      $act_message = "$status $type $message";
      $encrypt_fullname = encryptthis($fullname, $key);
      $encrypt_type = encryptthis($type, $key);
      $encrypt_act_message = encryptthis($act_message, $key);
      $activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activity);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $status, $encrypt_act_message);
      $stmt->execute();

      // Upload document
      $upload_doc = "INSERT INTO docs (userID, groupID, docname, type) VALUES (?, ?, ?, ?)";
      $stmt = $con->prepare($upload_doc);
      $stmt->bind_param("ssss", $userID, $groupID, $docname, $type);
      $stmt->execute();

      if(move_uploaded_file($tempname, "$folder/$docname")) {
        $_SESSION['success'] = "Successfully Uploaded File!";
        header("Location: /private/view/admin/page/docs/index.php");
      exit(0);
      }
      else {
        $_SESSION['warning'] = "Unable to Upload File!";
        header("Location: /private/view/admin/page/docs/index.php");
      exit(0);
      }
    }
  }
}

?>
