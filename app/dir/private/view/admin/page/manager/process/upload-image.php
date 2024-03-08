<?php
session_start();
include('../../../../../security/dbcon.php');

if(isset($_POST['upload_image']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $filename = $_FILES["uploadfile"]["name"];
  $tempname = $_FILES["uploadfile"]["tmp_name"];
  $folder = '../../../image';

  $check_image = "SELECT * FROM image WHERE userID='$userID' ";
  $check_image_run = mysqli_query($con, $check_image);
  $image = mysqli_fetch_assoc($check_image_run);

  // If image exist, replace image in DB and delete the image in directory folder (image)
  if(mysqli_num_rows($check_image_run) > 0) {
    unlink('../../../image/'.$image['filename']);
    $update_image  = "UPDATE image SET filename=? WHERE userID='$userID' ";
    $stmt = $con->prepare($update_image);
    $stmt->bind_param("s", $filename);
    $stmt->execute();

    if(move_uploaded_file($tempname, "$folder/$filename")) {
      $_SESSION['success'] = "Successfully Uploaded Image!";
      header("Location: ../../admin/index.php?");
      exit(0);
    }
    else {
      $_SESSION['warning'] = "Unable to Upload Image!";
      header("Location: ../../admin/index.php");
      exit(0);
    }
  }
  // If image does not exist, upload image in DB and in directory folder (image)
  else {
    $upload_image = "INSERT INTO image (userID, groupID, filename) VALUES (?, ?, ?)";
    $stmt = $con->prepare($upload_image);
    $stmt->bind_param("sss", $userID, $groupID, $filename);
    $stmt->execute();

    if(move_uploaded_file($tempname, "$folder/$filename")) {
      $_SESSION['success'] = "Successfully Uploaded Image!";
      header("Location: ../../admin/index.php?");
      exit(0);
    }
    else {
      $_SESSION['warning'] = "Unable to Upload Image!";
      header("Location: ../../admin/index.php");
      exit(0);
    }
  }
}

?>
