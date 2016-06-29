<?php
function displayBlock($suid,$userID,$belong){
    if($userID!=0){
        //display ind block using input
        print "<div class='acc-block'><a href='../indUser.php?id=$suid'>$userID</a></div>";
    }
    //display add block directly
    print '<div class="acc-block"><a href="../phpFlick/auth.php" style="font-size:80px;opacity:0.5;">&#8853</a></div>';
}
?>
<?php require_once 'init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>
<?php require_once "../supplyment/dbAccess.php"; ?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();}
 if ($settings->site_offline==1){die("The site is currently offline.");}?>
<?php
$grav = get_gravatar(strtolower(trim($user->data()->email)));
$get_info_id = $user->data()->id;
// $groupname = ucfirst($loggedInUser->title);
$raw = date_parse($user->data()->join_date);
$signupdate = $raw['month']."/".$raw['day']."/".$raw['year'];
$userdetails = fetchUserDetails(NULL, NULL, $get_info_id); //Fetch user details
 ?>

<?php
    $query = "select su.*, lu.scrapeUserID from LinkUser lu join ScrapeUser su on lu.scrapeUserID=su.id where usersID=$get_info_id";
    $result=$conn->query($query);
    $row = mysqli_fetch_array($result);
    #24380571446
    if($result->num_rows>0){
        $Umode = 1;
        $query2 = "select urlSource from Url where id=24493854475"; //temp cover
        $result2=$conn->query($query2);
        $row2 = mysqli_fetch_array($result2);
    }
?>
<style>
    #main-content{
        min-height: calc(100vh - 50px);
        width: 100%;
    }
    .user-container{
        display: flex;
        flex-wrap: nowrap;
        height: 250px;
        width: 100%;
    }
    .user-container img{
        margin-top: 130px;
        margin-left: 10%;
        width: 100px;
        height: 100px;
        /* fill the container, preserving aspect ratio, and cropping to fit */
        background-size: cover;
        /* center the image vertically and horizontally */
        background-position: center;
        /* round the edges to a circle with border radius 1/2 container size */
        border-radius: 50%;
    }
    .user-container a{
        color: #fff;
    }
    .user-info{
        margin-top: 140px;
        margin-left: 15px;
        max-width: 40%;
    }
    .menu{
        font-weight: 600;
        width:100%;
        height: 49px;
        border-bottom: 1px solid #dcdcdc;
    }
    .menu ul{
        list-style:none;
        background:#ffffff;
        margin:0;
        padding:0;
    }
    .menu li{
        display:inline-block;
        float:left;
        margin-left:1%;
    }
    .menu li:first-child{
        margin-left:10%;
    }
    .menu a{
        display:block;
        padding: 12px 20px;
        text-decoration:none;
        color:#000000;
        border-top:3px solid transparent;
    }
    .menu a:hover,
    .menu li.active a{
        background:#ffffff;
        color:#000000;
        border-bottom: 3px solid #0091dc;
    }
    .well{
        display: flex;
        justify-content: flex-start;
        width:80%;
        margin: 0 10%;
        min-height: calc(100vh - 50px - 250px - 50px);
    }
    .acc-block {
        /*border-radius: 25px;*/
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 30px 2% 0px 2%;
        border: 2px solid #cfd6d9;
        width: 20%;
        height: 150px; 
    }
</style>

<div id="main-content">
<div class="user-container" style="background-image: url('<?php print $row2[urlSource];?>');background-size: cover;">
    <img style="<?php
                    if($row[Ubelong]=='flickr')
                    {
                        $server = $row[extraOne];
                        $farm = $row[extraTwo];
                        $userr = $row[userID];
                        print "background-image:url(https://c2.staticflickr.com/$farm/$server/buddyicons/$userr.jpg)";
                    }
                    elseif($row[Ubelong]=='500px')
                    {
                        print "background-image:url($row[extraTwo])";
                    }
                    else
                    {
                        print $grav;
                    }
                ?>">
    <div class="user-info">
        <a id="user-name" style="font-size:36px;font-weight:700;"><?=ucfirst($user->data()->username)?></a><br>
        <a id="user-add" style="font-size:16px;font-weight:600;">Member Since: <?=$signupdate?></a><br>
        <a style="font-size:16px;font-weight:600;">Number of Logins: <?=$user->data()->logins?></a>
    </div>
</div>
    
<div class="menu">
<ul>
<li class="active"><a href="#">Your Linked Account</a></li>
<li><a href="../phpFlick/auth.php">Add New Flickr Account</a></li>
<li><a href="user_settings.php">Edit Account Info</a></li>
<div class="clearFloat"></div>
</ul>
</div>
    
<div class="well">
    <?php
        if($Umode==1){
            //print $row[userID]
            displayBlock($row[scrapeUserID],$row[userID], $row[Ubelong]);
            /*while($row = $result->fetch_assoc()) {
                //displayBlock($row[userId], $row[Ubelong]);
            }*/
        }else{
            displayBlock(0,0,0);
        }
    ?>
</div>

</div> <!-- /#main-content -->
<!-- footers -->
<?php require_once '../footer.php' //require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
