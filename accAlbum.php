<?php
require_once "users/init.php";
require_once "newNavBar.php";
require_once "supplyment/dbAccess.php";
if(isset($_GET['page'])) {
    // get page number for location of the album list
    $page = $_GET["page"];
}else{
    $page = 1;
}
if(isset($_GET['id'])) {
    // id index exists
    $displayID = $_GET["id"];
}else{
    // head to temp page
    header('Location: explore.php');
}
function pageCount($inputStr){
    $replace = 'select count(*) from ';
    $replace2 = ' ';
    $regex = '/select(.*)from/';
    $regex2 = '/limit(.*)/';
    $mid = preg_replace($regex, $replace, $inputStr);
    return preg_replace($regex2, $replace2, $mid);
}
?>
<?php
    //get user sign up date
    $get_info_id = $user->data()->id;
    $raw = date_parse($user->data()->join_date);
    $signupdate = $raw['month']."/".$raw['day']."/".$raw['year'];
    //get user avatar
    $query11 = "select * from ScrapeUser where id=$displayID";
    $result11=$conn->query($query11);
    $row11 = mysqli_fetch_array($result11);
    if($row11[Ubelong]=='flickr'){
        $server = $row11[extraOne];
        $farm = $row11[extraTwo];
        $userr = $row11[userID];
        $gravMod = "https://c2.staticflickr.com/$farm/$server/buddyicons/".$userr.".jpg";
    }
    //get jumbo background img
    $query12 = "select u.url from Url u join Common c on u.id=c.p_id join ScrapeAlbum sa on c.albumBelong = sa.id where sa.scrapeUserID = $displayID order by rand() limit 1";
    $result12=$conn->query($query12);
    $row12 = mysqli_fetch_array($result12);
    $jumboBackground = $row12[url];
?>
<customheader>
    <style>
        .card-img{
            width:100%;
            height:auto;
        }
        .card-img-overlay{
            padding: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0) 0%,rgba(0,0,0,0) 93%,rgba(0,0,0,0.5) 100%,rgba(0,0,0,0.5) 100%);
        }
        .card-title{
            bottom: 0;
            position: absolute;
            padding-left: 5%;
        }
        #userAvatar{
            z-index: 1;
            height: 100px;
            width: 100px;
            /* fill the container, preserving aspect ratio, and cropping to fit */
            background-size: cover;
            /* center the image vertically and horizontally */
            background-position: center;
            /* round the edges to a circle with border radius 1/2 container size */
            border-radius: 50%;
        }
        #userAvatar a{
            width: 100%;
            height: 100%;
            opacity: 0;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            font-weight: 700;
            color: #FFF;
        }
        #userAvatar:hover a{
            opacity: 0.85;
        }
        .user-info{
            color: #fff;
        }
    </style>
</customheader>
<div class="jumbotron jumbotron-fluid" style="background-image:url(<?=$jumboBackground;?>);background-size: cover;">
  <div class="container">
    <div id="userAvatar" style="background-image:url(<?=$gravMod;?>);">
        <a id="avatarHover" href="avaMod.php" style="text-decoration:none;">&#9998</a>
    </div>
    <div class="user-info">
        <a id="user-name" style="font-size:36px;font-weight:700;"><?=ucfirst($user->data()->username)?></a><br>
        <a id="user-add" style="font-size:16px;font-weight:600;">Member Since: <?php echo $signupdate;?></a><br>
        <a style="font-size:16px;font-weight:600;">Number of Logins: <?=$user->data()->logins?></a>
    </div>
  </div>
</div>
<div class="container">
    <div class="card-columns">
        <?php
            $off = $page*50-50;
            $query7 =  "select id,title,belong,coverphoto from ScrapeAlbum where scrapeUserID=$displayID order by id desc limit 50 offset $off";
            $Pageurl = "/accAlbum.php?id=$displayID&";
            $totalPage = pageCount($query7);
            //echo $totalPage;
            $Presult=$conn->query($totalPage);
            $Prow = $Presult->fetch_assoc();
            $totalPageNum = floor($Prow['count(*)']/50)+1;
            //echo $totalPageNum;
            $result7=$conn->query($query7);
            if ($result7->num_rows > 0) {
            // output data of each row
            while($row7 = $result7->fetch_assoc()) {
                echo "<div class=\"card card-inverse\">";
                echo "<img class=\"card-img\" src=\"".$row7[coverphoto]."\" alt=\"Card image\">";
                echo "<div class=\"card-img-overlay\">";
                echo "<h4 class=\"card-title\">".$row7[title]."</h4>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "0 results";
        }
        ?>
    </div>
</div>

<?php mysqli_close($conn); ?>
<?php require_once 'footer.php'; ?>