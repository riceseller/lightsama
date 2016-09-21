<?php
include "newNavBar.php";     //header bar load
$pid = $_GET["pid"];            //get the pid of that picture upon load
require_once("supplyment/dbAccess.php");    //database connection page load
date_default_timezone_set('America/New_York');  //set default time zone as eastern time new york

$come_from=$_POST["come_from"];          //click trace-see where that picture comes from 
if(isset($come_from))                       //click event detected, update click
{
    $query30="update assoCorresp set click=click+1 where ppid=$come_from and cpid=$pid";
    $conn->query($query30);
}   //click event ends

    $query31="update Common set view=view+1 where p_id=$pid";   //
    $conn->query($query31);


$query = "select c.*, u.url, u.urlSource, su.* from Common c left join Url u on c.p_id=u.id join ScrapeUser su on c.userBelong=su.id where c.p_id=$pid";    
$result=$conn->query($query);
$row = mysqli_fetch_array($result); //pull out picture url and associated user info on that 3 queries

$page = 1;

//unknown query starts
$date = $row[dateR];
$userB = $row[userBelong];
$query34 = "select p_id from Common where userBelong=\"$userB\" and dateR<\"$date\" order by dateR desc limit 1";
$result34=$conn->query($query34);
$prev = mysqli_fetch_array($result34);
$query35 = "select p_id from Common where userBelong=\"$userB\" and dateR>\"$date\" order by dateR limit 1";
$result35=$conn->query($query35);
$next = mysqli_fetch_array($result35);
//unknown query ends

//location and coordinate info pull out
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
}   //location and coordinate info pull out ends

//current user info acquisition, set proper register to values on login/unlogin event
if($user->isLoggedIn())
{
    $current_id=$user->data()->id;
    $current_name=$user->data()->username;
}
else
{
    $current_id=0;
    $current_name=0;
}//user info acquisiton ends

//count how many users have faved that one single picture
$query50="select count(*) from fav where favpic=$pid";
$result50=$conn->query($query50);
$row50=mysqli_fetch_array($result50);
$current_fav=$row50[0];//counting process ends

$userid=0;  //declare userid variable, purpose is to compare with the current user id

if($current_fav && $user->isLoggedIn()) //purpose is to find if this pic has been faved by the current user previously
{
    $query90="select userid from fav where favpic=$pid";    //find all users who have faved that pic previously by userid
    $result90=$conn->query($query90);   
    while($row90=$result90->fetch_assoc())
    {
        if($current_id==$row90['userid'])   //current id matches record, meaning the current user faved that pic before
        {
            $userid=$current_id;    //give value and break
            break;
        }
    }
}

//pull out all the comments associated with that picture
$query_comment="select u.custom1, u.custom2, u.username, c.* from users u, comment c where u.id=c.userid and c.compic=$pid ORDER BY comdate" ;
$result_comment=$conn->query($query_comment);   //comment query ends 

//count how many comments have been made towards this particular picture
$query_comment_count="select count(*) from comment where compic=$pid";
$result_count=$conn->query($query_comment_count);
$row1000=mysqli_fetch_array($result_count);
$comment_count=$row1000[0]; //count query ends

//get view information on this particular pid
$query_view="select view from Common where p_id=$pid";
$result_view=$conn->query($query_view);
$row_view=mysqli_fetch_array($result_view);
$view=$row_view[0];

//this part needs modification
$grav = get_gravatar(strtolower(trim($user->data()->email)));

$query2 = "select custom1,custom2 from users where id=$current_id"; //custom1=>cover photo custom2=>avatar
$result2=$conn->query($query2);
$row2 = mysqli_fetch_array($result2);
if($row2[custom2]==''){
    $gravMod2 = $grav;
}else{
    $gravMod2 = $row2[custom2];
}



//the code below is for testing use only, it is just a purpose for tracking ip address of people who visited 
//our page
$ip=$_SERVER['REMOTE_ADDR'];
$query_ip="insert into ipaddress(pid, address, times) values($pid, '$ip', NOW())";
$conn->query($query_ip);

?>

<link rel="stylesheet" type="text/css" href="users/css/indDisplay.css" />
 
   
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

