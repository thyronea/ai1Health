<?php
session_start();
include('../../../../security/dbcon.php');
include('../../../../security/encrypt_decrypt.php');
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);

if(isset($_POST['admin_profile_btn']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $engineID = mysqli_real_escape_string($con, $_SESSION['engineID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $gender = mysqli_real_escape_string($con, $_POST['gender']);
  $race = mysqli_real_escape_string($con, $_POST['race']);
  $ethnicity = mysqli_real_escape_string($con, $_POST['ethnicity']);
  $address1 = mysqli_real_escape_string($con, $_POST['address1']);
  $address2 = mysqli_real_escape_string($con, $_POST['address2']);
  $city = mysqli_real_escape_string($con, $_POST['city']);
  $state = mysqli_real_escape_string($con, $_POST['state']);
  $zip = mysqli_real_escape_string($con, $_POST['zip']);
  $phone = mysqli_real_escape_string($con, $_POST['phone']);
  $mobile = mysqli_real_escape_string($con, $_POST['mobile']);

  // Add data if patient doesn't exist - If patient exist, data will update instead.
  $check_diversity = "SELECT * FROM diversity WHERE userID='$userID'";
  $check_diversity_run = mysqli_query($con, $check_diversity);
  if(mysqli_num_rows($check_diversity_run) > 0)
  {
    $_SESSION['warning'] = "Profile Already Exist!";
    header("Location: /private/view/admin/index.php");
    exit(0);
  }
  else
  {

    // Encrypt diversity data and insert
    $encrypt_dob = encryptthis($dob, $key);
    $encrypt_gender = encryptthis($gender, $key);
    $encrypt_race = encryptthis($race, $key);
    $encrypt_ethnicity = encryptthis($ethnicity, $key);
    $diversity = "INSERT INTO diversity (userID, engineID, groupID, dob, gender, race, ethnicity) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($diversity);
    $stmt->bind_param("sssssss", $userID, $engineID, $groupID, $encrypt_dob, $encrypt_gender, $encrypt_race, $encrypt_ethnicity);
    $stmt->execute();

    // Encrypt Patient's address Data and insert
    $encrypt_address1 = encryptthis($address1, $key);
    $encrypt_address2 = encryptthis($address2, $key);
    $encrypt_city = encryptthis($city, $key);
    $encrypt_state = encryptthis($state, $key);
    $encrypt_zip = encryptthis($zip, $key);
    $address = "INSERT INTO address (userID, engineID, groupID, address1, address2, city, state, zip) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($address);
    $stmt->bind_param("ssssssss", $userID, $engineID, $groupID, $encrypt_address1, $encrypt_address2, $encrypt_city, $encrypt_state, $encrypt_zip);
    $stmt->execute();

    // Encrypt Patient's contact Data and insert
    $encrypt_phone = encryptthis($phone, $key);
    $encrypt_mobile = encryptthis($mobile, $key);
    $encrypt_patient_email = encryptthis($email, $key);
    $contact = "INSERT INTO contact (userID, engineID, groupID, phone, mobile, email) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($contact);
    $stmt->bind_param("ssssss", $userID, $engineID, $groupID, $encrypt_phone, $encrypt_mobile, $encrypt_patient_email);
    $stmt->execute();

    if($stmt = $con->prepare($contact))
    {
      $_SESSION['success'] = "Profile Successfully Completed!";
      header("Location: /private/view/admin/index.php");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Complete Profile!";
      header("Location: /private/view/admin/index.php");
      exit(0);
    }
  }
}
?>
