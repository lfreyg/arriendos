<?php

   
use PHPMailer\PHPMailer\PHPMailer;
require "../extensiones/vendor/autoload.php";
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'const-alcantara.cl';
$mail->Port = 25;
$mail->SMTPAuth = true;
$mail->Username = "bahiamarina@const-alcantara.cl";
$mail->Password = "muela08912242$;";
$mail->setFrom('bahiamarina@const-alcantara.cl');
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