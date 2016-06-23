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
<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php
//PHP Goes Here!

if($user->isLoggedIn()) { $thisUserID = $user->data()->id;} else { $thisUserID = 0; }

if(isset($_GET['id']))
	{
	$userID = Input::get('id');
	
	$userQ = $db->query("SELECT * FROM profiles LEFT JOIN users ON user_id = users.id WHERE user_id = ?",array($userID));
	$thatUser = $userQ->first();

	if($thisUserID == $userID)
		{
		$editbio = ' <small><a href="edit_profile.php">Edit Bio</a></small>';
		}
	else
		{
		$editbio = '';
		}
	
	$ususername = ucfirst($thatUser->username)."'s Profile";
	$grav = get_gravatar(strtolower(trim($thatUser->email)));
	$useravatar = '<img src="'.$grav.'" class="img-thumbnail" alt="'.$ususername.'">';
	$usbio = html_entity_decode($thatUser->bio);
	//Uncomment out the line below to see what's available to you.
	//dump($thisUser);
	}
else
	{
	$ususername = '404';
	$usbio = 'User not found';
	$useravatar = '';
	$editbio = ' <small><a href="/">Go to the homepage</a></small>';
	}
?>

<style>
    body{
        background: #f3f5f6;
    }
    .Collage{
    /* define how much padding you want in between your images */
    padding:5px;
    background: #f3f5f6;
    }

    .Collage img{
    /* ensures padding at the bottom of the image is correct */
    vertical-align:bottom;
    /* hide the images until the plugin has run. the plugin will reveal the images*/
    opacity: 1;
    }
    .Image_Wrapper{
    /* to get the fade in effect, set opacity to 0 on the first element within the gallery area */
    opacity:0;
    -moz-box-shadow:0px 2px 4px rgba(0, 0, 0, 0.1);
    -webkit-box-shadow:0px 2px 4px rgba(0, 0, 0, 0.1);
    box-shadow:0px 2px 4px rgba(0, 0, 0, 0.1);
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    }
    div.pagination-cont {
        float: left;
        width: 100%;
        /*overflow: hidden;*/
        position: relative;
        margin: 15px 0;
        border-top: 1px solid #d1d1d3;
        padding-bottom: 2px;
        background-color: #e4e4e6;
    }
    div.pagination-cont ul.pagination {
        clear: left;
        float: left;
        list-style: none;
        padding: 0;
        margin: 0;
        position: relative;
        left: 50%;
        text-align: center;
    }
    ul.pagination li {
        display: block;
        float: left;
        list-style: none;
        margin: 0;
        padding: 0;
        position: relative;
        right: 50%;
        font-size: 110%;
        text-transform: uppercase;
        font-weight: bold;
    }
    ul.pagination li.disabled span,
    ul.pagination li.separator {
        color: #bbb;
        text-shadow: 1px 1px 0 #f2f2f2;
        padding: 10px 20px;
        display: block;
    }
    ul.pagination li.separator {
        border-left: 1px solid #d1d1d3
    }
    ul.pagination li a {
        display: block;
        padding: 10px 20px;
        color: #004276;
        text-decoration: none;
        border-left: 1px solid #d1d1d3;
        margin-bottom: 1px
    }
    ul.pagination li.current span {
        display: block;
        padding: 10px 20px;
        border-left: 1px solid #d1d1d3;
        background-color: #fff;
        color: #999;
        border-bottom: 1px solid #d1d1d3;
        top:-1px;

    }
    .menu{
        font-family:Arial, Helvetica, sans-serif;
        font-size:20px;
        width:100%;
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
        margin-left:20%;
    }
    .menu a{
        display:block;
        padding:10px;
        text-decoration:none;
        color:#000000;
        border-top:2px solid transparent;
    }
    .menu a:hover,
    .menu li.active a{
        background:#ffffff;
        color:#000000;
        border-bottom: 2px solid #0091dc;
    }
    .clearFloat{
        clear:both;
    }
    </style>

<script src="/node_modules/jquery.min.js"></script>
<script src="/node_modules/jquery.collagePlus.js"></script>
<script src="/node_modules/jquery.removeWhitespace.js"></script>

<script>
// All images need to be loaded for this plugin to work so
    $(document).ready(function(){
            collage();
            //$('.Collage').collageCaption();
    });
    // Here we apply the actual CollagePlus plugin
    function collage() {
        $('.Collage').removeWhitespace().collagePlus(
            {
                'fadeSpeed'     : 1000,
                'targetHeight'  : 400,
                'allowPartialLastRow' : true
            }
        );
    };
</script>

   <div id="page-wrapper">

		 <div class="container">
				<!-- Main jumbotron for a primary marketing message or call to action -->
				<div class="well">
					<div class="row">
						<div class="col-xs-12 col-md-2">
							<p><?php echo $useravatar;?></p>
						</div>
						<div class="col-xs-12 col-md-10">
						<h1><?php echo $ususername;?></h1>
							<h2><?php echo $usbio.$editbio;?></h2>
	
					</div>
					</div>
				</div>
				
										<a class="btn btn-success" href="view_all_users.php" role="button">All Users</a>


    </div> <!-- /container -->
    <section class="Collage effect-parent">
        <?php
            $off = $page*20-20;
            $query = "select distinct u.id, u.url, u.width, u.height from Url u join Common c on u.id=c.p_id where c.nsfw=0 and u.width is not null and u.height is not null order by c.dateR desc limit 20 offset $off";
            $result=$conn->query($query);
            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<div class=\"Image_Wrapper\">";
                echo "<a style=\"text-decoration:none;\" href=\"/indDisplay2.php?pid=".$row[id]."\">";
                echo "<img src=\"".$row[url]."\" width=\"".$row[width]."\" height=\"".$row[height]."\">";
                echo "</a>";
                echo "</div>";
            }
        } else {
            echo "0 results";
        }
        ?>
    </section>
    <div class="pagination-cont">
        <ul class="pagination">
            <?php 
            if($page==1){
                echo "<li class=\"disabled\"><span>&lt; First</span></li>";
            }else{
                echo "<li><a href=\"explore.php?page=1\"><span>&lt; First</span></a></li>";
                if($page!=2){
                    echo "<li><a href=\"/explore.php?page=".($page-2)."\">".($page-2)."</a></li>";
                    echo "<li><a href=\"/explore.php?page=".($page-1)."\">".($page-1)."</a></li>";
                }
            }
            ?>
            <li class="current"><span><?php echo $page ?></span></li>
            <li class="separator">&hellip;</li>
            <li><?php
            echo "<a href=\"/explore.php?page=".($page+6)."\">".($page+6)."</a>";
            ?></li><li><?php
            echo "<a href=\"/explore.php?page=".($page+7)."\">".($page+7)."</a>";
            ?></li><li><?php
            echo "<a href=\"/explore.php?page=".($page+8)."\">".($page+8)."</a>";
            ?></li>
            <li><?php echo "<a href=\"explore.php?page=".($page+1)."\">Next &gt;</a>";
            ?></li>
        </ul>
    </div>
</div> <!-- /#page-wrapper -->
 
<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>
<!-- Place any per-page javascript here -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>