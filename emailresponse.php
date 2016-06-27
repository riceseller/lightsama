<?php
require_once 'users/init.php';
//include 'supplyment/dbAccess.php';
$purpose=$_GET["purpose"];
$name=$_POST["name"];
$email=$_POST["email"];
$message=$_POST["message"];

$db = DB::getInstance();
$query = $db->query("SELECT * FROM email");
$results = $query->first();

$to=$results->email_login;

if($purpose=="bug")
{
    $subject="a bug to report";
    $body="someone has a bug to report, here is his find: ".$message." ";
    $mail_result=email($to,$subject,$body); 
}

else if($purpose=="contact")
{
    $subject="someone just left you a message";
    $body="someone is giving you a word, here is the message: ".$message."";
    $mail_result=email($to, $subject, $body);
}
else
{
    echo "you come here from a wrong place";
}

if($mail_result)
{
    echo "message sent successfully";
}
else
{
    echo "message sent fail, please contact admin";
}




?>

