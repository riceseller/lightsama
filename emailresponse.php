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
$mail->Password = 'dreamega2016';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('hailoinn@hotmail.com', 'Mailer');
$mail->addAddress('hailoinn@hotmail.com', 'admin');     // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML



if($purpose=="bug")
{
    $mail->Subject = 'website bug report';
    $mail->Body    =" ".$name." has a bug to report, here is his find: ".$message."<br>"
            . "please get back to the sender via email provided: ".$email." as soon as possible";
    $mail->send(); 
        
}

else if($purpose=="contact")
{
    $mail->Subject = 'website contact form';
    $mail->Body    =" ".$name." just left a message for our website: ".$message."<br>"
            . "please get back to the sender via email provided: ".$email." if you want ";
    $mail->send();       
}
else
{
    echo "you come here from a wrong place";
}

exit();




?>

