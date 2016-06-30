<?php
require_once 'init.php';
require_once '../supplyment/dbAccess.php';
?>

<?php
$pending_UID = $_GET['del'];
$belong = $_GET['be'];
if($user->isLoggedIn()){
    $get_info_id = $user->data()->id;
    if(empty($_GET['del'])or empty($_GET['be'])){
        //check input is correct
        echo("<script>alert('invalid request!');location.href = '../users/account.php';</script>");
    }else{
        $query = "select id from ScrapeUser where userID='$pending_UID' and Ubelong='$belong'";
        $result=$conn->query($query);
        $row = mysqli_fetch_array($result);
        $deleteSUid = $row[id];
        $query2 = "delete lu from LinkUser lu where scrapeUserID=$deleteSUid and﻿ usersID=$get_info_id";
        $conn->query($query2);
        echo("<script>alert('delete success!');location.href = '../users/account.php';</script>");
    }
}else{
    //no login user, exit
    echo("<script>alert('please login first!');location.href = 'http://luokerenz.com/users/new_login.php?category=login';</script>");
}

