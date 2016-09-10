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

<customHeader>
    <style>
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
        .user-info{
            color: #fff;
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
    </style>
    
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
</customHeader>

<div class="jumbotron jumbotron-fluid" style="background-image:url(<?=$jumboBackground;?>);background-size: cover;margin-bottom:0;">
  <div class="container">
    <div id="userAvatar" style="background-image:url(<?=$gravMod;?>);"></div>
    <div class="user-info">
        <a id="user-name" style="font-size:36px;font-weight:700;"><?=ucfirst($user->data()->username)?></a><br>
        <a id="user-add" style="font-size:16px;font-weight:600;">Member Since: <?php echo $signupdate;?></a><br>
        <a style="font-size:16px;font-weight:600;">Number of Logins: <?=$user->data()->logins?></a>
    </div>
  </div>
</div>

<div class="container" style="padding-top:8px;padding-bottom:8px;">
    <ul class="nav nav-tabs">
      <li class="nav-item">
          <a class="nav-link active" href="#">Photostream</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="../accAlbum.php?id=<?=$displayID?>">Album</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="#">Favorite</a>
      </li>
    </ul>                    
</div>

<div class="container-Collage" style="padding:0;">
<section class="Collage effect-parent">
    <?php
        $off = $page*50-50;
        $query7 =  "select distinct u.id, u.url, u.width, u.height from Url u join Common c on u.id=c.p_id where u.width is not null and u.height is not null and c.userBelong=$displayID order by c.dateR desc limit 50 offset $off";
        $Pageurl = "/indUser.php?id=$displayID&";
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
            echo "<div class=\"Image_Wrapper\">";
            echo "<a style=\"text-decoration:none;\" href=\"/indDisplay2.php?pid=".$row7[id]."\">";
            echo "<img src=\"".$row7[url]."\" width=\"".$row7[width]."\" height=\"".$row7[height]."\">";
            echo "</a>";
            echo "</div>";
        }
    } else {
        echo "0 results";
    }
    ?>
</section>
</div>

<div class="container-page">
    <ul class="pagination">
      <?php 
        if($page==1){
            //already at first page disable this buttom
            echo "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"#\">&lt; First</a></li>";
        }else{
            //not first page could have 1st page
            echo "<li class=\"page-item\"><a class=\"page-link\" href=\"".$Pageurl."page=1\"><span>&lt; First</span></a></li>";
            if($page!=2 && $page<=$totalPageNum){
                //this is for 3rd page and above
                echo "<li class=\"page-item\"><a class=\"page-link\" href=\"".$Pageurl."page=".($page-2)."\">".($page-2)."</a></li>";
                echo "<li class=\"page-item\"><a class=\"page-link\" href=\"".$Pageurl."page=".($page-1)."\">".($page-1)."</a></li>";
            }
        }
        ?>
        <li class="page-item active"><a class="page-link"><?=$page?></a></li>
        <li class="page-item"><a class="page-link">...</a></li>
        <?php
        if(($page+6)<=$totalPageNum){
        echo "<li class=\"page-item\"><a class=\"page-link\" href=\"".$Pageurl."page=".($page+6)."\">".($page+6)."</a></li>";
        if(($page+7)<=$totalPageNum){
        echo "<li class=\"page-item\"><a class=\"page-link\" href=\"".$Pageurl."page=".($page+7)."\">".($page+7)."</a></li>";
        if(($page+8)<=$totalPageNum){
        echo "<li class=\"page-item\"><a class=\"page-link\" href=\"".$Pageurl."page=".($page+8)."\">".($page+8)."</a></li>";
        }
        }
        }
        if(($page+1)<=$totalPageNum){
            echo "<li class=\"page-item\"><a class=\"page-link\" href=\"".$Pageurl."page=".($page+1)."\">Next &gt;</a></li>";}
            else{echo "<li class=\"disabled page-item\"><span>Next &gt;</span></li>";}
        ?>
    </ul>
</div>
<?php mysqli_close($conn); ?>
<?php require_once 'footer.php'; ?>

