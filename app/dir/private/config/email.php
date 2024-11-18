<?php
include(VENDOR_MAILER_PATH . '/Exception.php');
include(VENDOR_MAILER_PATH . '/PHPMailer.php');
include(VENDOR_MAILER_PATH . '/SMTP.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

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

$mail->Subject = $subject;
$mail->Body = $message;

$mail->send();
?>