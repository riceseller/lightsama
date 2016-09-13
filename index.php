
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
<link rel="stylesheet" type="text/css" href="users/css/new_index.css" />
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
function changeContent(classActive){
        $(document).on('click',classActive,function(e) {
            
        document.getElementById('beauty').className="nav-link disabled";
        document.getElementById('skyscraper').className="nav-link disabled";
        document.getElementById('landscape').className="nav-link disabled";            
        e.preventDefault();       
    });
        
                                
        if(classActive==='#landscape')
        {
            $('.preLoadClass').load("sectionLoad.php?tabClick=landscape #landscapeSection", function(){
                collage();
                document.getElementById('beauty').className="nav-link";
                document.getElementById('skyscraper').className="nav-link";
                document.getElementById('landscape').className="nav-link active";
            });
        }
        else if(classActive==='#beauty')
        {
            $('.preLoadClass').load("sectionLoad.php?tabClick=beauty #beautySection", function(){
                collage();
                document.getElementById('beauty').className="nav-link active";
                document.getElementById('skyscraper').className="nav-link";
                document.getElementById('landscape').className="nav-link";
            });
        }
        else
        {
            $('.preLoadClass').load("sectionLoad.php?tabClick=skyscraper #skyscraperSection", function(){
                collage();
                document.getElementById('beauty').className="nav-link";
                document.getElementById('skyscraper').className="nav-link active";
                document.getElementById('landscape').className="nav-link";
            });
        }
        
}    
</script>

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

<div class="container second" style="text-align: center;">
            
              <ul class="nav nav-tabs" style="display:inline-block;">
                <li class="nav-item" style="display: inline;">
                    <a class="nav-link active" href="#" id="landscape" onclick="changeContent('#landscape');">Landscape</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="beauty" onclick="changeContent('#beauty');">Beauty</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="skyscraper" onclick="changeContent('#skyscraper');">Skyscraper</a>
                </li>
              </ul>
      
</div>

<script>
    function jumpLink(userId){
        window.location = "/indUser.php?id="+userId;
    }
</script>

<div class="preLoadClass">
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
                    echo "</a>";
                    
                    echo "<div class=\"overlay_shadow\">";
                    echo "<h2>$row[title]</h2>";
                        echo "<div class=\"info\">";                       
                        ?>
                        <div class="users" onclick="jumpLink(<?php echo $row[id]?>)" style="<?php
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
                                        ?>"></div>
                        <?php
                        echo "</div>";
                    echo "</div>";    
                    
                echo "</div>";
            echo "</div>";
        }
    } else {
        echo "0 results";
    }
    ?>
</section>
</div>
    
<?php
    include "footer.php";
?>
</body>

</html>