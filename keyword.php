<?php
error_reporting(0);
include("newNavBar.php");
include "supplyment/dbAccess.php";
if(isset($_GET['page'])) {
    // id index exists
    $page = $_GET["page"];
}else{
    $page = 1;
}
if(isset($_GET['search'])) {
    // id index exists
    $keyword = $_GET["search"];
}else{
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

    <style>
    .menu{
        order: 2;
    }
    </style>

<link rel="stylesheet" type="text/css" href="users/css/new_index.css" />
<script>//if writing the previous code twice it will prevent modal from loading</script>
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

<script>
        // load remote page via jquery
        $(document).on('click','.picLoad',function(event) {
            event.preventDefault();            
            
            var modal = $('#gridSystemModal').modal();
            modal.find('.modal-content').load($(this).attr('href'), function () {
                    //$('.modal-content').css('height',$( window ).height());
                    modal.show();                   
                });
        });
</script>




<div class="container" style="margin-top: 50px; text-align: center;">
    <ul class="nav nav-tabs" style="display: inline-block">
        <li class="nav-item">
            <a class="nav-link" href="explore.php">Explore</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="tags.php">Tags</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="keyword.php">Keyword</a>
        </li>
    </ul>
</div>

<div class="container-Collage" style="padding:0;">
<section class="Collage effect-parent">
    <?php
        $off = $page*20-20;
        /*$query =  "select distinct u.id, u.url, u.width, u.height from Url u, Common c "
                . "WHERE (MATCH(c.descript) AGAINST ('".$keyword."') "
                . "or MATCH(c.title) AGAINST('".$keyword."')) "
                . "AND c.p_id=u.id "
                . "and c.nsfw=0 and u.width is not null and u.height is not null "
                . "limit 20 offset $off";*/
        $query = "SELECT DISTINCT u.id, u.url, u.width, u.height "
                . "FROM Url u JOIN Common c ON c.p_id=u.id "
                . "WHERE (MATCH(c.descript) AGAINST ('$keyword')) or (MATCH(c.title) AGAINST('$keyword')) "
                . "AND c.nsfw=0 AND u.width is not null AND u.height is not null "
                . "LIMIT 20 OFFSET $off";
        $Pageurl = "/keyword.php?search=$keyword&";
        $totalPage = pageCount($query);
        //echo $totalPage;
        $Presult=$conn->query($totalPage);
        $Prow = $Presult->fetch_assoc();
        $totalPageNum = floor($Prow['count(*)']/20)+1;
        //echo $totalPageNum;
        $result=$conn->query($query);
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<div class=\"Image_Wrapper\">";
            echo "<a style=\"text-decoration:none;\" class=\"picLoad\" href=\"/indDisplay4.php?pid=".$row[id]."&url=".$row[url]."\">";
            echo "<img src=\"".$row[url]."\" width=\"".$row[width]."\" height=\"".$row[height]."\">";
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
            else{echo "<li class=\"page-item disabled\"><span class=\"page-link\">Next &gt;</span></li>";}
        ?>
    </ul>
</div>




<?php
    include "footer.php";    
?>

<style>
.modal-dialog {
  width: 100% !important;
  height: 100%;
  margin: 0;
  padding: 0;
  max-width: inherit !important;
}
.modal-content {
  height: auto;
  min-height: 100%;
  border-radius: 0;
  background-color: #000;
  border: 0;
}
.container-fluid{
    display: inline-block;
    text-align: center;
    padding: 0;
    width: 100%;
}
.picDisplay img{
    max-height: 85vh;
    margin: 0;
    padding: 0;
    width: 900px;
    object-fit: cover;
}
#userInfoPic{
    margin-top: 15px;
}
#userInfo #userInfoPic img{
        width: 70px;
        height: 70px !important;
        /* fill the container, preserving aspect ratio, and cropping to fit */
        background-size: cover;
        /* center the image vertically and horizontally */
        background-position: center;
        display: block;
        margin-left: auto;
        margin-right: auto;
        max-width: 100%; 
        height: auto; 
        max-height: 85vh;
        object-fit: contain;      
}
#userNameD{
    word-wrap: break-word;
    margin-top: 15px;
}
#takenTime p{
    word-wrap: break-word;
}
.picViewerInfo{
    margin-top: 15px;
}
.exifFirstLine img{
    width: 98px;
    height: 97px;
    object-fit: contain;
}
.exifFirstLine #cameraType{
    margin-top: 30px;
}
.col-md-9{
    padding: 0;
}
.col-md-3{
    padding: 0;
}
.col-xs-2{
    padding: 0;
}
.col-xs-6{
   padding: 0;
}

.col-md-4{
    padding: 0;
}
.col-md-6{
    padding: 0;
}
</style>

<style>
.col-xs-9{
    padding: 0;
}
.col-xs-8{
    padding: 0;
}
.col-xs-4{
    padding: 0;
}
.col-md-8{
    padding: 0;
}
.col-md-4{
    padding: 0;
}
.col-xs-3{
    padding: 0;
}
.imgDisplay{
    
}
.imgDisplay img{
    height: 90vh;
    margin: 0;
    padding: 0;    
    width: 100%;
    object-fit: contain;
    
}
.imgSpacer{   
    min-height: 0vh !important;
}
.iconDisplay{
    background-color: #3e3e3e;
    min-height: 43px;
    border: 1px solid #222;
}
.iconsShow{
    margin: 0;
    padding: 0;
}
.iconShow a i{
    display: inline-block;
}
p.iconDisplayText{
    font-size: 15px;
    display: inline-block !important;
    margin-left: 3px;
    color: white !important;
}
.userNameAndPic{
    margin-top: 10px;
    margin-left: 10px;
}
.userPicImg{
    margin: 0;
}
.userPicImg img{
    width:  35px !important;
    height: 35px !important;
    /* fill the container, preserving aspect ratio, and cropping to fit */
    background-size: cover;
    /* center the image vertically and horizontally */
    background-position: center;
    margin-left: 0;
    margin-right: 0;
    display: inline-block;
}
.userNameDisplay{
    padding: 0;
}
.userNameDisplay p {
    font-size: 15px;
    display: inline-block;
    margin-left: 3px;
}
.userNameDisplay p a{
    color: white !important;
}
</style>


<div id="gridSystemModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
    </div>
  </div>
</div>


</body>


</html>