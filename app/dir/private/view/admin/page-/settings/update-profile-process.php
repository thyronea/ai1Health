<?php
session_start();
include('../../../../security/dbcon.php');
include('../../../../security/encrypt_decrypt.php');
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);

if(isset($_POST['admin_update_profile']))
{
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $engineID = mysqli_real_escape_string($con, $_SESSION['engineID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $fname = mysqli_real_escape_string($con, $_POST['fname']);
  $lname = mysqli_real_escape_string($con, $_POST['lname']);
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
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $type = mysqli_real_escape_string($con, "Updated");
  $message = mysqli_real_escape_string($con, ": Profile");
  $fullname = "$fname $lname";

  // Encrypt Activity Data and insert to Activities table
  $act_message = "$type $fname $lname $message";
  $encrypt_fullname = encryptthis($fullname, $key);
  $encrypt_type = encryptthis($type, $key);
  $encrypt_act_message = encryptthis($act_message, $key);
  $activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activity);
  $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_act_message);
  $stmt->execute();

  // Updates user's login email
  $admin  = "UPDATE admin SET email=? WHERE userID='$userID' ";
  $stmt = $con->prepare($admin);
  $stmt->bind_param("s", $email);
  $stmt->execute();

  // Updates engine table
  $admin  = "UPDATE engine SET keyword1=?, keyword3=?  WHERE engineID='$engineID' ";
  $stmt = $con->prepare($admin);
  $stmt->bind_param("ss", $fullname, $email);
  $stmt->execute();

  // Encrypt Patient's Name, dob, email and update
  $encrypt_fname = encryptthis($fname, $key);
  $encrypt_lname = encryptthis($lname, $key);
  $encrypt_email = encryptthis($email, $key);
  $profile  = "UPDATE profile SET fname=?, lname=?, email=? WHERE userID='$userID' ";
  $stmt = $con->prepare($profile);
  $stmt->bind_param("sss", $fname, $lname, $encrypt_email);
  $stmt->execute();

  // Encrypt Patient's diversity and update
  $encrypt_dob = encryptthis($dob, $key);
  $encrypt_gender = encryptthis($gender, $key);
  $encrypt_race = encryptthis($race, $key);
  $encrypt_ethnicity = encryptthis($ethnicity, $key);
  $diversity  = "UPDATE diversity SET dob=?, gender=?, race=?, ethnicity=? WHERE userID='$userID' ";
  $stmt = $con->prepare($diversity);
  $stmt->bind_param("ssss", $encrypt_dob, $encrypt_gender, $encrypt_race, $encrypt_ethnicity);
  $stmt->execute();

  // Encrypt Patient's address and update
  $encrypt_address1 = encryptthis($address1, $key);
  $encrypt_address2 = encryptthis($address2, $key);
  $encrypt_city = encryptthis($city, $key);
  $encrypt_state = encryptthis($state, $key);
  $encrypt_zip = encryptthis($zip, $key);
  $address  = "UPDATE address SET address1=?, address2=?, city=?, state=?, zip=? WHERE userID='$userID' ";
  $stmt = $con->prepare($address);
  $stmt->bind_param("sssss", $encrypt_address1, $encrypt_address2, $encrypt_city, $encrypt_state, $encrypt_zip);
  $stmt->execute();

  // Encrypt Patient's contact and update
  $encrypt_phone = encryptthis($phone, $key);
  $encrypt_mobile = encryptthis($mobile, $key);
  $encrypt_email = encryptthis($email, $key);
  $contact  = "UPDATE contact SET phone=?, mobile=?, email=? WHERE userID='$userID' ";
  $stmt = $con->prepare($contact);
  $stmt->bind_param("sss", $encrypt_phone, $encrypt_mobile, $encrypt_email);
  $stmt->execute();

  if($stmt = $con->prepare($contact))
  {
    $_SESSION['success'] = "Account Settings Successfully Updated!";
    header("Location: /private/view/admin/page/settings/index.php?userID=$userID");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Update Account Settings!";
    header("Location: /private/view/admin/page/settings/index.php?userID=$userID");
    exit(0);
  }
}

// Add data if patient doesn't exist - If patient exist, data will update instead.
$check_diversity = "SELECT * FROM diversity WHERE userID='$userID'";
$check_diversity_run = mysqli_query($con, $check_diversity);
if(mysqli_num_rows($check_diversity_run) > 0)
{
  // Encrypt data and insert
  $add_encrypt_dob = encryptthis($dob, $key);
  $add_encrypt_race = encryptthis($race, $key);
  $add_encrypt_ethnicity = encryptthis($ethnicity, $key);
  $add_diversity = "INSERT INTO diversity (groupID, engineID, groupID, dob, gender, race, ethnicity) VALUES (?, ?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($add_diversity);
  $stmt->bind_param("sssssss", $groupID, $engineID, $groupID, $add_encrypt_dob, $gender, $add_encrypt_race. $add_encrypt_ethnicity);
  $stmt->execute();
}

?>
