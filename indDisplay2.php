<?php
include "topNav2.php";
$pid = $_GET["pid"]; 
include("supplyment/dbAccess.php");
$come_from=$_REQUEST["come_from"];
if(isset($come_from))
{
    $query30="update assoCorresp set click=click+1 where ppid=$come_from and cpid=$pid";
    $conn->query($query30);
    #$query31="update assoCorresp set ranking=ranking+1 where ppid=$come_from and cpid=$pid";
    #$conn->query($query31);
}
else{
    #echo "IT IS NOT DISPLAYED BY CLICKING SIMILAR PICS";             //debug
    #echo "<br><br><br><br><br>";     //debug
}

$query = "select c.*, u.url, su.* from Common c left join Url u on c.p_id=u.id join ScrapeUser su on c.userBelong=su.id where c.p_id=$pid";
$result=$conn->query($query);
$row = mysqli_fetch_array($result);
if(isset($_GET['page'])) {
    // id index exists
    $page = $_GET["page"];
}else{
    $page = 1;
}

$query11 = "select c.longitude, c.latitude from Coordinate c join CoordinateCorrespondance cc on c.id=cc.coeid where cc.pid=$pid";
$result11=$conn->query($query11);
if($result11->num_rows>0){
    while($row11=$result11->fetch_assoc()){
        $myLat = $row11['latitude'];
        $myLng = $row11['longitude'];
    }
}
else{
    $myLat = 0;
    $myLng = 0;
}
?>
        
    <style>
        .container{
            display: -webkit-flex; /* Safari */
            display: flex;
            flex-direction: row;
            width: 100%;
            background: #212124; 
            height: calc(100vh - 50px);
            justify-content: center; /* align horizontal */
            align-items: center; /* align vertical */
        }
        #scrolla{
            align-items: center;
            flex-shrink: 0;
            width: 50px;
            height: calc(100vh - 50px);
            order: 1;
        }
        #scrollb{
            order: 2;
            height: calc(100vh - 50px);
            width: calc(100% - 100px);
        }
        #scrollc{
            flex-shrink: 0;
            width: 50px;
            height: calc(100vh - 50px);
            order: 3;
        }
        .container a{
            display: flex;
            justify-content: center; /* align horizontal */
            align-items: center; /* align vertical */
            height: calc(100vh - 50px);
        }
        #scrollb img{
            object-fit: contain;
            height: calc(100vh - 50px - 10%); /*addtional 100px margin */
            width: calc(100% - 100px); /*addtional 100px margin */
        }
</style>

