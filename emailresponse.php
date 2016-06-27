<?php
require_once 'init.php';
include "supplyment/dbAccess.php";
$purpose=$_GET["purpose"];
$name=$_POST["name"];
$email=$_POST["email"];
$message=$_POST["message"];

$query = $db->query("SELECT email_login FROM email");
$results = $conn->query($query);
$row=$result->fetch_assoc();
echo $row;

if($purpose=="bug")
{
    $body="someone has a bug to report, here is his find: ".$message." ";
    
}

/*
echo $purpose;
echo $name;
echo $email;
echo $message;
*/
?>

