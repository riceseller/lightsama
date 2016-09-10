
<?php require_once "supplyment/dbAccess.php";?>

<?php $request_get=$_GET["tabClick"];?>



<?php if($request_get=='landscape'):?>
<section class="Collage effect-parent" id="landscapeSection">
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
                    echo "<a class=\"overlay\" href=\"/indDisplay2.php?pid=".$row[uid]."\">";
                        echo "<h2>$row[title]</h2>";
                        //echo "<div class=\"info\" href=\"/indDisplay2.php?pid=".$row[uid]."\">";                       
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
                                        ?>"/>
                        <?php
                        //echo "</div>";
                    echo "</a>";                    
                echo "</div>";
            echo "</div>";
        }
    } else {
        echo "0 results";
    }
    ?>
</section>

<?php elseif($request_get=='skyscraper'): ?>
<section class="Collage effect-parent" id="skyscraperSection">
    <?php
        $query = "select distinct c.title, su.*, u.id as uid, u.url, u.width, u.height from Url u, Common c, ScrapeUser su, TagRelation tr where c.p_id!=160630813 and tr.pid=c.p_id and tr.tagid=6241 and u.id=c.p_id and c.nsfw=0 and c.userBelong=su.id and u.width is not null and u.height is not null and c.title is not null and c.title!='None' and c.title!='?' order by c.dateR desc limit 20";
        $result=$conn->query($query);
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<div class=\"Image_Wrapper\" style=\"width=\"".$row[width]."\" height=\"".$row[height]."\"\">";        
                echo "<div class=\"hovereffect\">";
                    echo "<a style=\"text-decoration:none;\" href=\"#\">";
                        echo "<img src=\"".$row[url]."\" width=\"".$row[width]."\" height=\"".$row[height]."\">";                      
                    echo "</a>";                   
                    echo "<a class=\"overlay\" href=\"/indDisplay2.php?pid=".$row[uid]."\">";
                        echo "<h2>$row[title]</h2>";
                        //echo "<div class=\"info\" href=\"/indDisplay2.php?pid=".$row[uid]."\">";                       
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
                                        ?>"/>
                        <?php
                        echo "</div>";
                    echo "</a>";                    
                echo "</div>";
            echo "</div>";
        }
    } else {
        echo "0 results";
    }
    ?>
</section>

<?php elseif($request_get=='beauty'): ?>
<section class="Collage effect-parent" id="beautySection">
    <?php
        $query = "select distinct c.title, su.*, u.id as uid, u.url, u.width, u.height from Url u, Common c, ScrapeUser su, TagRelation tr where c.p_id!=160630813 and tr.pid=c.p_id and tr.tagid=12048 and u.id=c.p_id and c.nsfw=0 and c.userBelong=su.id and u.width is not null and u.height is not null and c.title is not null and c.title!='None' and c.title!='?' order by c.dateR desc limit 20";
        $result=$conn->query($query);
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<div class=\"Image_Wrapper\" style=\"width=\"".$row[width]."\" height=\"".$row[height]."\"\">";        
                echo "<div class=\"hovereffect\">";
                    echo "<a style=\"text-decoration:none;\" href=\"#\">";
                        echo "<img src=\"".$row[url]."\" width=\"".$row[width]."\" height=\"".$row[height]."\">";                      
                    echo "</a>";                   
                    echo "<a class=\"overlay\" href=\"/indDisplay2.php?pid=".$row[uid]."\">";
                        echo "<h2>$row[title]</h2>";
                        echo "<div class=\"info\" href=\"/indDisplay2.php?pid=".$row[uid]."\">";                       
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
                                        ?>"/>
                        <?php
                        echo "</div>";
                    echo "</a>";                    
                echo "</div>";
            echo "</div>";
        }
    } else {
        echo "0 results";
    }
    ?>
</section>

<?php endif; ?>