<?php
$is_invalid = false;

if(isset($_POST['user_send_code']))
{ 
  include('dbcon.php');
  include('../../../../../PHPMailer/src/Exception.php');
  include('../../../../../PHPMailer/src/PHPMailer.php');
  include('../../../../../PHPMailer/src/SMTP.php');
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  
  $login = mysqli_real_escape_string($con, $_POST['login_btn']);
  $email = mysqli_real_escape_string($con, $_POST['email']);

  // Retrieves userID and passes to status_query to verify password
  $login_query = "SELECT * FROM patients WHERE email='$email' ";
  $login_query_run = mysqli_query($con, $login_query);
  $user = mysqli_fetch_assoc($login_query_run);
  $patientID = htmlspecialchars($user["patientID"]);

  // Retrieves account status for login verification
  $status_query = "SELECT * FROM token WHERE userID='$patientID' ";
  $status_query_run = mysqli_query($con, $status_query);
  $status_token = mysqli_fetch_assoc($status_query_run);
  $key = htmlspecialchars($status_token["dk_token"]); // Used for data encryption and decryption

  if($status_token['status'] == "1")
  {
    $vcode = rand(1000,9999); // Generates random verification token
    $fname = htmlspecialchars(decryptthis($user["fname"], $key));
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $subject = mysqli_real_escape_string($con, "Login Verification");
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

    $mail->Username = "donotreply@ai1system.net";
    $mail->Password = "awxo vbxo hvix pitc";

    $mail->setFrom($email);
    $mail->addAddress($email);

    $mail->Subject = $subject;
    $mail->Body = $message;

    $mail->send();

    // stores vcode in token table for login verification
    $update_vcode = "UPDATE token SET v_code='$vcode' WHERE userID='$patientID' ";
    $update_vcode_run = mysqli_query($con, $update_vcode);

    if($update_vcode_run)
    {
      $_SESSION['success'] = "Code was sent to your email";
      header("Location: ../../public/pages/patient-login-verification.php"); // If user type is "Admin", go to admin page
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Please register or verify your email address!";
      header("Location: ../../public/pages/patient-login.php");
      exit(0);
    }
  }
  else
  {
    $_SESSION['warning'] = "Please register or verify your email address!";
    header("Location: ../../public/pages/patient-login.php");
    exit(0);
  }
  $is_invalid = true; // send invalid login message if password is incorrect
}
