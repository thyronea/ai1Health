<?php
session_start();
include('../../../../security/dbcon.php');

if(isset($_POST['upload_background_image']))
{
  $maxsize = 2097152;
  $rand_name = rand(1000,9999);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $filename = $_FILES["uploadfile"]["name"];
  $tempname = $_FILES["uploadfile"]["tmp_name"];
  $folder = '../../../image/background';
  $img_name = "$rand_name$filename";

  if(($_FILES['uploadfile']['size'] >= $maxsize) || ($_FILES["uploadfile"]["size"] == 0)) {
    $_SESSION['warning'] = "Unable to Upload Image. File must be less than 2MB";
    header("Location: /private/view/admin/page/settings/index.php?userID=$userID");
    exit(0);
  }
  // If default background is used, update image in DB
  else {
    $default_pic = "default-background.jpg";
    $check_image = "SELECT * FROM background_image WHERE userID='$userID' AND filename='$default_pic' ";
    $check_image_run = mysqli_query($con, $check_image);

    if(mysqli_num_rows($check_image_run) > 0) {
      $update_image  = "UPDATE background_image SET filename=? WHERE userID='$userID' ";
      $stmt = $con->prepare($update_image);
      $stmt->bind_param("s", $img_name);
      $stmt->execute();

      if(move_uploaded_file($tempname, "$folder/$img_name")) {
        $_SESSION['success'] = "Successfully Uploaded Background Image!";
        header("Location: /private/view/admin/page/settings/index.php?userID=$userID");
        exit(0);
      }
      else {
        $_SESSION['warning'] = "Unable to Upload Background Image!";
        header("Location: /private/view/admin/page/settings/index.php?userID=$userID");
        exit(0);
      }
    }
    // If other image is used, update image in DB and delete the image in directory folder (image)
    else {
      $check_image = "SELECT * FROM background_image WHERE userID='$userID' ";
      $check_image_run = mysqli_query($con, $check_image);
      $image = mysqli_fetch_assoc($check_image_run);

      unlink('../../../image/background/'.$image['filename']);
      $update_image  = "UPDATE background_image SET filename=? WHERE userID='$userID' ";
      $stmt = $con->prepare($update_image);
      $stmt->bind_param("s", $img_name);
      $stmt->execute();

      if(move_uploaded_file($tempname, "$folder/$img_name")) {
        $_SESSION['success'] = "Successfully Uploaded Background Image!";
        header("Location: /private/view/admin/page/settings/index.php?userID=$userID");
        exit(0);
      }
      else {
        $_SESSION['warning'] = "Unable to Upload Background Image!";
        header("Location: /private/view/admin/page/settings/index.php?userID=$userID");
        exit(0);
      }
    }
  }
}

?>