<style>
        container2{
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: flex-start;
            background: #F3F5F6;
            justify-content: center;
            order: 2;
        }
        container2 #user_info{
            display: flex;
            width: auto;
            max-width: 500px;
            min-width: 200px;
            height: auto;
            flex-wrap: nowrap;
            color: #212124;
        }
        container2 #userPic{
            display: flex;
            height: auto;
            width: 62px;
            order: 1;
            margin: 0px;
            padding-right: 13px;
        }
        container2 #userPic img{
            margin-top: 15px;
            width: 52px;
            height: 52px;
            /* fill the container, preserving aspect ratio, and cropping to fit */
            background-size: cover;
            /* center the image vertically and horizontally */
            background-position: center;
            /* round the edges to a circle with border radius 1/2 container size */
            border-radius: 50%;
        }
        container2 #userInfo_content{
            display: flex;
            height: auto;
            width: auto;
            max-width: 500px;
            order: 2;
            flex-direction: column;
        }
        container2 .spacer{
            /*max-width:200px;
            min-width: 5%;
            height: 1px;*/
            width: 150px;
        }
        container2 p{
            margin: 0px;
            word-wrap: break-word;
        }
        .user_name{
            width: auto;
            height: 30px;
            text-align: left;
            font-size: 20px;
            font-weight: 600;
            margin-top: 16px;
        }
        .title{
            width: auto;
            max-height: 100px;
            text-align: left;
            font-size: 16px;
            font-weight: 600;
        }
        .descript{
            width: auto;
            height: auto;
            text-align: left;
            font-size: 14px;
            font-weight: 400;
        }
        container2 .top{
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            height: 64px;
            align-items: center;
            padding-bottom: 20px;
        }
        .top div{
            display: flex;
            margin-left: 10px;
            margin-right: 10px;
            text-align: center;
            line-height: 18px;
        }
        #view, #fav, #comment{
            font-weight: 400;
            font-size: 20px;
            color: #212124;
        }
        container2 .bot{
            display: flex;
        }
        .bot p{
            margin: 0;
        }
        .bot .exif{
            width: 225px;
            margin-right: 30px;
            align-content: center;
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            max-height: 160px;
        }
        .bot .exif_other{
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
        }
        #model{
            width:225px;
            height: 98px;
            display:flex;
            align-content: center;
            align-items: center;
            padding-bottom: 28px;
            font-size: 14px;
            font-weight:400;
        }
        .exif img{
            margin-right: 15px;
        }
        #aperture{
            height: 32px;
            width: 110px;
            display:flex;
            text-align: center;
        }
        #focal{
            height: 32px;
            width: 110px;
            display:flex;
            text-align: center;
        }
        #exposure{
            height: 32px;
            width: 110px;
            display:flex;
            text-align: center;
        }
        #iso{
            height: 32px;
            width: 110px;
            display:flex;
            text-align: center;
        }
        #actualMap{
            height: 100px;
            width: 245px;
        }
    </style>
    
    <style>
        .container3{
            justify-content: center;
            width: 100%;
            max-height: 50vh;
            display: flex;
            flex-wrap: wrap;
            background: #F3F5F6;
            position: relative;
            align-items: center;
            vertical-align: middle;
            order: 3;
        }
        .container3 a{
        display:block;
        padding:5px 10px;
        text-decoration:none;
        border-radius: 20px;
        background-color: #fff;
        color: #71767a;
        border:1px solid #b9c1c7;
        margin-top: 12px;
        }
        .container3 a:hover{
        border-color: #0099e5;
        color: #0099e5;
        }
        .spacing{
            width: 20px;
        }
    </style>
    
    <style>
        .text_prompt{
            position: relative;
            order: 4;
            width: 100%;
            text-align: left;
            align-items: center;
            justify-content: flex-start;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
        }
    </style>
       
    <style>
         body{
            background: #f3f5f6;
        }
        .Collage{
        /* define how much padding you want in between your images */
            padding:5px;
            background: #f3f5f6;
            position: relative;
            order: 5;
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
    </style>
    
    <script src="/node_modules/jquery.min.js"></script>
    <script src="/node_modules/jquery.collagePlus.js"></script>
    <script src="/node_modules/jquery.removeWhitespace.js"></script>
    <script type="text/javascript" src="http://maps.google.cn/maps/api/js?sensor=false&libraries=places"></script>
    <script>
    window.onload=function(){
        var lat = <?php echo $myLat; ?>;
        var lng = <?php echo $myLng; ?>;
        var myLatLng = {lat, lng};
        console.log(myLatLng);
        var map = new google.maps.Map(document.getElementById('actualMap'), {
          zoom: 4,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map
        });
      }
    </script>

    <script>
        $(document).ready(function(){
            collage();
        });
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
      
    <div class="container">
        <div id="scrolla">
            <a style="text-decoration: none; ">
                <img src="/media/left_arrow.png" />
            </a>
        </div>
        <div id="scrollb">
        <a  style="text-decoration: none;" href="<?php if($row['belong']=='500px')
                                                       {
                                                            $link="https://500px.com/photo/";
                                                            $link=$link . $pid;
                                                            print $link;
                                                        }
                                                        elseif($row['belong']=='Flickr')
                                                        {
                                                            $userID = $row['userID'];
                                                            print "https://www.flickr.com/photos/$userID/$pid";
                                                        }
                                                        else
                                                        {
                                                            print $row['url']; 
                                                        }?>">
            <img  class="effect" src="<?php print $row['url']?>" />
        </a>
        </div>
        <div id="scrollc">
            <a style="text-decoration: none;">
                <img src="/media/left_arrow_2.png" />
            </a>
        </div>
    </div>
    
    <div class="container3">
            <?php
                $sqlT = "select t.tagName from Tag t join TagRelation tr on t.id=tr.tagid where tr.pid=$pid";
                $result3=$conn->query($sqlT);
                while($row3=$result3->fetch_assoc())
                {
                    echo "<a href=tags.php?cat=$row3[tagName]>$row3[tagName]</a>";
                    echo "<div class='spacing'></div>";
                }
            ?>
    </div>
   
    <container2>
        <div id="user_info">
            <div id="userPic"><img style="<?php
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
            <div id="userInfo_content">
                <div class="user_name">
                    <?php
                        if($row[userBelong]<=1)
                        {
                            echo "<p> Need Scrape </p>";
                        }
                        else
                        {
                            echo "<p> ".$row[displayName]." </p>";
                            //echo "<font size=12> ".$row2[model]."</font>";
                        }
                    ?>
                </div>      
                <div class="title">
                    <?php
                        if($row[title]==None)
                        {
                            echo "<p>This picure does not have a title</p>";
                        }
                        else
                        {
                            echo "<p> ".$row[title]." </p>";
                            //echo "<font size=12> ".$row2[model]."</font>";
                        }
                    ?>
                </div>            
                <div class="descript">
                    <?php
                        if($row[descript]==None)
                        {
                            echo "<p>This picure does not have a description</p>";
                        }
                        else
                        {
                            echo "<p> ".$row[descript]." </p>";
                        }
                    ?>
                </div>   
            </div>
        </div>
         
        <div class="spacer"> </div>
        <div class="exif">
            <div class="top">
                <div id="view">
                    <p>10000<br>view</p>
                </div>
                <div id="fav">
                    <p>100<br>favorites</p>
                </div>
                <div id="comment">
                    <p>10<br>comments</p>
                </div>
                <div id="date">
                <?php
                        if($row[dateR]=='0000-00-00 00:00:00')
                        {
                            echo "<p>\"some time in the universe\"</p>";
                        }
                        else
                        {
                            echo "<p>Taken on ".$row[dateR]."</p>";
                        }
                ?>
                </div>
            </div>
            <div class="bot">
                <div class="exif">
                    <div id="model">
                        <img src="/media/camera.png" height="97px" width="98px">          
                        <?php
                            if($row[model]==None)
                            {
                                echo "<div>no camera info<br>";
                            }
                            else
                            {
                                echo "<div>".$row[model]." <br>";
                                //echo "<font size=12> ".$row2[model]."</font>";
                            }
                            if($row[lens]==None)
                            {
                                echo "no lens info</div>";
                            }
                            else
                            {
                                echo " ".$row[lens]." </div>";
                            }
                        ?>
                    </div>
                    <div class="exif_other">
                        <div id="aperture">
                            <img src="/media/aperture.png" height="22" width="22">
                            <?php
                                if($row[aperture]==None)
                                {
                                    echo "<p> f/ - </p>";
                                }
                                else
                                {
                                    echo "<p> f/".$row[aperture]." </p>";
                                    //echo "<font size=12> ".$row2[model]."</font>";
                                }
                            ?>
                        </div>
                        <div id="focal">
                            <img src="/media/focal.png" height="22" width="22">
                            <?php
                                if($row[focal]==None or $row[focal]<=0)
                                {
                                    echo "<p> - mm </p>";
                                }
                                else
                                {
                                    echo "<p> ".$row[focal]." mm </p>";
                                }
                            ?>
                        </div>
                         <div id="exposure">
                            <img src="/media/exposure.png" height="22" width="22">
                            <?php
                                if($row[exposure]==None)
                                {
                                    echo "<p> - </p>";
                                }
                                else
                                {
                                    echo "<p> ".$row[exposure]." </p>";
                                }
                            ?>
                        </div>
                        <div id="iso">
                            <img src="/media/iso.png" height="22" width="22">
                            <?php
                                if($row[iso_speed]==None or $row[iso_speed]<=0)
                                {
                                    echo "<p> - </p>";
                                }
                                else
                                {
                                    echo "<p> ".$row[iso_speed]." </p>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div id="map">
                    <div id="actualMap"></div>
                    <?php
                    $query10= "select l.county_location, l.region_location, l.country_location from Location l join LocationCorrespondance lo on l.id=lo.locid where lo.pid=$pid";
                    $result10=$conn->query($query10);
                    $row10 = mysqli_fetch_array($result10);
                    if(empty($row10))
                        {
                            echo "<p> no location info </p>";
                        }
                        else
                        {
                            echo "<p>$row10[county_location]</p>"
                                    . "<div class='text_space'></div>"
                               . "<p>$row10[region_location]</p>"
                                    . "<div class='text_space'></div>"
                               . "<p>$row10[country_location]</p>";
                        }
                    ?>
                </div>
            </div>        
        </div>
         
     </container2>
    
    
    
        <div class="text_prompt">
            <p>similar pictures</p>
        </div>
    
    
        <style>
            .inline {
            display: inline;
            }
            .link-button {
                background: none;
                border: none;
                text-decoration: none;
              
            }
        </style>    
    
        <section class="Collage effect-parent">
            <?php
                $off = $page*20-20;
                $query20 = "select distinct u.id, u.url, u.width, u.height from Url u join assoCorresp aso on u.id=aso.cpid where aso.ppid=$pid and u.width is not null and u.height is not null order by aso.ranking desc limit 20 offset $off";
                $result20=$conn->query($query20);
                if ($result20->num_rows > 0) {
                    while($row20 = $result20->fetch_assoc()) {
                        echo "<div class=\"Image_Wrapper\">";
            ?>   
                        
                        <form method="POST" action="indDisplay2.php?pid=<?php echo $row20[id]?>" class="inline">
                            <input type="hidden" name="come_from" value=<?php echo $pid?>/>
                            <button type="submit" name="come_from" value=<?php echo $pid?> class="link-button">
                                <img src="<?php echo "$row20[url]" ?>" width="<?php echo "$row20[width]"?>" height="<?php echo "$row20[height]"?>">
                            </button>
                        </form>

            
            <?php        
                        echo "</div>";    
                    }
                } 
                else {
                    echo "0 results";
                }
            ?>
        </section>
    </body>
</html>