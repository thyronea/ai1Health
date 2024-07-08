<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = "donotreply@ai1system.net";
$mail->Password = "awxo vbxo hvix pitc";

$mail->setFrom($email);
$mail->addAddress($patient_email);

$mail->Subject = $subject;
$mail->Body = $message;

$mail->send();

?>
