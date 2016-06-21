<?php require_once '../users/init.php'; ?>
<?php include("../supplyment/dbAccess.php"); ?>
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
    $permissions             = "read";
    $path_to_phpFlickr_class = "./";

    ob_start();
    require_once($path_to_phpFlickr_class . "phpFlickr.php");
    unset($_SESSION['phpFlickr_auth_token']);
     
	if ( isset($_SESSION['phpFlickr_auth_redirect']) && !empty($_SESSION['phpFlickr_auth_redirect']) ) {
		$redirect = $_SESSION['phpFlickr_auth_redirect'];
		unset($_SESSION['phpFlickr_auth_redirect']);
	}
    
    $f = new phpFlickr($api_key, $api_secret);
 
    if (empty($_GET['frob'])) {
        $f->auth($permissions, false);
        print 'read permission requested';
    } else {
        $f->auth_getToken($_GET['frob']);
	}
    
    /*if (empty($redirect)) {
		header("Location: " . $default_redirect);
    } else {
		header("Location: " . $redirect);
    }*/
    $flickr_userID = $f->test_login ();
    print 'user id is: '.$flickr_userID['id'];
    $dbUserID = $user->data()->id;
    print 'db user id is: '.$dbUserID;
    $query = "select id from ScrapeUser where userID = $flickr_userID";
    $result=$conn->query($query);
    $row = mysqli_fetch_object($result);
    if($result->num_rows>0){
        //userID existed in ScrapeUser table
        $scrape_link_id = $row->id;
        $scrapemode = 0;
    }else{
        //need to insert new scrape user
        $conn->query("insert into ScrapeUser(userID,Ubelong) values($flickr_userID,\'flickr\')");
        $result2 = $conn->query("select id from ScrapeUser where userID = $flickr_userID");
        $scrape_link_id = mysqli_fetch_object($result2);
        $scrape_link_id = $scrape_link_id->id;
        //need to scrape this user in further script
        $scrapemode = 1;
    }
    //link between two
    $conn->query("insert into LinkUser(scrapeUserID, usersID, needAction) values($scrape_link_id,$dbUserID,$scrapemode)");
    print 'insert success, ready to exit';
}
else{
    echo 'please login first';
}
?>