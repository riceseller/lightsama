<?php
    require_once 'init.php'; 
    require_once '../supplyment/dbAccess.php';
    require_once '../phpFlick/phpFlickr.php';
    
    if(isset($_POST['albumID'])) {
        // verify current user
        $albumID = $_POST["albumID"];
        $query1 = "select u.id from ScrapeAlbum sa join LinkUser lu on sa.scrapeUserID=lu.scrapeUserID join users u on lu.usersID=u.id where sa.id=$albumID";
        $result1=$conn->query($query1);
        $row1 = mysqli_fetch_array($result1);
        $userIdCheck = $user->data()->id;
        if ($row1[id]==$userIdCheck){$pass = 1;}
        else{ $pass = 0;}
    }else{
        // head to temp page
        echo "<a href='account.php'>Please login to modify your album!</a>";
        $pass = 0;
    }
    
    if($user->isLoggedIn() and $pass==1){
        $query2 = "update ScrapeAlbum set needAction=1 where id=$albumID";
        $conn->query($query2);
    }

