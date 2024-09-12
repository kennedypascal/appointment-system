<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = "smtp.zoho.in";
$mail->SMTPAuth = true;
$mail->Username = "contact@sainoxtechnologies.com";
$mail->Password = "sainoxtechnologies2020Aa";
$mail->SMTPSecure = "tls";
$mail->Port = 587;
$mail->From = "contact@sainoxtechnologies.com";
$mail->FromName = "VSMS";
$mail->addAddress("csheblikar@gmail.com", "Aakash Singh");
$mail->isHTML(true);
$mail->Subject = "Subject Text";
$mail->Body = "<i>Mail body in HTML</i>";
$mail->AltBody = "This is the plain text version of the email content";
try {
    $mail->send();
    echo "Message has been sent successfully";
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
