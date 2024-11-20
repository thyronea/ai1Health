<?php
// Send email
include(VENDOR_MAILER_PATH . '/Exception.php');
include(VENDOR_MAILER_PATH . '/PHPMailer.php');
include(VENDOR_MAILER_PATH . '/SMTP.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

function send_password_reset($userID, $fname, $lname, $email, $token){
  $mail = new PHPMailer(true);

  $mail->isSMTP();
  $mail->SMTPAuth = true;

  $mail->Host = "smtp.gmail.com";
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port = 587;

  $mail->Username = "";
  $mail->Password = "";

  $mail->setFrom($email);
  $mail->addAddress($email);

  $subject = htmlspecialchars("Reset Password");
  $message = htmlspecialchars_decode("
  Hello $fname,

  TO RESET YOUR PASSWORD, PLEASE CLICK ON THE LINK BELOW:
  http://localhost:8002/system/view/reset-pw/deelos.php?userID=$userID&token=$token

  If you did not make this request, please contact admin.

  Thank you!
  ");

  $mail->Subject = $subject;
  $mail->Body = $message;

  $mail->send();
}
?>
