<?php 
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

<body>
    
<welcome>
    <h1>Link Your Flickr To the Outside World</h1> 
    <a href="<?=$us_url_root?>users/new_login.php?category=login">get started</a>
</welcome>

<introduction>
    <h2>an indexing of high quality images</h2>
    <p>All images are scrapped from Flickr, 500px and Pixabay. You may connect your Flickr account
    to exchange resources with other sites. We make it faster</p>
</introduction>

<section class="Collage effect-parent">
    <?php
        $off = $page*20-20;
        $query = "select distinct c.title, c.belong, su.*, u.id as uid, u.url, u.width, u.height from Url u , Common c, ScrapeUser su where u.id=c.p_id and c.nsfw=0 and c.userBelong=su.id and u.width is not null and u.height is not null and c.title is not null and c.title!='None' and c.title!='?' order by c.dateR desc limit 20 offset $off";
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
        <li><?php echo "<a href=\"index.php?page=".($page+1)."\">Next &gt;</a>";
        ?></li>
    </ul>
</div>




       
<?php
    require_once "footer.php";
?>
</body>

</html>