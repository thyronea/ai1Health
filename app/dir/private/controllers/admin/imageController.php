<?php
session_start();
require_once('../../initialize.php');
include(PRIVATE_CONTROLLERS_PATH . '/database/ai1health.php');
include(PRIVATE_CONTROLLERS_PATH . '/encryption/encryptionController.php');
include(PRIVATE_MODELS_PATH . '/admin/sessions.php');
$maxsize = 2097152;
$rand_name = rand(1000,9999);
$filename = $_FILES["uploadfile"]["name"];
$tempname = $_FILES["uploadfile"]["tmp_name"];
$profileFolder = '../../img/profile';
$backgroundFolder = '../../img/background';
$img_name = "$rand_name$filename";

// Upload profile image
if(isset($_POST['upload_profile_image'])):{

  if(($_FILES['uploadfile']['size'] >= $maxsize) || ($_FILES["uploadfile"]["size"] == 0)) {
    $_SESSION['warning'] = "Unable to Upload Image. File must be less than 2MB";
    header("Location: /private/view/admin/settings/");
    exit(0);
  }
  // If default image is used, update image in DB
  else {
    $default_pic = "default-profile-pic.jpeg";
    $check_image = "SELECT * FROM profile_image WHERE userID='$userID' AND filename='$default_pic' ";
    $check_image_run = mysqli_query($con, $check_image);

    if(mysqli_num_rows($check_image_run) > 0 ) {
      $update_image  = "UPDATE profile_image SET filename=? WHERE userID='$userID' ";
      $stmt = $con->prepare($update_image);
      $stmt->bind_param("s", $img_name);
      $stmt->execute();

      if(move_uploaded_file($tempname, "$profileFolder/$img_name")) {
        $_SESSION['success'] = "Successfully Uploaded Image!";
        header("Location: /private/view/admin/settings/?userID=$userID");
        exit(0);
      }
      else {
        $_SESSION['warning'] = "Unable to Upload Image!";
        header("Location: /private/view/admin/settings/?userID=$userID");
        exit(0);
      }
    }
    // If other image is used, update image in DB and delete the image in directory folder (image)
    else {
      $check_image = "SELECT * FROM profile_image WHERE userID='$userID' ";
      $check_image_run = mysqli_query($con, $check_image);
      $image = mysqli_fetch_assoc($check_image_run);

      unlink('../../img/profile/'.$image['filename']);
      $update_image  = "UPDATE profile_image SET filename=? WHERE userID='$userID' ";
      $stmt = $con->prepare($update_image);
      $stmt->bind_param("s", $img_name);
      $stmt->execute();
  
      if(move_uploaded_file($tempname, "$profileFolder/$img_name")) {
        $_SESSION['success'] = "Successfully Uploaded Image!";
        header("Location: /private/view/admin/settings/?userID=$userID");
        exit(0);
      }
      else {
        $_SESSION['warning'] = "Unable to Upload Image!";
        header("Location: /private/view/admin/settings/?userID=$userID");
        exit(0);
      }
    }
  }
}
endif;

// Upload background image
if(isset($_POST['upload_background_image'])):{

  if(($_FILES['uploadfile']['size'] >= $maxsize) || ($_FILES["uploadfile"]["size"] == 0)) {
    $_SESSION['warning'] = "Unable to Upload Image. File must be less than 2MB";
    header("Location: /private/view/admin/settings/?userID=$userID");
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

      if(move_uploaded_file($tempname, "$backgroundFolder/$img_name")) {
        $_SESSION['success'] = "Successfully Uploaded Background Image!";
        header("Location: /private/view/admin/settings/?userID=$userID");
        exit(0);
      }
      else {
        $_SESSION['warning'] = "Unable to Upload Background Image!";
        header("Location: /private/view/admin/settings/?userID=$userID");
        exit(0);
      }
    }
    // If other image is used, update image in DB and delete the image in directory folder (image)
    else {
      $check_image = "SELECT * FROM background_image WHERE userID='$userID' ";
      $check_image_run = mysqli_query($con, $check_image);
      $image = mysqli_fetch_assoc($check_image_run);

      unlink('../../img/background/'.$image['filename']);
      $update_image  = "UPDATE background_image SET filename=? WHERE userID='$userID' ";
      $stmt = $con->prepare($update_image);
      $stmt->bind_param("s", $img_name);
      $stmt->execute();

      if(move_uploaded_file($tempname, "$backgroundFolder/$img_name")) {
        $_SESSION['success'] = "Successfully Uploaded Background Image!";
        header("Location: /private/view/admin/settings/?userID=$userID");
        exit(0);
      }
      else {
        $_SESSION['warning'] = "Unable to Upload Background Image!";
        header("Location: /private/view/admin/settings/?userID=$userID");
        exit(0);
      }
    }
  }
}
endif;


?>
