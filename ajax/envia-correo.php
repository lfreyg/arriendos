<?php

require "../extensiones/vendor/autoload.php";  
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = "reservasbahiamarina@gmail.com";
$mail->Password = "ncwrfmntfvknbbtr";
$mail->setFrom('reservasbahiamarina@gmail.com');
$mail->addAddress('l.frey.g@gmail.com');
$mail->Subject = 'Testing PHPMailer';
$mail->Body = 'This is a plain text message body';
//$mail->addAttachment('test.txt');
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'The email message was sent.';
}

?>