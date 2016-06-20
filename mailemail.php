<?php

require_once '../users/classes/phpmailer/class.phpmailer.php';
require_once '../users/classes/phpmailer/PHPMailerAutoload.php';
require_once '../users/classes/phpmailer/class.smtp.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = '110024089a@gmail.com';                 // SMTP username
$mail->Password = 'GAOsanbaban67890';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('110024089a@gmail.com', 'Mailer');
$mail->addAddress('cheng.yic@husky.neu.edu', 'Yichen Cheng');     // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'test';
$mail->Body    = 'test';
$mail->AltBody = 'test2';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

?>
