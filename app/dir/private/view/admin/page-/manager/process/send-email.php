<?php
session_start();
include('../../../../../security/dbcon.php'); // database connection
include('../../../../../security/encrypt_decrypt.php'); // Encrypt/Decrypt function
require '../../../../../../vendor/mailer/PHPMailer/src/Exception.php'; // PHPMailer source
require '../../../../../../vendor/mailer/PHPMailer/src/PHPMailer.php'; // PHPMailer source
require '../../../../../../vendor/mailer/PHPMailer/src/SMTP.php'; // PHPMailer source

if(isset($_POST['send_admin_email'])) {
  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $admin_email = mysqli_real_escape_string($con, $_SESSION['email']);
  $fromName = mysqli_real_escape_string($con, $_SESSION['fname']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $subject = mysqli_real_escape_string($con, $_POST['subject']);
  $message = mysqli_real_escape_string($con, $_POST['message']);
  $type = mysqli_real_escape_string($con, "Messaged");

  // Email configuration
  include('../components/email-config.php');

  // Encrypt Activity Data
  $fullname = "$fname $lname";
  $act_message = "$type $email";
  $encrypt_fullname = encryptthis($fullname, $key);
  $encrypt_type = encryptthis($type, $key);
  $encrypt_act_message = encryptthis($act_message, $key);

  /// Insert to activity table
  $fullname = "$fname $lname";
  $activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activity);
  $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_act_message);
  $stmt->execute();

  // Encrypt Email Data
  $encrypted_admin_email = encryptthis($admin_email, $key);
  $encrypted_email = encryptthis($email, $key);
  $encrypted_subject = encryptthis($subject, $key);
  $encrypted_message = encryptthis($message, $key);

  // Insert to email table
  $fullname = "$fname $lname";
  $sql = "INSERT INTO email (userID, groupID, fromEmail, toEmail, subject, message) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($sql);
  $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_admin_email, $encrypted_email, $encrypted_subject, $encrypted_message);
  $stmt->execute();

  if($stmt = $con->prepare($sql))
  {
    $_SESSION['success'] = "Email Successfully Sent to $email!";
    header("Location: ../../manager/index.php");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Send Email to $email!";
    header("Location: ../../manager/index.php");
  }
}

?>