<script>             
    function LogInCheck() {
        var a=<?php print $current_id;?>;   //current user id
        var b=<?php print $pid;?>;          //current picture pid
        var d=<?php print $current_fav;?>;  //current people who hit like
        if(document.getElementById("checkboxG5").checked === true)
        {
            var c='check_like';
            d++;
            var result=d+'<br>favorites';
            result = result.replace(/&amp;/g, "&").replace(/&lt;/g, "<").replace(/&gt;/g, ">");
            document.getElementById('ppp').innerHTML = result;                        
            $.ajax({
                type: 'GET',
                url: 'FavWrite.php',
                data: 'current_id=' + a +'&current_pid=' + b +'&current_cat=' + c                           
                });
        }
        if(document.getElementById("checkboxG5").checked === false)
        {
            var c='uncheck_like';
            d=<?php print $current_fav;?>;  //current people who hit like;         
            var result=d+'<br>favorites';
            result = result.replace(/&amp;/g, "&").replace(/&lt;/g, "<").replace(/&gt;/g, ">");
            document.getElementById('ppp').innerHTML = result;                         
            $.ajax({
                type: 'GET',
                url: 'FavWrite.php',
                data: 'current_id=' + a +'&current_pid=' + b +'&current_cat=' + c                           
            });
        }
    }                                                
    function LogInCheck2() {
        var a=<?php print $current_id;?>;   //current user id
        var b=<?php print $pid;?>;          //current picture pid
        var d=<?php print $current_fav;?>;  //current people who hit like
        if(document.getElementById("checkboxG5").checked === true)
        {   
            var c='check_like';
            d=<?php print $current_fav;?>;                        
            var result=d+'<br>favorites';
            result = result.replace(/&amp;/g, "&").replace(/&lt;/g, "<").replace(/&gt;/g, ">");
            document.getElementById('ppp').innerHTML = result;                        
            $.ajax({
                type: 'GET',
                url: 'FavWrite.php',
                data: 'current_id=' + a +'&current_pid=' + b +'&current_cat=' + c                           
            });

        }
        else if(document.getElementById("checkboxG5").checked === false)
        {     
            var c='uncheck_like';
            d--;
            var result=d+'<br>favorites';
            result = result.replace(/&amp;/g, "&").replace(/&lt;/g, "<").replace(/&gt;/g, ">");
            document.getElementById('ppp').innerHTML = result;
            $.ajax({
                type: 'GET',
                url: 'FavWrite.php',
                data: 'current_id=' + a +'&current_pid=' + b +'&current_cat=' + c                            
            });
        }
    }                
    function UnLogCheck(){
        alert("please log in then you can fav that pic");
        document.getElementById("checkboxG5").checked = false;
    }
</script>

<script>
var counter=0;
function myFunction() {
    var add_comment=document.getElementById("field5").value;
    var a=<?php print $current_id;?>;   //current user id
    var b=<?php print $pid;?>;          //current picture pid
    var p='<?php print $current_name;?>';    
    var q=<?php print $comment_count;?>+counter+1;
    var userlink='<?php print $row2[custom2];?>';
    counter++;
    var c='comment_write';
    if(!add_comment || !a){
        alert("you either sumbit an empty comment or you did not log in at all");
        return;
    }
    var old_comment=document.getElementById("comments-list").innerHTML; 
    var new_comment=old_comment+'<li id=1000><div class="comment-main-level"><div class="comment-avatar"><img src="'+userlink+'" alt=""></div><div class="comment-box"><div class="comment-head"><h6 class="comment-name by-author"><a href="http://creaticode.com/blog">'+p+'</a></h6><span>just now</span><p><i class="fa fa-trash" onclick="DeleteComment(1000)"></i><i class="fa fa-reply"></i></p></div><div class="comment-content">'+add_comment+'</div></div></div></li>';
    new_comment = new_comment.replace(/&amp;/g, "&").replace(/&lt;/g, "<").replace(/&gt;/g, ">");
    document.getElementById('comments-list').innerHTML = new_comment;
    if(q>1)
    {
        var updated_comment='<p>'+q+'<br>comments</p>';
    }
    else
    {
        var updated_comment='<p>'+q+'<br>comment</p>';
    }
    
    $.ajax({
                type: 'GET',
                url: 'FavWrite.php',
                data: 'current_id=' + a +'&current_pid=' + b +'&current_cat=' + c +'&current_comment='+add_comment              
            });            
    updated_comment = updated_comment.replace(/&amp;/g, "&").replace(/&lt;/g, "<").replace(/&gt;/g, ">");
    document.getElementById('comment').innerHTML = updated_comment;                
}
</script>

<script>
    function DeleteComment(id_number){
        var elem=document.getElementById(id_number);
        elem.parentNode.removeChild(elem);
        var c='comment_delete';
        $.ajax({                            //delete query activated
                type: 'GET',
                url: 'FavWrite.php',
                data: 'current_cid=' + id_number + '&current_cat=' + c                           
                });
}
</script>

