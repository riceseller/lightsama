<?php
include("topNav2.php");
include "supplyment/dbAccess.php";
if(isset($_GET['page'])) {
    // id index exists
    $page = $_GET["page"];
}else{
    $page = 1;
}
if(isset($_GET['id'])) {
    // id index exists
    $displayID = $_GET["id"];
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

<header>
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
</header>

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

<div class="menu">
<ul>
<li><a href="explore.php">Explore All</a></li>
<li><a href="tags.php">Tags</a></li>
<li  class="active"><a>Keyword</a></li>
<div class="clearFloat"></div>
</ul>
</div>

<section class="Collage effect-parent">
    <?php
        $off = $page*50-50;
        $query =  "select distinct u.id, u.url, u.width, u.height from Url u join Common c on u.id=c.p_id where u.width is not null and u.height is not null and c.userBelong=$displayID order by c.dateR desc limit 50 offset $off";
        $Pageurl = "/indUser.php?id=$displayID&";
        $totalPage = pageCount($query);
        //echo $totalPage;
        $Presult=$conn->query($totalPage);
        $Prow = $Presult->fetch_assoc();
        $totalPageNum = floor($Prow['count(*)']/50)+1;
        //echo $totalPageNum;
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
<?php
    mysqli_close($conn);
?>

</body>
</html>