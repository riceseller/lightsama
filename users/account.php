<?php
/*
UserSpice 4
An Open Source PHP User Management System
by the UserSpice Team at http://UserSpice.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
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
        $query2 = "select urlSource from Url where id=24493854475"; //temp cover
        $result2=$conn->query($query2);
        $row2 = mysqli_fetch_array($result2);
    }
?>
<style>
    #main-content{
        height: calc(100vh - 50px - 20vh);
        width: 100%;
    }
    .user-container{
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
    .menu{
        font-size:12pt;
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
        width:100%;
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
</div>
    
<div class="menu">
<ul>
<li class="active"><a href="#">Explore All</a></li>
<li><a href="tags.php">Tags</a></li>
<li><a>Keyword</a></li>
<div class="clearFloat"></div>
</ul>
</div>
    
<div class="well">
    <div class="row">
        <div class="col-xs-12 col-md-3">
            <p><a href="user_settings.php" class="btn btn-primary">Edit Account Info</a></p>
            <p><a class="btn btn-primary " href="profile.php?id=<?=$get_info_id;?>" role="button">Public Profile</a></p>
            <p><a href="../phpFlick/auth.php">verify your flickr account</a></p>
            <p><a href="../indUser.php?id=<?php print $row[scrapeUserID]; ?>">your linked account</a></p>
        </div>
        <div class="col-xs-12 col-md-9">
            <h1><?=ucfirst($user->data()->username)?></h1>
            <p><?=ucfirst($user->data()->fname)." ".ucfirst($user->data()->lname)?></p>
            <p>Member Since:<?=$signupdate?></p>
            <p>Number of Logins: <?=$user->data()->logins?></p>
            <p>This is the private account page for your users. It can be whatever you want it to be; This code serves as a guide on how to use some of the built-in UserSpice functionality. </p>
        </div>
    </div>
</div>

</div> <!-- /#main-content -->

<!-- footers -->
<?php require_once '../footer.php' //require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
