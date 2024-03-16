<?php
session_start();
include(PRIVATE_SECURITY_PATH . '/dbcon.php');
include '../../../vendor/mailer/PHPMailer/src/Exception.php';
include '../../../vendor/mailer/PHPMailer/src/PHPMailer.php';
include '../../../vendor/mailer/PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if(isset($_POST['register_btn'])) {
  // Generate key for data decryption. IF THIS KEY IS SOME HOW BROKEN OR COMPROMISED, ALL DATA WILL BE LOST
  $key = md5(rand());

  // Creates a function for data encryption
  function encryptthis($data, $key) {
    $encryption_key = base64_decode($key); // Decodes data encoded with MIME base64 using $key
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc')); // Generate a pseudo-random string of bytes
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv); // Encrypts data
    return base64_encode($encrypted . '::' . $iv); // Returns encrypted data
  }

  $token = md5(rand()); // Generates random token
  $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT); // Password will be HASHED and cannot be retrieved by anyone BUT the creator
  $userID = mysqli_real_escape_string($con, $_POST['userID']); // Generates ID
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']); // Generates ID for search engine
  $groupID = mysqli_real_escape_string($con, $_POST['groupID']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $role = mysqli_real_escape_string($con, $_POST['role']);
  $fname = mysqli_real_escape_string($con, $_POST['fname']);
  $lname = mysqli_real_escape_string($con, $_POST['lname']);
  $filename = mysqli_real_escape_string($con, "default-profile-pic.jpeg");
  $type = mysqli_real_escape_string($con, "Registered");
  $as = mysqli_real_escape_string($con, "as");
  $admin = mysqli_real_escape_string($con, "Admin");
  $subject = mysqli_real_escape_string($con, "Registration Confirmation");
  $message = htmlspecialchars("
  Hello $fname,

  Your Group ID is $groupID.

  Please only share your Group ID to members who will be given access to the account.

  If you did not create this account, please contact admin.

  TO COMPLETE YOUR REGISTRATION, PLEASE CLICK ON THE LINK BELOW:

  http://localhost:8000/private/security/email-verification.php?token=$token

  Thank you!
  ");

  // Email validation
  $check_admin = "SELECT * FROM admin WHERE email='$email'";
  $check_admin_run = mysqli_query($con, $check_admin);

  // Email validation for existence
  if(mysqli_num_rows($check_admin_run) > 0) {
    $_SESSION['warning'] = "This Email Already Exist!";
    header("Location: /page/access/sign-in.php");
    exit(0);
  }
  else {
    // Send email confirmation
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = "thyrone.antonio@gmail.com";
    $mail->Password = "mhopftvkjlemevgn";

    $mail->setFrom($email);
    $mail->addAddress($email);

    $mail->Subject = $subject;
    $mail->Body = $message;

    $mail->send();

    // stores data in users table
    $sql = "INSERT INTO admin (userID, engineID, groupID, email, role, password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssss", $userID, $engineID, $groupID, $email, $role, $password_hash);
    $stmt->execute();

    // stores data in token table
    $sql = "INSERT INTO token (userID, groupID, token, dk_token) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssss", $userID, $groupID, $token, $key);
    $stmt->execute();

    // Encrypt Profile Data
    $encrypted_fname = encryptthis($fname, $key);
    $encrypted_lname = encryptthis($lname, $key);
    $encrypted_email = encryptthis($email, $key);
    $encrypted_role = encryptthis($role, $key);

    // stores user's profile in profile table (encrypted)
    $sql = "INSERT INTO profile (userID, engineID, groupID, fname, lname, email, role) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssssss", $userID, $engineID, $groupID, $encrypted_fname, $encrypted_lname, $encrypted_email, $encrypted_role);
    $stmt->execute();

    // stores default profile image to profile_image table
    $sql = "INSERT INTO profile_image (userID, groupID, filename) VALUES (?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sss", $userID, $groupID, $filename);
    $stmt->execute();

    // stores data in engine table
    $fullname = "$fname $lname"; // Person creating the new account
    $link = mysqli_real_escape_string($con, "../../../../view/profile/index.php?userID=$userID"); // Link to user's profile
    $engine = "INSERT INTO engine (engineID, groupID, keyword1, keyword2, keyword3, link) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($engine);
    $stmt->bind_param("ssssss", $engineID, $groupID, $fullname, $role, $email, $link);
    $stmt->execute();

    // Encrypt Activities Data
    $fullname = "$fname $lname";
    $act_message = "$type $as $role";
    $encrypted_fullname = encryptthis($fullname, $key);
    $encrypted_fname = encryptthis($fname, $key);
    $encrypted_lname = encryptthis($lname, $key);
    $encrypted_message = encryptthis($act_message, $key);

    // stores data in activity table
    $activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activity);
    $stmt->bind_param("sssss", $userID, $groupID,$encrypted_fullname, $type, $encrypted_message); // Will save as "$fname $lname Registered as new Admin"
    $stmt->execute();

    // Encrypt Email Data
    $encrypted_admin = encryptthis($admin, $key);
    $encrypted_email = encryptthis($email, $key);
    $encrypted_subject = encryptthis($subject, $key);
    $encrypted_message = encryptthis($message, $key);
    $send_message = "INSERT INTO email (userID, groupID, fromEmail, toEmail, subject, message) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($send_message);
    $stmt->bind_param("ssssss", $userID, $groupID, $encrypted_admin, $encrypted_email, $encrypted_subject, $encrypted_message);
    $stmt->execute();

    if($stmt = $con->prepare($sql)) {
      $_SESSION['success'] = "Verify Email to Complete Registration!";
      header("Location: /public/page/access/sign-in.php");
      exit(0);
    }
    else {
      $_SESSION['warning'] = "Unable to Register User!";
      header("Location: /public/page/access/sign-in.php");
      exit(0);
    }
  }
}
?>
