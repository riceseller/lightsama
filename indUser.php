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
$off = $page*50-50;

if(isset($_GET['id']) and isset($_GET['albumid'])) {
    // both user id and album id inputs exist, show only specific album pics
    $displayID = $_GET["id"];
    $albumID = $_GET["albumid"];
    $Pageurl = "/indUser.php?id=$displayID&albumid=$albumID&";
    $query7 =  "select distinct u.id, u.url, u.width, u.height from Url u join Common c on u.id=c.p_id where u.width is not null and u.height is not null and c.userBelong=$displayID and albumBelong=$albumID order by c.dateR desc limit 50 offset $off";
    $q_album_name = "select title from ScrapeAlbum where id=$albumID";
    $result_q_a_n=$conn->query($q_album_name);
    $row_q_a_n = mysqli_fetch_array($result_q_a_n);
    $albumName = '->'.$row_q_a_n['title'];
}elseif(isset($_GET['id']) and empty($_GET['albumid'])){
    // show all pic for userID
    $displayID = $_GET["id"];
    $Pageurl = "/indUser.php?id=$displayID&";
    $query7 =  "select distinct u.id, u.url, u.width, u.height from Url u join Common c on u.id=c.p_id where u.width is not null and u.height is not null and c.userBelong=$displayID order by c.dateR desc limit 50 offset $off";
    $albumName = '';    
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
    $scrapeUserName = $row11['displayName'];
    if($row11['Ubelong']=='flickr' or $row11['Ubelong']=='Flickr'){
        $server = $row11['extraOne'];
        $farm = $row11['extraTwo'];
        $userr = $row11['userID'];
        $gravMod = "https://c2.staticflickr.com/$farm/$server/buddyicons/".$userr.".jpg";
    }elseif($row11[Ubelong]=='500px'){
        $gravMod = $row11['extraTwo'];
    }
    //get jumbo background img
    $query12 = "select u.url from Url u join Common c on u.id=c.p_id join ScrapeUser su on c.userBelong = su.id where su.id = $displayID order by rand() limit 1";
    $result12=$conn->query($query12);
    $row12 = mysqli_fetch_array($result12);
    $jumboBackground = $row12['url'];
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

<script>
        // load remote page via jquery
        $(document).on('click','#userClick',function(event) {
            event.preventDefault();            
            var modal = $('#gridSystemModal').modal();
            modal.find('.modal-content').load($(this).attr('href'), function () {
                    //$('.modal-content').css('height',$( window ).height());
                    modal.show();                   
                });
        });
</script>

<div class="jumbotron jumbotron-fluid" style="background-image:url(<?=$jumboBackground;?>);background-size: cover;margin-bottom:0;">
  <div class="container">
    <div id="userAvatar" style="background-image:url(<?=$gravMod;?>);"></div>
    <div class="user-info">
        <a id="user-name" style="font-size:36px;font-weight:700;"><?=$scrapeUserName?></a><br>
    </div>
  </div>
</div>

<div class="container" style="padding-top:8px;padding-bottom:8px;">
    <ul class="nav nav-tabs">
      <li class="nav-item">
          <a class="nav-link active">Photostream<?=$albumName?></a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="../accAlbum.php?id=<?=$displayID?>">Album</a>
      </li>
    </ul>                    
</div>

<div class="container-Collage" style="padding:0;">
<section class="Collage effect-parent">
    <?php
        $totalPage = pageCount($query7);
        $Presult=$conn->query($totalPage);
        $Prow = $Presult->fetch_assoc();
        $totalPageNum = floor($Prow['count(*)']/50)+1;
        //echo $totalPageNum;
        $result7=$conn->query($query7);
        if ($result7->num_rows > 0) {
        // output data of each row
        while($row7 = $result7->fetch_assoc()) {
            echo "<div class=\"Image_Wrapper\">";
            echo "<a id=\"userClick\" style=\"text-decoration:none;\" href=\"/indDisplay4.php?pid=".$row7[id]."&url=".$row7[url]."\">";
            echo "<img src=\"".$row7['url']."\" width=\"".$row7['width']."\" height=\"".$row7['height']."\">";
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
            else{echo "<li class=\"disabled page-item\"><a class=\"page-link\">Next</a></li>";}
        ?>
    </ul>
</div>
<?php mysqli_close($conn); ?>
<?php require_once 'footer.php'; ?>

<div id="gridSystemModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modalDialogID">
    <div class="modal-content" id="modalContentID">
      
    </div>
  </div>
</div>