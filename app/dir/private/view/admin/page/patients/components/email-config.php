<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = "thyrone.antonio@gmail.com";
$mail->Password = "mhopftvkjlemevgn";

$mail->setFrom($email, htmlspecialchars($_SESSION['fname']));
$mail->addAddress($patient_email);

$mail->Subject = $subject;
$mail->Body = $message;

$mail->send();

?>
