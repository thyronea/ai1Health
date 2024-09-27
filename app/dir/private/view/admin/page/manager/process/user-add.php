<?php
session_start();
include('../../../../../security/dbcon.php'); // database connection
include('../../../../../security/encrypt_decrypt.php'); // Encrypt/Decrypt function
require '../../../../../../vendor/mailer/PHPMailer/src/Exception.php'; // PHPMailer source
require '../../../../../../vendor/mailer/PHPMailer/src/PHPMailer.php'; // PHPMailer source
require '../../../../../../vendor/mailer/PHPMailer/src/SMTP.php'; // PHPMailer source

if(isset($_POST['register_btn']))
{
  $token = md5(rand());
  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $admin_fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $admin_lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $fromName = mysqli_real_escape_string($con, $_SESSION['fname']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $newID = mysqli_real_escape_string($con, $_POST['newID']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $fname = mysqli_real_escape_string($con, $_POST['fname']);
  $lname = mysqli_real_escape_string($con, $_POST['lname']);
  $filename = mysqli_real_escape_string($con, "default-profile-pic.jpeg");
  $background_filename = mysqli_real_escape_string($con, "default-background.jpg");
  $role = mysqli_real_escape_string($con, $_POST['role']);
  $type = mysqli_real_escape_string($con, "Registered");
  $as = mysqli_real_escape_string($con, "as");
  $admin = mysqli_real_escape_string($con, "Admin");
  $register = mysqli_real_escape_string($con, "Registered");
  $subject = mysqli_real_escape_string($con, "Registration Confirmation");
  $message = htmlspecialchars("
  Hello $fname,

  Your Group ID is $groupID.

  Please only share your Group ID to members who will be given access to the account.

  If you did not create this account, please contact admin.

  TO COMPLETE YOUR REGISTRATION, PLEASE CLICK ON THE LINK BELOW:
  https://ai1system.net/private/security/new-user-email-verification.php?token=$token

  Thank you!
  "); // http://ai1system.net/private/security/new-user-email-verification.php?token=$token

  // Check if email exist
  $checkemail = "SELECT * FROM admin WHERE email='$email'";
  $checkemail_run = mysqli_query($con, $checkemail);

  // If email exist
  if(mysqli_num_rows($checkemail_run) > 0)
  {
    $_SESSION['warning'] = "This Email Already Exist!";
    header("Location: ../../manager/index.php");
    exit(0);
  }
  else
  {
    // Email Configuration
    include('../components/email-config.php');

    // Insert to admin table
    $sql = "INSERT INTO admin (userID, engineID, groupID, email, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssss", $newID, $engineID, $groupID, $email, $role);
    $stmt->execute();

    // stores data in token table
    $sql = "INSERT INTO token (userID, groupID, token, dk_token) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssss", $newID, $groupID, $token, $key);
    $stmt->execute();

    // Encrypt Profile Data
    $encrypted_email = encryptthis($email, $key);
    $encrypted_role = encryptthis($role, $key);

    // Store user's profile in profile table (encrypted)
    $sql = "INSERT INTO profile (userID, engineID, groupID, fname, lname, email, role) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssssss", $newID, $engineID, $groupID, $fname, $lname, $encrypted_email, $encrypted_role);
    $stmt->execute();

    // Insert default profile image to profile_image table
    $sql = "INSERT INTO profile_image (userID, groupID, filename) VALUES (?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sss", $newID, $groupID, $filename);
    $stmt->execute();

    // Insert default background image to background_image table
    $sql = "INSERT INTO background_image (userID, groupID, filename) VALUES (?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sss", $newID, $groupID, $background_filename);
    $stmt->execute();

    // Encrypt Activity Data
    $fullname = htmlspecialchars("$admin_fname $admin_lname");
    $act_message = htmlspecialchars("$type $fname $lname $as $role");
    $encrypt_fullname = encryptthis($fullname, $key);
    $encrypt_type = encryptthis($type, $key);
    $encrypt_act_message = encryptthis($act_message, $key);

    // insert activity timestamp
    $activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activity);
    $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_act_message);
    $stmt->execute();

    // Encrypt Email Data
    $encrypted_admin = encryptthis($admin, $key);
    $encrypted_email = encryptthis($email, $key);
    $encrypted_subject = encryptthis($subject, $key);
    $encrypted_message = encryptthis($message, $key);

    // insert log to email table
    $send_message = "INSERT INTO email (userID, groupID, fromEmail, toEmail, subject, message) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($send_message);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_admin, $encrypted_email, $encrypted_subject, $encrypted_message);
    $stmt->execute();

    // insert keywords to engine table
    $fullname = "$fname $lname"; // Person creating the account for
    $link = mysqli_real_escape_string($con, "../../../../view/profile/index.php?userID=$newID"); // Link to user's profile
    $engine = "INSERT INTO engine (engineID, groupID, keyword1, keyword2, keyword3, link) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($engine);
    $stmt->bind_param("ssssss", $engineID, $groupID, $fullname, $role, $email, $link);
    $stmt->execute();

    if($stmt = $con->prepare($sql))
    {
      $_SESSION['success'] = "You have successfully registered a new user! An email has been sent for additional verification.";
      header("Location: ../../manager/index.php");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Register User!";
      header("Location: ../../manager/index.php");
      exit(0);
    }
  }
}

?>
