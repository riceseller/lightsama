<!DOCTYPE html>
<html>

<?php 
    error_reporting(0);
    
    include("topNavBackUp.php");
    include "supplyment/dbAccess.php";
    if(isset($_GET['page'])) {
    // id index exists
    $page = $_GET["page"];
    }else{
        $page = 1;
    }
?>
<link rel="stylesheet" type="text/css" href="users/css/new_index.css" />

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

<script>
    function ChangeContent(iden){
        if(iden==='nature'){
           document.getElementById('nature').style.display="block";
           document.getElementById('linature').className="active";
           
           document.getElementById('culture').style.display="none";
           document.getElementById('liculture').className="";
           
           document.getElementById('bodyart').style.display="none";
           document.getElementById('liart').className="";
        }
        else if(iden==='bodyart'){
           document.getElementById('nature').style.display="none";
           document.getElementById('linature').className="";
           
           document.getElementById('culture').style.display="none";
           document.getElementById('liculture').className="";
           
           document.getElementById('bodyart').style.display="block";
           document.getElementById('liart').className="active";
        }
        else if(iden==='culture'){
           document.getElementById('nature').style.display="none";
           document.getElementById('linature').className="";
           
           document.getElementById('culture').style.display="block";
           document.getElementById('liculture').className="active";
           
           document.getElementById('bodyart').style.display="none";
           document.getElementById('liart').className="";
        }
    }
</script>
<title>PHOTOLIB</title>

<body>
    
<welcome>
    <h1>Link Your Flickr To The Outside World</h1> 
    <a href="<?=$us_url_root?>users/new_login.php?category=login">get started</a>
</welcome>

<introduction>
    <h2>an indexing of high quality images</h2>
    <p>All images are scrapped from Flickr, 500px and Pixabay. You may connect your Flickr account
    to exchange resources with other sites. We make it faster</p>
</introduction>

<div class="menu">
<ul>
<li class="active" id="linature"><a onclick="ChangeContent('nature')">Landscape</a></li>
<li id="liart"><a onclick="ChangeContent('bodyart')">Beauty</a></li>
<li id="liculture"><a onclick="ChangeContent('culture')">Skyscraper</a></li>
<div class="clearFloat"></div>
</ul>
</div>

<section class="Collage effect-parent" id="nature">
    <?php
        $query = "select distinct c.title, su.*, u.id as uid, u.url, u.width, u.height from Url u, Common c, ScrapeUser su, TagRelation tr where c.p_id!=160630813 and tr.pid=c.p_id and tr.tagid=1046 and u.id=c.p_id and c.nsfw=0 and c.userBelong=su.id and u.width is not null and u.height is not null and c.title is not null and c.title!='None' and c.title!='?' order by c.dateR desc limit 20";
        $result=$conn->query($query);
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<div class=\"Image_Wrapper\" style=\"width=\"".$row[width]."\" height=\"".$row[height]."\"\">";
                echo "<div class=\"hovereffect\">";
                    echo "<a style=\"text-decoration:none;\" href=\"#\">";
                        echo "<img src=\"".$row[url]."\" width=\"".$row[width]."\" height=\"".$row[height]."\">";                      
                    echo "</a>";
                    echo "<div class=\"overlay\">";
                        echo "<h2>$row[title]</h2>";
                        echo "<a class=\"info\" href=\"/indDisplay2.php?pid=".$row[uid]."\">";                       
                        ?>
                        <img class="users" style="<?php
                                            if($row[Ubelong]=='flickr')
                                            {
                                                $server = $row[extraOne];
                                                $farm = $row[extraTwo];
                                                $userr = $row[userID];
                                                print "background-image:url(https://c2.staticflickr.com/$farm/$server/buddyicons/".$userr.".jpg)";
                                            }
                                            elseif($row[Ubelong]=='500px')
                                            {
                                                print "background-image:url($row[extraTwo])";
                                            }
                                            else
                                            {
                                                print "background-image:url(/media/aperture.png)"; 
                                            }
                                        ?>">
                        <?php
                        echo "</a>";
                    echo "</div>";  
                echo "</div>";
            echo "</div>";
        }
    } else {
        echo "0 results";
    }
    ?>
