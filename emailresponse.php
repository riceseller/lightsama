<?php
require_once 'users/init.php';
//include 'supplyment/dbAccess.php';
$purpose=$_GET["purpose"];
$name=$_POST["name"];
$email=$_POST["email"];
$message=$_POST["message"];

$mail = new PHPMailer;

//$mail->SMTPDebug = 2;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.live.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'hailoinn@hotmail.com';                 // SMTP username
$mail->Password = 'ChengandYu';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('hailoinn@hotmail.com', 'Mailer');
$mail->addAddress('hailoinn@hotmail.com', 'admin');     // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML



if($purpose=="bug")
{
    $mail->Subject = 'website bug report';
    $mail->Body    ="someone has a bug to report, here is his find: ".$message." ";
    //$mail_result=email($to,$subject,$body); 
    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
    //echo "bug here";
}

else if($purpose=="contact")
{
    $subject="someone just left you a message";
    $body="someone is giving you a word, here is the message: ".$message."";
    //$mail_result=email($to, $subject, $body);
    echo $body;
}
else
{
    echo "you come here from a wrong place";
}

if($mail_result)
{
    echo "message sent successfully";
}
/*
else
{
    echo "message sent fail, please contact admin";
}
*/



?>

