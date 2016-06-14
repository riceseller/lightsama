<?php
include "topNav2.php";
$pid = $_GET["pid"];  
include("supplyment/dbAccess.php");
$query = "select c.*, u.url from Common c left join Url u on c.p_id=u.id where c.p_id=$pid";
$result=$conn->query($query);
$row = mysqli_fetch_array($result);
if(isset($_GET['page'])) {
    // id index exists
    $page = $_GET["page"];
}else{
    $page = 1;
}
?>
    
    
    <style>
        .container{
            justify-content:center;
            width: 100%;
            align-items: center;
            background: #212124; 
            display: flex;
            height: 95vh;
            position: relative;
            vertical-align: middle;
            order: 1;
        }
        .effect{
            object-fit: contain;
            position: relative;
            width: 85%;
            height: 80vh;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .scroll{
            display: flex;
            align-items: center;
            flex-shrink: 0;
            width: 50px;
            height: 50px;
            text-align: center;
            justify-content: center;
            position: absolute;
            left: 0px;
            top: 45%;
        }
        .scroll2{
            display: flex;
            flex-shrink: 0;
            width: 50px;
            height: 50px;
            align-items: center;
            text-align: center;
            justify-content: center;
            position: absolute;
            right: 0px;
            top: 47.86%;
        }
        .scroll_effect{
            object-fit: contain;
        }
        
    </style>
       
    <style>
        container2{
            justify-content: flex-start;
            width: 100%;
            max-height: 300vh;
            min-height: 35vh;
            align-items: flex-start;
            display: flex;
            position: relative;
            flex-direction: row;
            flex-wrap: wrap;
            order: 2;
            flex-grow: 2;
            background: #F3F5F6;
            border: 0;
            margin: 0;
            padding: 0;
        }
        .user_info{
            display: flex;
            justify-content: flex-start;
            width: 65%;
            max-height: 60vh;
            align-items: flex-start;
            flex-wrap: wrap;
            position: relative;
            border: 0;
            margin: 0;
            padding: 0;
        }
        .user_name{
            display: flex;
            width: 20%;
            height: 13.5vh;
            text-align: left;
            justify-content: flex-start;
            position: relative;
            border: 0;
            margin: 0;
            padding: 0;
        }
        .title{
            display: flex;
            justify-content: flex-start;
            width: 80%;
            max-height: 13.5vh;
            text-align: left;
            position: relative;
            border: 0;
            margin: 0;
            padding: 0;
        }
        .descript{
            display: flex;
            justify-content: flex-start;
            width: 100%;
            max-height: 20vh;
            min-height: 10vh;
            text-align: left;
            position: relative;
            overflow: hidden;
            border: 0;
            margin: 0;
            padding: 0;
        }
        .location{
            display: flex;
            justify-content: flex-start;
            width: 70%;
            height: 6vh;
            text-align: left;
            position: relative;
            overflow: hidden;
            align-items: flex-end;
            border: 0;
            margin: 0;
            padding: 0;
        }
        #location_text{
            display: flex;
            justify-content: flex-start;
            height: 40px;
            text-align: left;
            align-items:center;
            border: 0;
            margin: 0;
            padding: 0;
        }
        .text_space{
            display: flex;
            width: 10px;
            border: 0;
            margin: 0;
            padding: 0;
        }
        .exif_info{
            justify-content: flex-start;
            text-align: center;
            align-items: flex-start;
            width: 30%;
            max-height: 60vh;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            position: relative;
            background: #F3F5F6;
            border: 0;
            margin: 0;
            padding: 0;
        }   
        .exif_lens{
            justify-content: flex-start;
            align-items: center;
            width: 50%;
            height: 13vh;
            display: flex;
            flex-direction: column;
            position: relative;
            border: 0;
            margin: 0;
            padding: 0;
        }
        .exif_camera{
            width: 45%;
            height: 13vh;
            display: flex;
            flex-direction: row;
            position: relative;
            border: 0;
            margin: 0;
            padding: 0;
        }
        .camera_lens_pic{
            display:flex;
            width: 50%;
            height: 13vh;
            flex-grow: 1;
            position: absolute;
            top: 0;
            left: 0;
            float:left;
            object-fit: contain;
            border: 0;
            margin: 0;
            padding: 0;
        }
        .camera_text{
            width: 30%;
            height: 13vh;
            position: absolute;
            top: 0;
            right: 0;
            text-align:left;
            border: 0;
            margin: 0;
            padding: 0;
        }
        .exif_apert{
            width: 50%;
            height: 5.666vh;
            display: flex;
            position: relative;
            border: 0;
            margin: 0;
            padding: 0;
        }
        .afes{
            display:flex;
            width: 50%;
            height: 5.666vh;
            flex-grow: 1;
            position: absolute;
            top: 0;
            left: 0;
            float:left;
            object-fit: contain;
            border: 0;
            margin: 0;
            padding: 0;
        }
        .afes_text{
            width: 50%;
            height: 5.666vh;
            position:absolute;
            top: 0px;
            right: 0px;
            text-align: left;
            border: 0;
            margin: 0;
            padding: 0;
        }
        .exif_focal{
            width: 50%;
            height: 5.666vh;
            display: flex;
            position: relative;
            border: 0;
            margin: 0;
            padding: 0;
        }
        .exif_exposure{
            width: 50%;
            height: 5.666vh;
            display: flex;
            position: relative;
            border: 0;
            margin: 0;
            padding: 0;
        }
        .exif_speed{
            width: 50%;
            height: 5.666vh;
            display: flex;
            position: relative;
            border: 0;
            margin: 0;
            padding: 0;
        }
        .exif_date{
            width: 100%;
            height: 5.666vh;
            display: flex;
            justify-content: center;
            text-align: center;
            align-items: center;
            position: relative;
            border: 0;
            margin: 0;
            padding: 0;
        } 
    </style>
    
    <style>
        .container3{
            justify-content: flex-start;
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
        .tagRound{
            display: flex;
            justify-content: center;
            border-radius: 7px;
            padding: 5px;
            background: #CFD6D9;
            max-width: 200px;
            height: 5vh;
            text-align: center;
            align-items: center;
            overflow: hidden;
            position: relative;  
        }
        .spacing{
            width: 20px;
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
            font-size: 110%;
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
    </style>
    
    <script src="/node_modules/jquery.min.js"></script>
    <script src="/node_modules/jquery.collagePlus.js"></script>
    <script src="/node_modules/jquery.removeWhitespace.js"></script>

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
        <div class="scroll">
            <a style="text-decoration: none; ">
                <img class="scroll_effect" src="left_arrow.png" />
            </a>
        </div>
        <a  style="text-decoration: none;" href="<?php if($row['belong']=='500px')
                                                       {
                                                            $link="https://500px.com/photo/";
                                                            $link=$link . $pid;
                                                            print $link;
                                                        }
                                                        else
                                                        {
                                                            print $row['url']; 
                                                        }?>">
            <img  class="effect" src="<?php print $row['url']?>" 
                />
        </a>
        <div class="scroll2">
            <a style="text-decoration: none;">
                <img class="scroll_effect" src="left_arrow_2.png" />
            </a>
        </div>
    </div>
    
   
     <container2>
         <div class="user_info">
            
            <div class="user_name">
                <p>user name</p>
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
            
            <div class="location">
                <?php
                    $query10= "select l.county_location, l.region_location, l.country_location from Location l join LocationCorrespondance lo on l.id=lo.locid where lo.pid=$pid";
                    $result10=$conn->query($query10);
                    $row10 = mysqli_fetch_array($result10);
                    if(empty($row10))
                    {
                        echo "<p>no location info found</p>";
                    }
                    else
                    {
                        echo "<p id='location_text'>$row10[county_location]</p>"
                                . "<div class='text_space'></div>"
                           . "<p id='location_text'>$row10[region_location]</p>"
                                . "<div class='text_space'></div>"
                           . "<p id='location_text'>$row10[country_location]</p>";
                        
                    }
                ?>
            </div>
            
        </div>
         
        <div class="exif_info">
            <div class="exif_lens">
                <img class="camera_lens_pic" src="aperture.png" />
                <div class="camera_text">              
                    <?php
                        if($row[lens]==None)
                        {
                            echo "<p>no lens</p>";
                        }
                        else
                        {
                            echo "<p>".$row[lens]." </p>";
                            //echo "<font size=12> ".$row2[model]."</font>";
                        }
                    ?>
                </div>
            </div>
            
            <div class="exif_camera">
                
                <img class="camera_lens_pic" src="camera.png" />
                <div class="camera_text">              
                    <?php
                        if($row[model]==None)
                        {
                            echo "<p>no camera</p>";
                        }
                        else
                        {
                            echo "<p>".$row[model]." </p>";
                            //echo "<font size=12> ".$row2[model]."</font>";
                        }
                    ?>
                </div>
            </div>
            
            <div class="exif_apert">
                <img class="afes" src="aperture.png" />
                <div class="afes_text">
                    <?php
                        if($row[aperture]==None)
                        {
                            echo "<p>no aperture</p>";
                        }
                        else
                        {
                            echo "<p>".$row[aperture]." </p>";
                            //echo "<font size=12> ".$row2[model]."</font>";
                        }
                    ?>
                </div>
            </div>
            
            <div class="exif_focal">
                <img class="afes" src="focal.png" />
                <div class="afes_text">
                    <?php
                        if($row[focal]==None)
                        {
                            echo "<p>no focal</p>";
                        }
                        else
                        {
                            echo "<p>".$row[focal]." </p>";
                        }
                    ?>
                </div>
            </div>
            
             <div class="exif_exposure">
                <img class="afes" src="exposure.png" />
               <div class="afes_text">
                    <?php
                        if($row[exposure]==None)
                        {
                            echo "<p>no exposure</p>";
                        }
                        else
                        {
                            echo "<p>".$row[exposure]." </p>";
                            //echo "<font size=12> ".$row2[model]."</font>";
                        }
                    ?>
                </div>
            </div>
            
            <div class="exif_speed">
                <img class="afes" src="iso.png" />
               <div class="afes_text">
                    <?php
                        if($row[iso_speed]==None)
                        {
                            echo "<p>no iso info</p>";
                        }
                        else
                        {
                            echo "<p>".$row[iso_speed]." </p>";
                            //echo "<font size=12> ".$row2[model]."</font>";
                        }
                    ?>
                </div>
            </div>
            
            <div class="exif_date">
                <?php
                        if($row[date]==None)
                        {
                            echo "<p>date taken unspecified</p>";
                        }
                        else
                        {
                            echo "<p>".$row[date]." </p>";
                            //echo "<font size=12> ".$row2[model]."</font>";
                        }
                ?>
            </div>
                
        </div>
         
     </container2>
    
        <div class="container3">
                <?php
                    $sqlT = "select t.tagName from Tag t join TagRelation tr on t.id=tr.tagid where tr.pid=$pid";
                    $result3=$conn->query($sqlT);
                    while($row3=$result3->fetch_assoc())
                    {
                        echo "<a class='tagRound' style='text-decoration: none; color: #000000' href=tags.php?cat=$row3[tagName]>$row3[tagName]</a>";
                        echo "<div class='spacing'></div>";
                    }
                ?>
        </div>
    
            <section class="Collage effect-parent">
                <?php
                    $off = $page*20-20;
                    $query = "select distinct u.id, u.url, u.width, u.height from Url u join Common c on u.id=c.p_id where c.nsfw=0 and u.width is not null and u.height is not null order by RAND(123) limit 20 offset $off";
                    $result=$conn->query($query);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<div class=\"Image_Wrapper\">";
                            echo "<a style=\"text-decoration:none;\" href=\"/indDisplay3.php?pid=".$row[id]."\">";
                            echo "<img src=\"".$row[url]."\" width=\"".$row[width]."\" height=\"".$row[height]."\">";
                            echo "</a>";
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

