<?php

   
use PHPMailer\PHPMailer\PHPMailer;
require "../extensiones/vendor/autoload.php";
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'catayflo.cl';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'sistema@catayflo.cl';
$mail->Password = 'Muela0891@#';
$mail->setFrom('sistema@catayflo.cl');
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