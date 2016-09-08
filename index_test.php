<!DOCTYPE html>
<html lang="en">
    
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
?>
    
<script src="/node_modules/jquery.min.js"></script>
<script src="/node_modules/jquery.collagePlus.js"></script>
<script src="/node_modules/jquery.removeWhitespace.js"></script>


    <style>
        .jumbotron{
            background-image: url("https://s1.tuchong.com/welcome-image/small/27091117.jpg"); 
            background-size: cover;
            height: calc(80vh);
            order: 1;
        }
        .jumbotron h1{
            text-align: center;
            -webkit-margin-start: 0px;
            -webkit-margin-end: 0px;
            -webkit-margin-before: 1.83em;
            -webkit-margin-after: 0.83em;
            color: white !important;
            font-size: 45px !important;
            margin-top: 23vh;
            text-align: center;
        }
        .jumbotron p{
            text-align: center;
        }
        .container .first{
            order: 2;          
        }
        .container h2{
            text-align:center;
            color: #515457;
            font-size: 30px;
            margin-top: 5vh;
            order: 1;
        }
        .container p{
            text-align:center;
            color: #515457;
            font-size: 20px;
            order: 2;
            margin-top: 3vh;
        }
        .container .second{
            order: 3;            
        }
        .shield{
           display:flex;
           justify-content: center;
        }
        .shield .btn{
            margin:2px;
        }       
        .wrapper{
            background-color: black;
        }
        .container .fifth{
            order:5;
        }
        .wrapper h3{
            display: inline-block;
            color: white;
            font-size: 30px;
            margin-top: 3vh;
        }
        .wrapper p{
            display: inline-block;
            color: white;
            font-size: 25px;
            margin-top: 3vh;
            margin-left: 5vh;
        }
        .container .third{
            order: 4;
        }
        .Collage {
    /* define how much padding you want in between your images */
        padding:5px;
        background: #f3f5f6;
        order: 4;        
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
    .Image_Wrapper .hovereffect{
        width:100%;
        height:100%;
        float:right;
        overflow:hidden;
        position:relative;
        text-align:center;
        cursor:default;
    }
    .Image_Wrapper .hovereffect .overlay{
        width:100%;
        height:100%;
        position:absolute;
        overflow:hidden;
        top:0;
        left:0;
        opacity:0;
        background-color:rgba(0,0,0,0.5);
        -webkit-transition:all .4s ease-in-out;
        transition:all .4s ease-in-out
    }
    .Image_Wrapper .hovereffecrt img {
        display:block;
        position:relative;
        -webkit-transition:all .4s linear;
        transition:all .4s linear;
    }
    .Image_Wrapper .hovereffect h2 {
        color:#fff;
        text-align:center;
        position:relative;
        font-size:17px;
        background:rgba(0,0,0,0);
        -webkit-transform:translatey(-100px);
        -ms-transform:translatey(-100px);
        transform:translatey(-100px);
        -webkit-transition:all .2s ease-in-out;
        transition:all .2s ease-in-out;
        padding:10px;
    }
     .Image_Wrapper .hovereffect a.info {
        text-decoration:none;
        display:inline-block;
        text-transform:uppercase;
        color:#fff;
        border-radius: 50%;
        width: 55px;
        height: 55px;
        background-color:transparent;
        opacity:0;
        filter:alpha(opacity=0);
        -webkit-transition:all .2s ease-in-out;
        transition:all .2s ease-in-out;
        margin:20px 0 0;
        padding:10px;
        text-align: center;
        vertical-align: middle;
        position: relative;
    }

    .Image_Wrapper .hovereffect a.info img.users {
        width: 55px !important;
        height: 55px !important;
        background-size: cover;
        border-radius: 50%; 
    }

    .Image_Wrapper .hovereffect a.info:hover {
        box-shadow:0 0 5px #fff;
    }

    .Image_Wrapper .hovereffect:hover .overlay {
        opacity:1;
        filter:alpha(opacity=100);
    }
    .Image_Wrapper .hovereffect:hover h2,.hovereffect:hover a.info {
        opacity:1;
        filter:alpha(opacity=100);
        -ms-transform:translatey(0);
        -webkit-transform:translatey(0);
        transform:translatey(0);
    }
    .Image_Wrapper .hovereffect:hover a.info {
        -webkit-transition-delay:.2s;
        transition-delay:.2s;
    }
    </style>
    <title>PHOTOLIB</title>
    
    
    
    
    
    <div class="jumbotron">
        <h1>Link Your Flickr To The Outside World</h1>
        <p><a class="btn btn-primary btn-lg" href="<?=$us_url_root?>users/new_login.php?category=signup" role="button">Get Started</a></p>
    </div>
    
    <div class="container first">
        <h2>an indexing of high quality images</h2>
        <p>All images are scrapped from Flickr, 500px and Pixabay. You may connect your Flickr account
            to exchange resources with other sites. We make it faster<br><br><br></p>
    </div>
    
    <div class="container second">
        <div class="shield">
            <button type="button" class="btn btn-outline-primary">Landscape</button>
            <button type="button" class="btn btn-outline-secondary">Beauty</button>
            <button type="button" class="btn btn-outline-success">Skyscraper</button>
            <br><br>      
        </div>
    </div>
    
    <div class="container third">
        <div class="Collage effect-parent" id="nature">
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
</div>
    </div>
    
    
    <?php 
        include "footer.php";
    ?>
        
</div>   
    
</body>

</html>