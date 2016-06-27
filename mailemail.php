<?php

require_once 'users/init.php';


$mail = new PHPMailer;

$mail->SMTPDebug = 2;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.live.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'hailoinn@hotmail.com';                 // SMTP username
$mail->Password = 'ChengandYu';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('hailoinn@hotmail.com', 'Mailer');
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
