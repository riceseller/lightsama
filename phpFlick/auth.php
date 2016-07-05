<?php require_once '../users/init.php'; ?>
<?php require_once "../supplyment/dbAccess.php"; ?>
<?php
if($user->isLoggedIn()){
    /* Last updated with phpFlickr 2.3.2
     *
     * Edit these variables to reflect the values you need. $default_redirect 
     * and $permissions are only important if you are linking here instead of
     * using phpFlickr::auth() from another page or if you set the remember_uri
     * argument to false.
     */
    $api_key                 = "9c7e15fd3e006075c3647c94ee891bd8";
    $api_secret              = "59cd2bc5e832fe79";
    $default_redirect        = "http://db.luokerenz.com/phpFlick/example.php";
    $permissions             = "write";
    $path_to_phpFlickr_class = "./";

    ob_start();
    require_once($path_to_phpFlickr_class . "phpFlickr.php");
    unset($_SESSION['phpFlickr_auth_token']);
    
    $f = new phpFlickr($api_key, $api_secret);
 
    if (empty($_GET['frob'])) {
        $f->auth($permissions, false);
        //print 'read permission requested';
    } else {
        $f->auth_getToken($_GET['frob']);
    }
    
    /*if (empty($redirect)) {
		header("Location: " . $default_redirect);
    } else {
		header("Location: " . $redirect);
    }*/
    $flickr_userID = $f->test_login ();
    $flickr_userID = $flickr_userID['id'];
    //print 'user id is: '.$flickr_userID;
    $dbUserID = $user->data()->id;
    //print 'db user id is: '.$dbUserID;
    $query = "select id from ScrapeUser where userID = '$flickr_userID'";
    //print $query;
    $result=$conn->query($query);
    $row = mysqli_fetch_array($result);
    if($result->num_rows>0){
        //userID existed in ScrapeUser table
        $scrape_link_id = $row['id'];
        $scrapemode = 0;
    }else{
        //need to insert new scrape user
        $queryN = "insert into ScrapeUser(userID,Ubelong) values('$flickr_userID','flickr')";
        //print $queryN;
        $conn->query($queryN);
        $query2 = "select id from ScrapeUser where userID = '$flickr_userID'";
        //print $query2;
        $result2 = $conn->query($query2);
        $row2 = mysqli_fetch_array($result2);
        $scrape_link_id = $row2['id'];
        //need to scrape this user in further script
        $scrapemode = 1;
    }
    //link between two
    $authToken = $_SESSION['phpFlickr_auth_token'];
    print_r($authToken);
    $authToken = $authToken[0];
    print $authToken;
    $query2 = "insert into LinkUser(scrapeUserID, usersID, needAction, authToken) values($scrape_link_id,$dbUserID,$scrapemode,'$authToken')";
    print $query2;
    if ($conn->query($query2) === True){
        //insert success
        //print 'insert success, ready to exit';
        //shell_exec('export AIRFLOW_HOME=\"/home/luokerenz/airflow\" && airflow trigger_dag flickr_link_script');
        //echo "<script>window.location = '../users/account.php'</script>";
    }else{
        //print $conn->error;
        echo '<script type="text/javascript">alert("possible duplicate linking or this account is belong to others");</script>';
        echo "<script>window.location = '../users/account.php'</script>";
        //echo '<script type="text/javascript">window.close();</script>';
    }
}
else{
    echo '<script type="text/javascript">alert("please login first");</script>';
    echo "<script>window.location = '../index.php'</script>";
}
?>