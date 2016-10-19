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
if(isset($_GET['cat'])) {
    // id index exists
    $tag = $_GET["cat"];
}else{
    $tag = 'none';
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

<customHeader>
    <style>
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
    /* custum bs tag style*/
    .tag-info{
        background:#ffffff;
    }
    .tag-info a:hover{
        border-color: #0099e5;
        color: #0099e5;
        /* ensures padding at the bottom of the image is correct */
        vertical-align:bottom;
        /* hide the images until the plugin has run. the plugin will reveal the images*/
        opacity: 1;
    }
    .tag{
        font-size: 100%;
        font-weight: 400;
    }
    <?php
        $off = $page*40-40;
        if ($tag!='none'){
            if($tag=='nsfw'){
            // request ni dong de category
            $query = "select distinct u.id, u.url, u.width, u.height from Url u, Common c "
                    . "where c.nsfw=1 AND c.p_id=u.id and c.dateR<now() "
                    . "and u.width is not null and u.height is not null "
                    . "order by c.dateR desc limit 40 offset $off";
            echo    'body{background: #000000;}'
                    . '.Collage{background: #000000;}'
                    . '.menu {border-bottom: 1px solid #000000;}'
                    . '.menu ul{background: linear-gradient(#c60712, #a1041d);}'
                    . '.menu a:hover, .menu li.active a{color:#000000;border-bottom: 2px solid #be0e16;}'
                    . 'div.pagination-cont {background: linear-gradient(#c60712, #a1041d);}'
                    . 'ul.pagination li a {color:#ffffff;}';
            }else{
            // request user desired tag category
            $query = "select distinct u.id, u.url, u.width, u.height from Url u join "
                    . "(select p_id from Common join "
                    . "(select pid from Tag t join TagRelation tr on t.id=tr.tagid where tagName like '%".tag."%') as tf "
                    . "on p_id=tf.pid where dateR<now() and nsfw=0 limit 40 offset $off) as c on u.id=c.p_id";
            $pageQ = "select count(*) from Common join "
                    . "(select pid from Tag t join TagRelation tr on t.id=tr.tagid where tagName like '%".tag."%') as tf "
                    . "on p_id=tf.pid where dateR<now() and nsfw=0";
            }
            $Pageurl = "/tags.php?cat=$tag&";
        }else{
        // no desire tag
        $query = "select distinct u.id, u.url, u.width, u.height from Url u join "
                . "(select p_id from Common where nsfw=0 and dateR<now() order by dateR desc limit 40 offset $off) as c "
                . "on u.id=c.p_id where u.width is not null and u.height is not null";
        $pageQ = "select count(*) from Common where nsfw=0 and dateR<now()";
        $Pageurl = "/tags.php?";
        }
        $Presult=$conn->query($pageQ);
        $Prow = $Presult->fetch_assoc();
        $totalPageNum = floor($Prow['count(*)']/40)+1;
        $result=$conn->query($query);
    ?>
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
    <script>
        // load remote page via jquery
        $(document).on('click','#finallyFindBugs',function(event) {
            event.preventDefault();            
            
            var modal = $('#gridSystemModal').modal();
            modal.find('.modal-content').load($(this).attr('href'), function () {
                    //$('.4-content').css('height',$( window ).height());
                    modal.show();                   
                });
        });
    </script>
</customHeader>

<div class="container" style="padding-top:8px;padding-bottom:8px; margin-top: 50px;">
    <ul class="nav nav-tabs">
      <li class="nav-item">
          <a class="nav-link" href="../explore.php">Explore All</a>
      </li>
      <li class="nav-item">
          <a class="nav-link active">Tags</a>
      </li>
      <li class="nav-item">
          <a class="nav-link">Keyword</a>
      </li>
    </ul>                    
</div>

<div class="container" style="padding-bottom:8px;">
<?php 
    $popTag = "select tagName from Tag join "
        . "(select tagid, count(*) as count "
        . "from TagRelation group by tagid order by count desc limit 10)"
        . " as popTag on Tag.id=popTag.tagid limit 10";
    $arrayTag=$conn->query($popTag);
    while($showTag = $arrayTag->fetch_assoc()) {
        echo "<span style=\"margin-right:5px;\" class=\"tag tag-pill tag-info\">"
                . "<a href=tags.php?cat=$showTag[tagName]>$showTag[tagName]</a>"
                . "</span>";
    }
?>
</div>

<div class="container-Collage" style="padding:0;">
<section class="Collage effect-parent">
    <?php
        //echo $query;
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<div class=\"Image_Wrapper\">";
            echo "<a id=\"finallyFindBugs\" style=\"text-decoration:none;\" href=\"/indDisplay4.php?pid=".$row[id]."&url=".$row[url]."\">";
            echo "<img src=\"".$row[url]."\" width=\"".$row[width]."\" height=\"".$row[height]."\">";
            echo "</a>";
            echo "</div>";
        }
    } else {
        echo "<center><font color=\"#ffffff\" size=\"5\">no more result</font></center>";
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
<?php require_once 'footer.php'; ?>

<div id="gridSystemModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modalDialogID">
    <div class="modal-content" id="modalContentID">
      
    </div>
  </div>
</div>