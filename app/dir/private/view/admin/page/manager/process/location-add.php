<?php
session_start();
include('../../../../../security/dbcon.php'); // database connection
include('../../../../../security/encrypt_decrypt.php'); // Encrypt/Decrypt function
require '../../../../../../vendor/mailer/PHPMailer/src/Exception.php'; // PHPMailer source
require '../../../../../../vendor/mailer/PHPMailer/src/PHPMailer.php'; // PHPMailer source
require '../../../../../../vendor/mailer/PHPMailer/src/SMTP.php'; // PHPMailer source

// location Add
if(isset($_POST['register_location']))
{
  $office = mysqli_real_escape_string($con, $_SESSION['office']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $userID = mysqli_real_escape_string($con, $_POST['userID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $officeID = mysqli_real_escape_string($con, $_POST['officeID']);
  $groupID = mysqli_real_escape_string($con, $_POST['groupID']);
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $address1 = mysqli_real_escape_string($con, $_POST['address1']);
  $address2 = mysqli_real_escape_string($con, $_POST['address2']);
  $city = mysqli_real_escape_string($con, $_POST['city']);
  $state = mysqli_real_escape_string($con, $_POST['state']);
  $zip = mysqli_real_escape_string($con, $_POST['zip']);
  $phone = mysqli_real_escape_string($con, $_POST['phone']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $link = mysqli_real_escape_string($con, $_POST['link']);
  $type = mysqli_real_escape_string($con, "Added");

  // Check if email exist
  $checkaddress = "SELECT * FROM location WHERE address1='$address1'";
  $checkaddress_run = mysqli_query($con, $checkaddress);

  // If email exist
  if(mysqli_num_rows($checkaddress_run) > 0)
  {
    $_SESSION['warning'] = "This Location Already Exist!";
    header("Location: ../../manager/index.php");
    exit(0);
  }
  else
  {

    // Encrypt Organization Data (inactivated)
    $encrypt_name = encryptthis($name, $key);
    $encrypt_address1 = encryptthis($address1, $key);
    $encrypt_address2 = encryptthis($address2, $key);
    $encrypt_city = encryptthis($city, $key);
    $encrypt_state = encryptthis($state, $key);
    $encrypt_zip = encryptthis($zip, $key);
    $encrypt_phone = encryptthis($phone, $key);
    $encrypt_email = encryptthis($email, $key);
    $encrypt_link = encryptthis($link, $key);

    //Insert to offices table
    $sql = "INSERT INTO location (officeID, engineID, groupID, name, address1, address2, city, state, zip, phone, email, link) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssssssssss", $officeID, $engineID, $groupID, $name, $address1, $address2, $city, $state, $zip, $phone, $email, $link);
    $stmt->execute();

    // Encrypt Activity Data
    $fullname = "$fname $lname";
    $org_message = "$type $name";
    $encrypt_fullname = encryptthis($fullname, $key);
    $encrypt_office = encryptthis($office, $key);
    $encrypt_org_message = encryptthis($org_message, $key);

    // insert activity timestamp
    $fullname = "$fname $lname";
    $activity = "INSERT INTO admin_log (userID, groupID, location, user, type, activity) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activity);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypt_office, $encrypt_fullname, $type, $encrypt_org_message);
    $stmt->execute();

    // insert keywords to engine table
    $address = "$address1 $address2 $city $state $zip";
    $name_pin = htmlspecialchars("$name - VFC PIN: $pin");
    $link = "https://www.google.com/maps/place/$address1 $address2 $city $state $zip";
    $engine = "INSERT INTO engine (engineID, groupID, keyword1, keyword2, keyword3, link) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($engine);
    $stmt->bind_param("ssssss", $engineID, $groupID, $name_pin, $address, $email, $link);
    $stmt->execute();

    if($stmt = $con->prepare($sql))
    {
      $_SESSION['success'] = "Location Successfully Added!";
      header("Location: ../../manager/index.php");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Add Location!";
      header("Location: ../../manager/index.php");
      exit(0);
    }
  }
}


?>