<?php
require_once 'users/init.php';
include("newNavBar.php");
include "supplyment/dbAccess.php";
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
?>
<customhead>
    <style>
    body{
        background: #f3f5f6;
    }
    div.pagination-cont {
        float: left;
        width: 100%;
        /*overflow: hidden;*/
        position: relative;
        margin-top: 15px;
        border-top: 1px solid #d1d1d3;
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
        font-size: 100%;
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
</customheader>

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
<li><a href="indUser.php?id=<?php echo $displayID;?>">Photostream</a></li>
<li class="active"><a>Album</a></li>
<li><a href="#">Keyword</a></li>
<div class="clearFloat"></div>
</ul>
</div>

<div class="card-deck-wrapper">
  <div class="card-deck">
    <?php
        $test = "https://c3.staticflickr.com/2/1568/24644753442_89b821307d.jpg";
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
            echo "<div class=\"card\">";
            echo "<img class=\"card-img-top\" src=\"".$row7[coverphoto]."\" alt=\"Card image cap\">";
            echo "<div class=\"card-block\">";
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
<div class="pagination-cont">
    <ul class="pagination">
        <?php 
        if($page==1){
            //already at first page disable this buttom
            echo "<li class=\"disabled\"><span>&lt; First</span></li>";
        }else{
            //not first page could have 1st page
            echo "<li><a href=\"".$Pageurl."page=1\"><span>&lt; First</span></a></li>";
            if($page!=2 && $page<=$totalPageNum){
                //this is for 3rd page and above
                echo "<li><a href=\"".$Pageurl."page=".($page-2)."\">".($page-2)."</a></li>";
                echo "<li><a href=\"".$Pageurl."page=".($page-1)."\">".($page-1)."</a></li>";
            }
        }
        ?>
        <li class="current"><span><?php echo $page ?></span></li>
        <li class="separator">&hellip;</li>
        <?php
        if(($page+6)<=$totalPageNum){
        echo "<li><a href=\"".$Pageurl."page=".($page+6)."\">".($page+6)."</a></li>";
        if(($page+7)<=$totalPageNum){
        echo "<li><a href=\"".$Pageurl."page=".($page+7)."\">".($page+7)."</a></li>";
        if(($page+8)<=$totalPageNum){
        echo "<li><a href=\"".$Pageurl."page=".($page+8)."\">".($page+8)."</a></li>";
        }
        }
        }
        if(($page+1)<=$totalPageNum){
            echo "<li><a href=\"".$Pageurl."page=".($page+1)."\">Next &gt;</a></li>";}
            else{echo "<li class=\"disabled\"><span>Next &gt;</span></li>";}
        ?>
    </ul>
</div>
    
</div>
<?php mysqli_close($conn); ?>
<?php require_once 'footer.php'; ?>
</body>
</html>