<?php
session_start();
include('../../../../../security/dbcon.php'); // database connection
include('../../../../../security/encrypt_decrypt.php'); // Encrypt/Decrypt function

// Office Edit
if(isset($_POST['location_update_btn']))
{
  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $id = mysqli_real_escape_string($con, $_POST['id']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $address1 = mysqli_real_escape_string($con, $_POST['address1']);
  $address2 = mysqli_real_escape_string($con, $_POST['address2']);
  $city = mysqli_real_escape_string($con, $_POST['city']);
  $state = mysqli_real_escape_string($con, $_POST['state']);
  $zip = mysqli_real_escape_string($con, $_POST['zip']);
  $phone = mysqli_real_escape_string($con, $_POST['phone']);
  $location_email = mysqli_real_escape_string($con, $_POST['location_email']);
  $link = mysqli_real_escape_string($con, $_POST['location_link']);
  $type = mysqli_real_escape_string($con, "Updated");

  // Encrypt Activity Data and insert to Activities table
  $fullname = htmlspecialchars("$fname $lname");
  $org_message = htmlspecialchars("$type $name");
  $encrypt_fullname = encryptthis($fullname, $key);
  $encrypt_org_message = encryptthis($org_message, $key);
  $fullname = "$fname $lname";
  $activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activity);
  $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_org_message);
  $stmt->execute();

  // Edit engine table
  $complete_address = "$address1 $address2 $city $state $zip";
  $engine  = "UPDATE engine SET keyword1=?, keyword2=?, keyword3=? WHERE engineID='$id' ";
  $stmt = $con->prepare($engine);
  $stmt->bind_param("sss", $name, $complete_address, $location_email);
  $stmt->execute();

  $encrypt_name = encryptthis($name, $key);
  $encrypt_address1 = encryptthis($address1, $key);
  $encrypt_address2 = encryptthis($address2, $key);
  $encrypt_city = encryptthis($city, $key);
  $encrypt_state = encryptthis($state, $key);
  $encrypt_zip = encryptthis($zip, $key);
  $encrypt_phone = encryptthis($phone, $key);
  $encrypt_email = encryptthis($location_email, $key);
  $encrypt_link = encryptthis($link, $key);
  $location  = "UPDATE location SET name=?, address1=?, address2=?, city=?, state=?, zip=?, phone=?, email=?, link=? WHERE id='$id' ";
  $stmt = $con->prepare($location);
  $stmt->bind_param("sssssssss", $name, $address1, $address2, $city, $state, $zip, $phone, $location_email, $link);
  $stmt->execute();

  if($stmt = $con->prepare($location))
  {
    $_SESSION['success'] = "$name Successfully Updated!";
    header("Location: ../../manager/index.php");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Update $name!";
    header("Location: ../../manager/index.php");
    exit(0);
  }
}


?>