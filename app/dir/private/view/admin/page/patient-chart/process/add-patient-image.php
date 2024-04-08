<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');
require '../../../../../../vendor/mailer/PHPMailer/src/Exception.php'; 
require '../../../../../../vendor/mailer/PHPMailer/src/PHPMailer.php';
require '../../../../../../vendor/mailer/PHPMailer/src/SMTP.php';

if(isset($_POST['add_patient_image'])){

  $maxsize = 2097152;
  $rand_name = rand(1000,9999);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $filename = $_FILES["patient_image"]["name"];
  $tempname = $_FILES["patient_image"]["tmp_name"];
  $folder = '../../../../image/profile';
  $img_name = "$rand_name$filename";

  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);

  if(($_FILES['patient_image']['size'] >= $maxsize) || ($_FILES["patient_image"]["size"] == 0)) {
    $_SESSION['warning'] = "Unable to Upload Image. File must be less than 2MB";
    header("Location: ../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  // If default image is used, update image in DB
  else {
    $default_pic = "default-profile-pic.jpeg";
    $check_image = "SELECT * FROM profile_image WHERE userID='$patientID' AND filename='$default_pic' ";
    $check_image_run = mysqli_query($con, $check_image);

    if(mysqli_num_rows($check_image_run) > 0 ) {
      $update_image  = "UPDATE profile_image SET filename=? WHERE userID='$patientID' ";
      $stmt = $con->prepare($update_image);
      $stmt->bind_param("s", $img_name);
      $stmt->execute();

      if(move_uploaded_file($tempname, "$folder/$img_name")) {
        $_SESSION['success'] = "Successfully Uploaded Image!";
        header("Location: ../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
      else {
        $_SESSION['warning'] = "Unable to Upload Image!";
        header("Location: ../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
    }
    // If other image is used, update image in DB and delete the image in directory folder (image)
    else {
      $check_image = "SELECT * FROM profile_image WHERE userID='$patientID' ";
      $check_image_run = mysqli_query($con, $check_image);
      $image = mysqli_fetch_assoc($check_image_run);

      unlink('../../../image/profile/'.$image['filename']);
      $update_image  = "UPDATE profile_image SET filename=? WHERE userID='$patientID' ";
      $stmt = $con->prepare($update_image);
      $stmt->bind_param("s", $img_name);
      $stmt->execute();
  
      if(move_uploaded_file($tempname, "$folder/$img_name")) {
        $_SESSION['success'] = "Successfully Uploaded Image!";
        header("Location: ../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
      else {
        $_SESSION['warning'] = "Unable to Upload Image!";
        header("Location: ../../patient-chart/index.php?patientID=$patientID");
        exit(0);
      }
    }
  }
}

?>