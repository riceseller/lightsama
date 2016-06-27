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

echo $results->email_login;

if($purpose=="bug")
{
    $body="someone has a bug to report, here is his find: ".$message." ";
    echo $body;
    
}


echo $purpose;
echo $name;
echo $email;
echo $message;

?>

