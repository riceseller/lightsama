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
        $query2 = "delete from LinkUser where scrapeUserID='$deleteSUid' AND usersID='$get_info_id'"; //dont remove space
        $conn->query($query2);
        echo("<script>alert('sucess deleted!');location.href = '../users/account.php';</script>");
        /*if($conn->query($query2)==TRUE){
            echo("<script>alert('sucess! $query2');location.href = '../users/account.php';</script>");
        }else{
            $err = $conn->error;
            print $err;
            echo("<script>alert('fail!');location.href = '../users/account.php';</script>");
        }*/
    }
}else{
    //no login user, exit
    echo("<script>alert('please login first!');location.href = 'http://luokerenz.com/users/new_login.php?category=login';</script>");
}