</section>

<section class="Collage effect-parent" id="culture">
    <?php
        $query = "select distinct c.title, su.*, u.id as uid, u.url, u.width, u.height from Url u, Common c, ScrapeUser su, TagRelation tr where tr.pid=c.p_id and tr.tagid=6241 and u.id=c.p_id and c.nsfw=0 and c.userBelong=su.id and u.width is not null and u.height is not null and c.title is not null and c.title!='None' and c.title!='?' order by c.dateR desc limit 20";
        $result=$conn->query($query);
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<div class=\"Image_Wrapper\" style=\"width=\"".$row[width]."\" height=\"".$row[height]."\"\">";
                echo "<div class=\"hovereffect\">";
                    echo "<a style=\"text-decoration:none;\" href=\"#\">";
                        echo "<img src=\"".$row[url]."\" width=\"".$row[width]."\" height=\"".$row[height]."\">";                      
                    echo "</a>";
                    echo "<div class=\"overlay\">";
                        echo "<h2>$row[title]</h2>";
                        echo "<a class=\"info\" href=\"/indDisplay2.php?pid=".$row[uid]."\">";                       
                        ?>
                        <img class="users" style="<?php
                                            if($row[Ubelong]=='flickr')
                                            {
                                                $server = $row[extraOne];
                                                $farm = $row[extraTwo];
                                                $userr = $row[userID];
                                                print "background-image:url(https://c2.staticflickr.com/$farm/$server/buddyicons/".$userr.".jpg)";
                                            }
                                            elseif($row[Ubelong]=='500px')
                                            {
                                                print "background-image:url($row[extraTwo])";
                                            }
                                            else
                                            {
                                                print "background-image:url(/media/aperture.png)"; 
                                            }
                                        ?>">
                        <?php
                        echo "</a>";
                    echo "</div>";  
                echo "</div>";
            echo "</div>";
        }
    } else {
        echo "0 results";
    }
    ?>
</section>

<section class="Collage effect-parent" id="bodyart">
    <?php
        $query = "select distinct c.title, su.*, u.id as uid, u.url, u.width, u.height from Url u, Common c, ScrapeUser su, TagRelation tr where tr.pid=c.p_id and tr.tagid=12048 and u.id=c.p_id and c.p_id!=4181 and c.nsfw=0 and c.userBelong=su.id and u.width is not null and u.height is not null and c.title is not null and c.title!='None' and c.title!='?' order by c.dateR desc limit 20";
        $result=$conn->query($query);
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<div class=\"Image_Wrapper\" style=\"width=\"".$row[width]."\" height=\"".$row[height]."\"\">";
                echo "<div class=\"hovereffect\">";
                    echo "<a style=\"text-decoration:none;\" href=\"#\">";
                        echo "<img src=\"".$row[url]."\" width=\"".$row[width]."\" height=\"".$row[height]."\">";                      
                    echo "</a>";
                    echo "<div class=\"overlay\">";
                        echo "<h2>$row[title]</h2>";
                        echo "<a class=\"info\" href=\"/indDisplay2.php?pid=".$row[uid]."\">";                       
                        ?>
                        <img class="users" style="<?php
                                            if($row[Ubelong]=='flickr')
                                            {
                                                $server = $row[extraOne];
                                                $farm = $row[extraTwo];
                                                $userr = $row[userID];
                                                print "background-image:url(https://c2.staticflickr.com/$farm/$server/buddyicons/".$userr.".jpg)";
                                            }
                                            elseif($row[Ubelong]=='500px')
                                            {
                                                print "background-image:url($row[extraTwo])";
                                            }
                                            else
                                            {
                                                print "background-image:url(/media/aperture.png)"; 
                                            }
                                        ?>">
                        <?php
                        echo "</a>";
                    echo "</div>";  
                echo "</div>";
            echo "</div>";
        }
    } else {
        echo "0 results";
    }
    ?>
</section>

<?php
    require_once "footer.php";
?>
</body>

</html>