<script>
    function myfunction2(username, userid)
    {   
        var current_id=<?php print $current_id;?>;
        if(current_id===0)
        {
            alert("you have to login first then reply");
            return;
        }
        if(userid==current_id)
        {
            alert("it is not suggested to reply to a comment made by yourself");
        }
        else
        {
            var nameadd='@add '+username+' ';
            document.getElementById("field5").value=nameadd;
        }
    }
</script>

<script>
    function comment_like(id_number){
        alert(id_number);
        document.getElementById(id_number).style.color = "red";
    }
</script>

<body>
    <div class="container">
        <div id="scrolla">
            <?php if(mysqli_num_rows($result35)>0): ?>
                <a href="<?php $nextpid = $next[p_id]; print "/indDisplay2.php?pid=$nextpid";?> ">
            <?php else: ?>
                <a style="opacity: 0.1;">
            <?php endif; ?>
                <img src="/media/left_arrow.png" />
            </a>
        </div>
        
        <div id="scrollb">
        <a class="scrollIMG" style="text-decoration: none;" href="<?php if($row['Ubelong']=='500px')
                                                       {
                                                            $link="https://500px.com/photo/";
                                                            $link=$link . $pid;
                                                            print $link;
                                                        }
                                                        elseif($row['Ubelong']=='Flickr')
                                                        {
                                                            $userID = $row['userID'];
                                                            print "https://www.flickr.com/photos/$userID/$pid";
                                                        }
                                                        else
                                                        {
                                                            print $row['url']; 
                                                        }?>">
            <img  class="scrollbIMG" src="<?php if($row['urlSource']){print $row['urlSource'];}else{print $row['url'];}?>" />
        </a>   
            <favicon>     
                <input type="checkbox" name="checkboxG5" id="checkboxG5" class="css-checkbox"  
                       <?php if($user->isLoggedIn())
                            {
                                if($current_id==$userid)  //it has been liked by the same user before, only option is unlike
                                {
                                    echo "checked='true'";
                                    echo "onclick='LogInCheck2()'";
                                }
                                else    //it has not been liked before, option is like 
                                {                                  
                                    echo "autocomplete='off'";
                                    echo "onclick='LogInCheck()'";
                                }                               
                            }
                            else
                            {
                                echo "autocomplete='off'";
                                echo "onclick='LogInCheck()'";
                            }
                        ?>
                />
                <label for="checkboxG5" class="css-label"></label>
            </favicon>
        </div>
        
        <div id="scrollc">
            <?php if(mysqli_num_rows($result34)>0): ?>
                <a href="<?php $prevpid = $prev[p_id]; print "/indDisplay2.php?pid=$prevpid";?> ">
            <?php else: ?>
                <a style="opacity: 0.1;">                
            <?php endif; ?>
                <img src="/media/right_arrow.png" />
            </a>   
        </div>        
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
                        elseif($row['displayName'])
                        {
                            echo "<p><a href=\"../indUser.php?id=$row[id]\">$row[displayName]</a></p>";
                            //echo "<font size=12> ".$row2[model]."</font>";
                        }else{
                            echo "<p> null displayName </p>";
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
                    <p><?php echo $view;?><br><?php if($view=='1'){echo "view";} else{echo "views";}?></p>
                </div>
                                
                <div id="fav">  
                    <p id="ppp"><?php echo $current_fav;?><br>favorites</p>
                </div>
                               
                <div id="comment">                   
                    <?php echo "<p>".$comment_count."<br>";?>
                    <?php if($comment_count==1 || $comment_count==0){echo "comment</p>";} else {echo "comments</p>";}?>
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




<div id="fdb">
    <div class="comment-wrap">
<!-- Contenedor Principal -->
	<div class="comments-container">
		<ul id="comments-list" class="comments-list">			
                    <?php
                        $current_date=new DateTime();
                        while($row_comment=$result_comment->fetch_assoc())
                        {
                            $comment_date=new DateTime($row_comment[comdate]);
                            $dteDiff  = $comment_date->diff($current_date);
                            if($row_comment[custom2]=='')
                            {                             
                                $gravMod = $grav;                               
                            }
                            else {                               
                                $gravMod = $row_comment[custom2];                                
                            }
                            
                            if($dteDiff->format("%M")!='00')
                            {
                                $date_print=$dteDiff->format("%M");  
                                if(substr($date_print, 0, 1)=='0')
                                {
                                    $date_print=substr($date_print, 1, 1);
                                    if($date_print=='1')
                                    {
                                        $date_print2=''.$date_print.' month ago';               
                                    }
                                    else
                                    {
                                        $date_print2=''.$date_print.' months ago';               
                                    }
                                }
                                else 
                                {
                                    $date_print2=''.$date_print.' months ago';            
                                }              
                            }
                            else if($dteDiff->format("%D")!='00')
                            {
                                $date_print=$dteDiff->format("%D");  
                                if(substr($date_print, 0, 1)=='0')
                                {
                                    $date_print=substr($date_print, 1, 1);
                                    if($date_print=='1')
                                    {
                                        $date_print2=''.$date_print.' day ago';               
                                    }
                                    else
                                    {
                                        $date_print2=''.$date_print.' days ago';               
                                    }
                                }
                                else 
                                {
                                    $date_print2=''.$date_print.' days ago';            
                                }   
                            }
                            else if($dteDiff->format("%H")!='00')
                            {
                                $date_print=$dteDiff->format("%H");  
                                if(substr($date_print, 0, 1)=='0')
                                {
                                    $date_print=substr($date_print, 1, 1);
                                    if($date_print=='1')
                                    {
                                        $date_print2=''.$date_print.' hour ago';               
                                    }
                                    else
                                    {
                                        $date_print2=''.$date_print.' hours ago';               
                                    }
                                }
                                else 
                                {
                                    $date_print2=''.$date_print.' hours ago';            
                                }                         
                            }
                            else if($dteDiff->format("%I")!='00')
                            {
                                $date_print=$dteDiff->format("%I");  
                                if(substr($date_print, 0, 1)=='0')
                                {
                                    $date_print=substr($date_print, 1, 1);
                                    if($date_print=='1')
                                    {
                                        $date_print2=''.$date_print.' minute ago';               
                                    }
                                    else
                                    {
                                        $date_print2=''.$date_print.' minutes ago';               
                                    }
                                }
                                else 
                                {
                                    $date_print2=''.$date_print.' minutes ago';            
                                }              
                            }
                            else if($dteDiff->format("%S")!='00')
                            {
                                $date_print=$dteDiff->format("%S");  
                                if(substr($date_print, 0, 1)=='0')
                                {
                                    $date_print=substr($date_print, 1, 1);
                                    if($date_print=='1')
                                    {
                                        $date_print2=''.$date_print.' second ago';               
                                    }
                                    else
                                    {
                                        $date_print2=''.$date_print.' seconds ago';               
                                    }
                                }
                                else 
                                {
                                    $date_print2=''.$date_print.' seconds ago';            
                                }            
                            }
                                                        
                            if($row_comment[userid]!=$current_id && $current_id!=0)
                            {
                                echo "<li id='$row_comment[id]'><div class='comment-main-level'><div class='comment-avatar'><img src='$gravMod'></div><div class='comment-box'><div class='comment-head'><h6 class='comment-name by-author'><a href='#'>$row_comment[username]</a></h6><span>$date_print2</span><p><i class='fa fa-reply' onclick=\"myfunction2('$row_comment[username]', '$row_comment[userid]')\"></i></p></div><div class='comment-content'>$row_comment[content]</div></div></div></li>";
                            }
                            else if($current_id==0)
                            {
                                echo "<li id='$row_comment[id]'><div class='comment-main-level'><div class='comment-avatar'><img src='$gravMod'></div><div class='comment-box'><div class='comment-head'><h6 class='comment-name by-author'><a href='#'>$row_comment[username]</a></h6><span>$date_print2</span></div><div class='comment-content'>$row_comment[content]</div></div></div></li>";
                            }
                            else
                            {
                                echo "<li id='$row_comment[id]'><div class='comment-main-level'><div class='comment-avatar'><img src='$gravMod'></div><div class='comment-box'><div class='comment-head'><h6 class='comment-name by-author'><a href='#'>$row_comment[username]</a></h6><span>$date_print2</span><p><i class='fa fa-trash' onclick=\"DeleteComment('$row_comment[id]')\"></i><i class='fa fa-reply' onclick=\"myfunction2('$row_comment[username]', '$row_comment[userid]')\"></i></p></div><div class='comment-content'>$row_comment[content]</div></div></div></li>";
                            }                   
                        }
                    ?>                   
		</ul>
	</div>
    <!-- comment submission form goes down there -->   
    <div id="submission">
        <form>
            <ul class="form-style-1">
                <li>
                    <label>Comments Here</label>
                    <textarea id="field5" class="field-long field-textarea"></textarea>
                </li>
                <li>
                    <input type="button" value="Submit" onclick="myFunction()">
                </li>
                <li>
                    <input type="button" value="Sync">
                </li>
            </ul>
        </form>
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
</div>
    
    
    
    
</div>
    
        <div class="text_prompt">
            <p>similar pictures</p>
        </div>  
    
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
        <?php
            require_once "footer.php";
        ?>
    </body>
    
</html>