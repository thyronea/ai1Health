<?php
session_start();
include('dbcon.php');
include('encrypt_decrypt.php');
include('../../vendor/mailer/PHPMailer/src/Exception.php');
include('../../vendor/mailer/PHPMailer/src/PHPMailer.php');
include('../../vendor/mailer/PHPMailer/src/SMTP.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

function send_password_reset($userID, $fname, $lname, $email, $new_token)
{
  $mail = new PHPMailer(true);

  $mail->isSMTP();
  $mail->SMTPAuth = true;

  $mail->Host = "smtp.gmail.com";
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port = 587;

  $mail->Username = "donotreply@ai1system.net";
  $mail->Password = "awxo vbxo hvix pitc";

  $mail->setFrom($email);
  $mail->addAddress($email);

  $subject = htmlspecialchars("Reset Password");
  $message = htmlspecialchars_decode("
  Hello $fname,

  TO RESET YOUR PASSWORD, PLEASE CLICK ON THE LINK BELOW:
  http://localhost:8002/public/page/password/reset-pw.php?userID=$userID&token=$new_token

  If you did not make this request, please contact admin.

  Thank you!
  ");

  $mail->Subject = $subject;
  $mail->Body = $message;

  $mail->send();
}

if(isset($_POST['forgot_pw']))
{
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $new_token = md5(rand());

  $check_email = "SELECT * FROM admin WHERE email='$email' LIMIT 1";
  $check_email_run = mysqli_query($con, $check_email);
  $row = mysqli_fetch_assoc($check_email_run);
  $userID = mysqli_real_escape_string($con, $row['userID']);
  $engineID = mysqli_real_escape_string($con, $row['engineID']);
  $groupID = mysqli_real_escape_string($con, $row['groupID']);

  $get_token = "SELECT * FROM token WHERE userID=$userID LIMIT 1";
  $get_token_run = mysqli_query($con, $get_token);
  $token = mysqli_fetch_assoc($get_token_run);
  $key = mysqli_real_escape_string($con, $token["dk_token"]);

  $get_profile = "SELECT * FROM profile WHERE userID=$userID LIMIT 1";
  $get_profile_run = mysqli_query($con, $get_profile);
  $profile = mysqli_fetch_assoc($get_profile_run);
  $fname = htmlspecialchars(decryptthis($profile["fname"], $key));
  $lname = htmlspecialchars(decryptthis($profile["lname"], $key));

  if(mysqli_num_rows($check_email_run) > 0)
  {
    $update_token = "UPDATE token SET token='$new_token' WHERE userID='$userID' LIMIT 1";
    $update_token_run = mysqli_query($con, $update_token);

    if($update_token_run)
    {
      send_password_reset($userID, $fname, $lname, $email, $new_token);
      $_SESSION['success'] = "Link to reset password has been sent!";
      header("Location: ../../public/page/access/sign-in.php");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to reset password!";
      header("Location: ../../public/page/password/forgot-pw.php");
      exit(0);
    }
  }
  else
  {
    $_SESSION['warning'] = "Email not found! Please register!";
    header("Location: ../../public/page/password/forgot-pw.php");
    exit(0);
  }
}


?>
