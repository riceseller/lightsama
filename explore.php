<?php
include("topNav2.php");
include "supplyment/dbAccess.php";
if(isset($_GET['page'])) {
    // id index exists
    $page = $_GET["page"];
}else{
    $page = 1;
}
?>
<link rel="stylesheet" type="text/css" href="users/css/explore.css" />

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
<li class="active"><a href="#">Explore All</a></li>
<li><a href="tags.php">Tags</a></li>
<li><a>Keyword</a></li>
<div class="clearFloat"></div>
</ul>
</div>

<section class="Collage effect-parent">
    <?php
        $off = $page*20-20;
        $query = "select distinct u.id, u.url, u.width, u.height from Url u join Common c on u.id=c.p_id where c.nsfw=0 and u.width is not null and u.height is not null order by c.dateR desc limit 20 offset $off";
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
        <li><?php echo "<a href=\"explore.php?page=".($page+1)."\">Next &gt;</a>";
        ?></li>
    </ul>
</div>
<?php
    mysqli_close($conn);
?>

</body>
</html>