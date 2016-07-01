<?php
function displayBlock($row,$mode){
    if($mode==1){
        //display ind block using input
        if($row[Ubelong]=='flickr'){
                $server = $row[extraOne];
                $farm = $row[extraTwo];
                $userr = $row[userID];
                $avaStr = "background-image:url(https://c2.staticflickr.com/$farm/$server/buddyicons/$userr.jpg)";
            }elseif($row[Ubelong]=='500px'){
                $avaStr = "background-image:url($row[extraTwo])";
            }else{
                $avaStr = "background-image:url($grav)";
            }
        print "<div class='acc-block'>";
        print "<img style=$avaStr>";
        print "<div class='acc-userInfo'>";
        print "<div><a>ID: $row[userID]</a></div>";
        print "<div><a href='../indUser.php?id=$row[scrapeUserID]'>PhotoStream</a></div>";
        print "<div><a href=#>Ablum</a></div>";
        print "</div>";
        print "<a style='width:11px;align-self:flex-end;' href='ondelete.php?del=$row[userID]&be=$row[Ubelong]' onclick='return checkDelete()'>&#128465</a>";
        print "</div>";
    }
    if($mode==2){
    //display add block directly
    print '<div class="acc-block" style="justify-content:center;"><a href="../phpFlick/auth.php" style="font-size:80px;opacity:0.5;">&#8853</a></div>';
    }
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
    $query2 = "select custom1,custom2 from users where id=$get_info_id"; //custom1=>cover photo custom2=>avatar
    $result2=$conn->query($query2);
    $row2 = mysqli_fetch_array($result2);
    $query = "select su.*, lu.scrapeUserID from LinkUser lu join ScrapeUser su on lu.scrapeUserID=su.id where usersID=$get_info_id";
    $result=$conn->query($query);
    //$row = mysqli_fetch_array($result);
    #24380571446
    if($result->num_rows>0){
        $Umode = 1;
        if($row2[custom1]==''){
            //select default cover photo
            $query3 = "select urlSource from Url where id=24493854475";
            $result3=$conn->query($query3);
            $row3 = mysqli_fetch_array($result3);
            $coverPic = $row3[urlSource];
        } else {
            $coverPic = $row2[custom1];
        }
        if($row2[custom2]==''){
            $gravMod = $grav;
        }else{
            $gravMod = $row2[custom2];
        }
    }else{
        //this account has no linked account
        $Umode = 0;
        $query3 = "select urlSource from Url where id=24493854475";
        $result3=$conn->query($query3);
        $row3 = mysqli_fetch_array($result3);
        $coverPic = $row3[urlSource];
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
    .uPic-container{
        margin-top: 130px;
        margin-left: 10%;
        width: 100px;
        height: 100px;
    }
    .uPic-OL{
        font-weight: 700;
        font-size: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        top:0;
        right:0;
        opacity: 0;
        width: 100px;
        height: 100px;
        z-index: 3;
    }
    .uPic-OL:hover{
        opacity: 0.85;
    }
    .uPic-container img{
        z-index: 2;
        position: relative;
        top:-100px;
        right:0;
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
        width:100%;
        margin: 0 10%;
        min-height: calc(100vh - 50px - 250px - 50px);
    }
    .acc-block {
        /*border-radius: 25px;*/
        display: flex;
        align-items: center;
        justify-content: flex-start;
        margin: 30px 2% 0px 2%;
        border: 2px solid #cfd6d9;
        min-width: 200px;
        width: 20%;
        height: 150px; 
    }
    .acc-block img{
        margin-top: 19px;
        margin-bottom: 59px;
        margin-left: 20px;
        width: 72px;
        height: 72px;
        /* fill the container, preserving aspect ratio, and cropping to fit */
        background-size: cover;
        /* center the image vertically and horizontally */
        background-position: center;
        /* round the edges to a circle with border radius 1/2 container size */
        border-radius: 50%;
    }
    .acc-userInfo{
        margin-top: 6px;
        margin-bottom: 19px;
        margin-left: 15px;
        width: calc(100% - 92px - 30px);
        height:112px;        
    }
    .acc-userInfo div{
        margin: 13px 2px;
    }
    .acc-userInfo a{
        padding: 3px 5px;
        border: 1px solid #cfd6d9;
        width: auto;
    }
</style>
<link rel="stylesheet" href="../node_modules/jquery.modal.min.css" type="text/css" media="screen" />

<script src="../node_modules/jquery.min.js"></script>
<script src="../node_modules/jquery.modal.min.js" type="text/javascript" charset="utf-8"></script>

<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Are you sure?');
}
</script>

<div id="main-content">
<div class="user-container" style="background-image: url('<?php print $coverPic;?>');background-size: cover;">
    <div class="uPic-container">
        <div class="uPic-OL"><a href="avaMod.php" rel="modal:open">&#9998</a></div>
        <img style="background-image:url(<?=$gravMod;?>);">
    </div>
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
<li><a href="#">Favorite</a></li>
<div class="clearFloat"></div>
</ul>
</div>
    
<div class="well">
    <?php
        if($Umode==1){
            //print $row[userID]
            //displayBlock($row[scrapeUserID],$row[userID], $row[Ubelong]);
            while($row = mysqli_fetch_array($result)) {
                displayBlock($row,1);
            }
            displayBlock($row,2);
        }else{
            displayBlock($row,2);
        }
    ?>
</div>

</div> <!-- /#main-content -->
<!-- footers -->
<?php require_once '../footer.php' //require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
