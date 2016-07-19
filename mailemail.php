<?php

require_once 'users/init.php';

date_default_timezone_set('America/New_York');  //set default time zone as eastern time new york


$mail = new PHPMailer;

$mail->SMTPDebug = 2;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = '110024089a@gmail.com';                 // SMTP username
$mail->Password = 'GAOsanbaban67890';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('hz4z.com', 'Mailer');
$mail->addAddress('hicyc@163.com', 'fuck you');     // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'revenge';

$mail->Body    = 'you ranked us to the library, to the lab, and to the classroom by our score, you dont know how hurtful it is, therefore i remind you how hurtful it is to me'
        . '       you dont respect students, and the only thing you care is the score performance. you gotta pay for what you have done. '
        . '       I used to stay in the classroom, nobody cares the shit of my score, and everyone including the teacher ignores me. They have to pay, and you have to pay. '
        . '       This is just the beginning. I learned the tech on how to kick your ass. You will get everything you deserve.  '
        . '       This could b a very good article you use to teach your ass teachers how to respect students';

$mail->AltBody = 'test2';
$counter=0;


while(1){
    if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
    sleep(10);
    $counter=$counter+1;
    if($counter==10)
    {
        break;
    }
}



?>
