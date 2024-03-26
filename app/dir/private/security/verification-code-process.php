<?php
session_start();
include('../../../vendor/mailer/PHPMailer/src/Exception.php');
include('../../../vendor/mailer/PHPMailer/src/PHPMailer.php');
include('../../../vendor/mailer/PHPMailer/src/SMTP.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$is_invalid = false;

// Provider login
if(isset($_POST['send_code']))
{
  include('dbcon.php');
  $email = mysqli_real_escape_string($con, $_POST['email']);

  // Retrieves userID and passes to status_query to verify password
  $login_query = "SELECT * FROM admin WHERE email='$email' ";
  $login_query_run = mysqli_query($con, $login_query);
  $user = mysqli_fetch_assoc($login_query_run);
  $userID = htmlspecialchars($user["userID"]);

  // Retrieves account status for login verification
  $status_query = "SELECT * FROM token WHERE userID='$userID' ";
  $status_query_run = mysqli_query($con, $status_query);
  $status_token = mysqli_fetch_assoc($status_query_run);
  $key = htmlspecialchars($status_token["dk_token"]); // Used for data encryption and decryption

  // Retrieves ID from profile - Use to identify email receiver
  include('encrypt_decrypt.php');
  $profile_query = "SELECT * FROM profile WHERE userID='$userID' ";
  $profile_query_run = mysqli_query($con, $profile_query);
  $profile = mysqli_fetch_assoc($profile_query_run);
  $fname = htmlspecialchars(decryptthis($profile["fname"], $key));

  if($status_token['status'] == "1")
  {
    $vcode = rand(1000,9999); // Generates random verification token
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $subject = htmlspecialchars("Login Verification");
    $message = htmlspecialchars("
    Hello $fname,

    Your login verification code is: $vcode

    If you did not attempt to login, please contact admin.

    ");

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

    // stores vcode in token table for login verification
    $update_vcode = "UPDATE token SET v_code=? WHERE userID='$userID' ";
    $stmt = $con->prepare($update_vcode);
    $stmt->bind_param("s", $vcode);
    $stmt->execute();


    if($stmt->execute())
    {
      $_SESSION['success'] = "Code was sent to your email";
      header("Location: /public/page/access/login-verification.php"); // If user type is "Admin", go to admin page
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Please register or verify your email address!";
      header("Location: /public/page/access/sign-in.php");
      exit(0);
    }
  }
  else
  {
    $_SESSION['warning'] = "Please register or verify your email address!";
    header("Location: /public/page/access/sign-in.php");
    exit(0);
  }
  $is_invalid = true; // send invalid login message if password is incorrect
}
?>
