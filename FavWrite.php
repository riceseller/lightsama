<?php

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
        include "supplyment/dbAccess.php";
        // AJAX request
        $current_id = $_GET['current_id']; 
        $current_pid=$_GET['current_pid'];
        $current_cat=$_GET['current_cat'];
        $current_comment=$_GET['current_comment'];
        $current_cid=$_GET['current_cid'];
        $current_request=$_GET['current_request'];
        
        echo $current_comment;
        
       
        if($current_cat=='check_like')
        {
            $query60="insert into fav(userid, favpic) values($current_id, $current_pid)";
            $conn->query($query60); 
        }
        else if($current_cat=='uncheck_like')
        {
            $query90="delete from fav where userid=$current_id and favpic=$current_pid";
            $conn->query($query90);
        }
        else if($current_cat=='comment_write')
        {
            $query100="insert into comment(userid, compic, content, comdate) values($current_id, $current_pid, '$current_comment', NOW())";
            $conn->query($query100);
        }
        else if($current_cat=='comment_delete')
        {
            $query101="delete from comment where id=$current_cid";
            $conn->query($query101);
        }
        else if($current_request=='problem')
        {
            $content="<div id=\"abc\">
                        <div id=\"popupContact\">
                            <form action=\"<?=$us_url_root?>emailresponse.php?purpose=bug\" id=\"form\" method=\"post\" name=\"form\">
                                <img id=\"close\" src=\"../media/close.png\" onclick =\"div_hide()\">
                                <h2>Report Problem</h2>
                                <input id=\"name\" name=\"name\" placeholder=\"Name\" type=\"text\">
                                <input id=\"email\" name=\"email\" placeholder=\"Email\" type=\"text\">
                                <textarea id=\"msg\" name=\"message\" placeholder=\"Describe Your Problem\"></textarea>
                                <a href=\"javascript:%20check_empty()\" id=\"submit\">Send</a>
                            </form>
                        </div>
                    </div>";
            echo $content;
            
        }
        else if($current_request=='term')
        {
            $content="<div id=\"abc2\">
                        <div id=\"popupContact\">
                            <div id=\"term\">
                                <img id=\"close\" src=\"../media/close.png\" onclick =\"div_hide2()\">
                                <h2>Term & Privacy</h2>
                                <textarea>legal rights preserved</textarea>
                            </div>
                        </div>
                    </div>";
            echo $content;
        }
        else if($current_request=='contact')
        {
            $content="<div id=\"abc3\">   
                        <div id=\"popupContact\">   
                            <form action=\"<?=$us_url_root?>emailresponse.php?purpose=contact\" id=\"form2\" method=\"post\" name=\"form2\">
                                <img id=\"close\" src=\"../media/close.png\" onclick = \"div_hide3()\">
                                <h2>Contact Us</h2>                              
                                <input id=\"name2\" name=\"name\" placeholder=\"Name\" type=\"text\">
                                <input id=\"email2\" name=\"email\" placeholder=\"Email\" type=\"text\">
                                <textarea id=\"msg2\" name=\"message\" placeholder=\"leave your feedback\"></textarea>
                                <a href=\"javascript:%20check_empty2()\" id=\"submit\">Send</a>
                            </form>
                        </div>
                    </div>";
            echo $content;
        }
        else if($current_request=='beauty')
        {            
            $content1="<section class=\"Collage effect-parent\" id=\"beauty\">";
            echo $content1;
            
            $query = "select distinct c.title, su.*, u.id as uid, u.url, u.width, u.height from Url u, Common c, ScrapeUser su, TagRelation tr where tr.pid=c.p_id and tr.tagid=12048 and u.id=c.p_id and c.p_id!=4181 and c.nsfw=0 and c.userBelong=su.id and u.width is not null and u.height is not null and c.title is not null and c.title!='None' and c.title!='?' order by c.dateR desc limit 20";
            $result=$conn->query($query);
            if($result->num_rows > 0) {
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
";<?php
            echo $content;
        }
                                                       
}

?>