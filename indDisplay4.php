<?php
    error_reporting(0);
    include "supplyment/dbAccess.php";
    require_once 'users/init.php';
    date_default_timezone_set('Atlantic/Reykjavik');  //set default time zone as UTC0
    $pid=$_GET["pid"];
    $url=$_GET["url"];
    $query = "select c.*, u.urlSource, su.* from Common c left join Url u on c.p_id=u.id join ScrapeUser su on c.userBelong=su.id where c.p_id=$pid";    
    $result=$conn->query($query);
    $row = mysqli_fetch_array($result); //pull out picture url and associated user info on that 3 queries
    
    //get view information on this particular pid
    $query_view="select view from Common where p_id=$pid";
    $result_view=$conn->query($query_view);
    $row_view=mysqli_fetch_array($result_view);
    $view=$row_view[0];
    
    //count how many users have faved that one single picture
    $query50="select count(*) from fav where favpic=$pid";
    $result50=$conn->query($query50);
    $row50=mysqli_fetch_array($result50);
    $current_fav=$row50[0];//counting process ends
    
    //count how many comments have been made towards this particular picture
    $query_comment_count="select count(*) from comment where compic=$pid";
    $result_count=$conn->query($query_comment_count);
    $row1000=mysqli_fetch_array($result_count);
    $comment_count=$row1000[0]; //count query ends
    
    //once clicked, it has been viewed, so increment view counter with 1
    $query31="update Common set view=view+1 where p_id=$pid";   
    $conn->query($query31);
    
    //current user info acquisition, set proper register to values on login/unlogin event
    if($user->isLoggedIn())
    {
        $current_id=$user->data()->id;
        $current_name=$user->data()->username;
    }
    else
    {
        $current_id=-5;
        $current_name=0;
    }//user info acquisiton ends
    
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
    $query_comment="select u.custom1, u.custom2, u.username, c.* from users u, comment c where u.id=c.userid and c.compic=$pid ORDER BY comdate DESC" ;
    $result_comment=$conn->query($query_comment);   //comment query ends 

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
<style>
.col-md-9{
    padding: 0;
}
.col-md-3{
    padding: 0;
}
.col-xs-2{
    padding: 0;
}
.col-xs-6{
   padding: 0;
}
.col-md-4{
    padding: 0;
}
.col-md-6{
    padding: 0;
}
.col-xs-9{
    padding: 0;
}
.col-xs-8{
    padding: 0;
}
.col-xs-4{
    padding: 0;
}
.col-md-8{
    padding: 0;
}
.col-md-4{
    padding: 0;
}
.col-xs-3{
    padding: 0;
}
.col-xs-10{
    padding: 0;
}
#modalDialogID{
    width: 100% !important;
    height: auto;
    min-height: 100%;
    margin: 0;
    padding: 0;
    max-width: inherit !important;
}
#modalContentID{
    height: auto;
    min-height: 100%;
    border-radius: 0;
    background-color: #000;
    border: 0;
    margin: 0;
    padding: 0;
}
.container-fluid{
    display: block;
    text-align: center;
    margin: 0;
    padding: 0;
    width: 100%;
    height: auto;
    min-height: 100%
}
.infoDisplay{
    background-color: #333333;
    height: 100vh;
    overflow: auto;
    overflow-x: hidden;
}
.iconDisplay{
    background-color: #222222;
}
.imgDisplay{
}
.imgDisplay img{
    height: 100vh;
    margin: 0;
    padding: 0;    
    width: 100%;
    object-fit: contain;    
}
.imgSpacer{   
    min-height: 49px;
}
.iconsShow{
    background-color: #3e3e3e;
    min-height: 43px;
    border: 1px solid #222;
    margin: 0 !important;
    padding: 0;
}
.iconShow a i{
    display: inline-block;
}
p.iconDisplayText{
    font-size: 15px;
    display: inline-block !important;
    margin-left: 3px;
    color: white !important;
}
.userNameAndPic{
    margin-top: 10px;
    margin-left: 10px;
    width: 95%;
}
.userPicImg{
    margin: 0;
}
.userPicImg img{
    width:  35px !important;
    height: 35px !important;
    /* fill the container, preserving aspect ratio, and cropping to fit */
    background-size: cover;
    /* center the image vertically and horizontally */
    background-position: center;
    margin-left: 0;
    margin-right: 0;
    display: inline-block;
}
.userNameDisplay{
    padding: 0;
}
.userNameDisplay p {
    font-size: 15px;
    display: inline-block;
    margin-left: 3px;
}
.userNameDisplay p a{
    color: white !important;
}
.titleAndDesCription{
    margin: 0;
    padding: 10px;
    padding-left: 10px;
    width: 95%;
}
.titleAndDesCription p{
    display: block;
    color: white;
    word-wrap: break-word;
    text-align: left;
}
p.titleDisplay{
    font-size: 22px;
    margin-bottom: 5px;
}
p.descriptDisplay{
    font-size: 14px;
    line-height: 110%;
    margin-bottom: 5px;
}
.tagOrientation{
    margin: 0;
    padding: 10px;
    padding-top: 0;
    display: flex;
    justify-content: flex-start;
    flex-direction: row;
    flex-wrap: wrap;
    align-items: center;
    vertical-align: middle;
    width: 95%;
}
.tagOrientation a{
    display: block;
    margin-right: 4px;
    margin-bottom: 4px;
    padding: 2px 6px;
    font-size: 12px;
    line-height: 1em;
    color: #FFF !important;
    border-radius: 2px;
    background-color: #999;
    text-decoration: none;
}
.picEquipInfo{
    margin: 0;
    padding: 0;
    margin-left: 10px;
    text-align: left;
    height: auto;
    width: 95%;
}
.picEquipInfo i{
    display: inline-block;
}
p.picEquipInfoText{
    font-size: 13px;
    display: inline-block !important;
    margin-left: 3px;
    color: white !important;
    margin-bottom: 3px;
}
#commentAdd{
    margin-top: 5px;
    margin-bottom: 5px;
}
.form-reply{
    padding: 6px 8px 6px 48px;
    clear: both;
    display: block;
    margin-top: 0em;
    border-top: 1px solid #222;
}
.form-reply .site-icon{
    position: absolute;
    top: 6px;
    left: 0px;
    display: block;
}
.form-reply .button-position{
    position: absolute;
    top: 45px;
    left: 39px;
    display: block;
}
.form-reply .button-position input[type=button]{
    width: 40px;
    height: 30px;
    background: #4B99AD !important;
    padding: 8px 15px 8px 15px;
    border: none;
    color: #fff;
    font-family: inherit;
    font-size: 13px;
}
.form-reply .button-position input[type=button]:hover{
    background: #4691A4;
    box-shadow:none;
    -moz-box-shadow:none;
    -webkit-box-shadow:none;
}
.site-icon img{
    border-radius: 50%;
    width: 35px;
    height: 35px;
}
.reply-content{
    height: 45px;
    padding-top: 6px;
    background-color: #333;
}
textarea, input[type=text], input[type=password] {
    border: 1px solid #ccc;
}
.form-reply textarea {
    width: 100%;
    color: #9a9a9a;
    font-family: inherit;
    font-size: 13px;
    line-height: 110%;
    -webkit-rtl-ordering: logical;
    -webkit-user-select: text;
    flex-direction: column;
    resize: auto;
    cursor: auto;
    white-space: pre-wrap;
    word-wrap: break-word;
}
.form-position{
    width: 95%;
}
.comments-position{
    width: 95%;
}
.list-of-comments{
    background-color: #333333;
    border-top: 1px solid #222;
    padding-left: 0;
    list-style: none;
    margin: 0;
    box-sizing: border-box;
    display: block;
    -webkit-margin-start: 0px;
    -webkit-margin-end: 0px;
}
.comments-display{
    padding: 6px 8px 6px 48px;
    clear: both;
    display: block;
    margin-top: 0em;
    border-top: 1px solid #222;
}
.list-of-comments li {
    display: block;
    border-top: 1px solid #313131;
    color: #eee;
    position: relative;
    padding: 0;
    min-height: 36px;
    margin: 0;
    text-align: left;
    margin-bottom: 2px;
}
.list-of-comments li img{
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-size: cover;
    /* center the image vertically and horizontally */
    background-position: center;
    margin-left: 2px;
    margin-top: 5px;
    display: inline-block;
    position: absolute;
    top: 6px;
    left: 0px;   
}
.list-of-comments li i{
    color: #A6A6A6;
    cursor: pointer;
    opacity: 0;
    -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
    transition: opacity 0.35s, transform 0.35s;
    -webkit-transform: translate3d(0,-10px,0);
    transform: translate3d(0,-10px,0);
}
#trashCan{
    float: right;
    margin-right: 10px;
    margin-top: 5px;
    position: relative;
    top: 2px;
}
#replyIcon{
    float: right;
    margin-right: 10px;
    margin-top: 5px;
    position: relative;
    top: 2px;
}
.list-of-comments li i::before{
    -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
    transition: opacity 0.35s, transform 0.35s;
    -webkit-transform: translate3d(0,4em,0) scale3d(1,0.023,1) ;
    transform: translate3d(0,4em,0) scale3d(1,0.023,1);
    -webkit-transform-origin: 50% 0;
    transform-origin: 50% 0;
}
.list-of-comments li:hover i{
    opacity: 1;
    -webkit-transform: translate3d(0,0,0);
}
.list-of-comments li .list-description{
    display: inline-block;
    margin-top: 0;
    padding-left: 45px;
    height: 100%;
    width: 100%;
}
.list-of-comments li p{
    margin-left: 3px;
    color: white !important;
    margin-bottom: 0;
    margin-top: 0;
    display: block;
}
.list-of-comments li p .reply-title{
    font-size: 16px;
}
.list-of-comments li p .reply-time{
    font-size: 12px;
    color: #919191;
}
p.reply-content{
    font-size: 13px;
}
.comments-position{
    margin-top: 0;
}
.iconShow .iconDisplay a{
    color: white;
}
.iconShow .iconDisplay a:hover{
    color: red;
}
</style>

<script>
    function LogInCheck() {
        var a=<?php print $current_id;?>;   //current user id
        var b=<?php print $pid;?>;          //current picture pid
        var d=<?php print $current_fav;?>;  //current people who hit like
        if(document.getElementById("activateMyHeart").style.color === "white")
        {
            var c='check_like';
            d++;
            document.getElementById('howManyFavs').innerHTML = d;                        
            $.ajax({
                type: 'GET',
                url: '../FavWrite.php',
                data: 'current_id=' + a +'&current_pid=' + b +'&current_cat=' + c,
                success: function(){
                    document.getElementById("activateMyHeart").style.color = "red";
                }
                });
        }
        if(document.getElementById("activateMyHeart").style.color === "red")
        {
            var c='uncheck_like';
            d=<?php print $current_fav;?>;  //current people who hit like;         
            document.getElementById('howManyFavs').innerHTML = d;                         
            $.ajax({
                type: 'GET',
                url: '../FavWrite.php',
                data: 'current_id=' + a +'&current_pid=' + b +'&current_cat=' + c,
                success: function(){
                    document.getElementById("activateMyHeart").style.color = "white";
                }
            });
        }
    }                                                
    function LogInCheck2() {
        var a=<?php print $current_id;?>;   //current user id
        var b=<?php print $pid;?>;          //current picture pid
        var d=<?php print $current_fav;?>;  //current people who hit like
        if(document.getElementById("activateMyHeart").style.color === "white")
        {   
            var c='check_like';
            d=<?php print $current_fav;?>;                        
            document.getElementById('howManyFavs').innerHTML = d;                        
            $.ajax({
                type: 'GET',
                url: '../FavWrite.php',
                data: 'current_id=' + a +'&current_pid=' + b +'&current_cat=' + c,
                success: function(){
                    document.getElementById("activateMyHeart").style.color = "red";
                }
            });

        }
        else if(document.getElementById("activateMyHeart").style.color === "red")
        {     
            var c='uncheck_like';
            d--;
            document.getElementById('howManyFavs').innerHTML = d;
            $.ajax({
                type: 'GET',
                url: '../FavWrite.php',
                data: 'current_id=' + a +'&current_pid=' + b +'&current_cat=' + c,
                success: function(){
                    document.getElementById("activateMyHeart").style.color = "white";
                }
            });
        }
    }
    function UnLogCheck(){
        alert("I know you like it, but please log in first then you can do everything you want");
    }
</script>

<script>
function addComment() {
    var add_comment=document.getElementById("field5").value;
    var a=<?php print $current_id;?>;   //current user id
    var b=<?php print $pid;?>;          //current picture pid
    var p='<?php print $current_name;?>';    
    var q=document.getElementById('commentCount').innerHTML;
    var userlink='<?php print $row2[custom2];?>';
    q++;
    var c='comment_write';
    if(!add_comment || a === -5){
        alert("you either sumbit an empty comment or you did not log in at all");
        return;
    }
    var old_comment=document.getElementById("comments-list").innerHTML; 
    var new_comment='<li id="1000"><div class=" "><img src="'+userlink+'"/><div class="list-description"><p><span class="reply-title">'+p+' '+'<span class="reply-time">just now</span><span><i id=\"trashCan\" class=\"fa fa-trash\" onclick=\"deleteComment(1000)"></i></span></p><p class="reply-content">'+add_comment+'</p></div></li>'+old_comment;
    new_comment = new_comment.replace(/&amp;/g, "&").replace(/&lt;/g, "<").replace(/&gt;/g, ">");
    document.getElementById('comments-list').innerHTML = new_comment;
    
    $.ajax({
                type: 'GET',
                url: '../FavWrite.php',
                data: 'current_id=' + a +'&current_pid=' + b +'&current_cat=' + c +'&current_comment='+add_comment              
            });            
    document.getElementById('commentCount').innerHTML = q;                
}
</script>
<script>
    function deleteComment(id_number){
        var elem=document.getElementById(id_number);
        elem.parentNode.removeChild(elem);
        var q=document.getElementById('commentCount').innerHTML;
        q--;
        var c='comment_delete';
        $.ajax({                            //delete query activated
                type: 'GET',
                url: '../FavWrite.php',
                data: 'current_cid=' + id_number + '&current_cat=' + c                           
                });
        document.getElementById('commentCount').innerHTML = q; 
}
</script>
<script>
    function followUp(username, userid)
    {   
        var current_id=<?php print $current_id;?>;
        if(current_id===0)
        {
            alert("you have to login first then reply");
            return;
        }
        if(userid === current_id)
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

    <div class="container-fluid" style="padding: 0;">
        
        <div class="col-md-9 imgDisplay">
            <img class="img-fluid" src="<?php echo $url; ?>" />
        </div>
        
        <div class="col-md-3 infoDisplay">
            <div class="row iconShow iconDisplay">
                <div class="col-xs-3" style="margin-top: 10px;">
                    <a id="checkboxG5" href="#" <?php if($user->isLoggedIn())
                            {
                                if($current_id==$userid)  //it has been liked by the same user before, only option is unlike
                                {
                                    echo "onclick='LogInCheck2()'";
                                }
                                else    //it has not been liked before, option is like 
                                {                                                                
                                    echo "onclick='LogInCheck()'";
                                }                               
                            }
                            else
                            {
                                echo "onclick='UnLogCheck()'";
                            }
                        ?>><i id="activateMyHeart" class="fa fa-heart" style="<?php if($current_id==$userid){echo "color: red";} else{echo "color: white";}?>"></i></a>
                    <p id="howManyFavs" class="iconDisplayText"><?php echo $current_fav;?></p>
                </div>
                <div class="col-xs-3" style="margin-top: 10px;">
                    <a href="#"><i class="fa fa-eye" style="color: white;"></i></a>
                    <p class="iconDisplayText"><?php echo $view;?></p>
                </div>
                <div class="col-xs-3" style="margin-top: 10px;">
                    <a href="#"><i class="fa fa-comments" style="color: white;"></i></a>
                    <p class="iconDisplayText" id="commentCount"><?php echo $comment_count;?></p>
                </div>
                <div class="col-xs-3" style="margin-top: 10px;">
                    <a href="#"><i class="fa fa-close" style="color: white;" data-dismiss="modal"></i></a>
                </div>                
            </div>
            <div class="row userNameAndPic">
                <div class="col-xs-12" style="padding: 0; text-align: left">                    
                        <div class="userPicImg userNameDisplay">
                            <img class="img-fluid img-circle" style="<?php
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
                            if($row[userBelong]<=1)
                            {
                                echo "<p> Need Scrape </p>";
                            }
                            elseif($row['displayName'])
                            {
                                echo "<p style=\"margin:0\"><a style=\"text-decoration: none;\"; href=\"../indUser.php?id=$row[id]\">$row[displayName]</a></p>";
                                //echo "<font size=12> ".$row2[model]."</font>";
                            }else{
                                echo "<p style=\"margin:0\">\null displayName </p>";
                            }                           
                            ?>
                        </div>              
                </div>
            </div>
            <div class="row titleAndDesCription">
                <p class="titleDisplay"><?php echo $row[title];?></p>                
                <?php
                        if($row[descript]==None)
                        {
                            echo "<p class=\"descriptDisplay\">This picure does not have a description</p>";
                        }
                        else
                        {
                            echo "<p class=\"descriptDisplay\"> ".$row[descript]." </p>";
                        }
                    ?>
            </div>
            <div class="row tagOrientation">
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
            <div class="row picEquipInfo" style="border-top: 1px solid #222222;">
                <i class="fa fa-camera" style="color: white;"></i>
                <p class="picEquipInfoText"><?php
                            if($row[model]==None)
                            {
                                echo "no camera info";
                            }
                            else
                            {
                                echo $row[model];
                            }?></p>
            </div>
            <div class="row picEquipInfo">
                <i class="fa fa-life-ring" style="color: white;"></i>
                <p class="picEquipInfoText" style="margin-left: 4.2px;">
                    <?php
                            if($row[lens]==None)
                            {
                                echo "no lens info";
                            }
                            else
                            {
                                echo $row[lens];
                            }
                        ?>
                </p>                
            </div>
            <div class="row picEquipInfo">
                <i class="fa fa-eye-slash" style="color: white;"></i>
                <p class="picEquipInfoText">
                     <?php
                                if($row[iso_speed]==None or $row[iso_speed]<=0)
                                {
                                    echo " - ";
                                }
                                else
                                {
                                    echo "$row[iso_speed]";
                                }
                        ?>
                </p>
            </div>
            <div class="row picEquipInfo">
                <i class="fa fa-calendar" style="color: white;"></i>
                <p class="picEquipInfoText">
                    <?php
                        if($row[dateR]=='0000-00-00 00:00:00')
                        {
                            echo "some time in the universe";
                        }
                        else
                        {
                            echo "Taken on ".$row[dateR]."";
                        }
                        ?>
                </p>
            </div>
            <div class="row userNameAndPic form-position">
                <div class="col-xs-12" style="padding: 0; text-align: left">                    
                    <form class="form-reply collapsed">
                        <div class="site-icon">
                            <img class="img-fluid" style="object-fit: contain;" <?php if($current_id!=-5){echo "src='$gravMod2'";} ?>/>
                        </div>
                        <textarea id="field5" class="reply-content" placeholder="leave comments please"></textarea>
                        <input type="button" value="Submit" onclick="addComment()" style="background-color: #0090e3; border: none; font-size: 13px;">
                    </form>
                </div>                
            </div>
            <div class="row userNameAndPic comments-position">
                <ul class="list-of-comments" id="comments-list">
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
                                                        
                            if($row_comment[userid]!=$current_id && $current_id!=-5) //logged in, not your picture
                            {
                                echo "<li id='$row_comment[id]' class=\"comments-display\"><img src='$gravMod' class=\"img-fluid\"/><div class=\"list-description\"><p class=\"reply-total\"><span class=\"reply-title\">$row_comment[username] </span><span class=\"reply-time\">$date_print2</span><span><i id=\"replyIcon\" class=\"fa fa-reply\" onclick=\"followUp('$row_comment[username]', '$row_comment[userid]')\"></i></span></p><p class=\"reply-content\">$row_comment[content]</p></div></li>";
                            }
                            else if($current_id==-5) //not logged in, not your picture
                            {
                                echo "<li id='$row_comment[id]' class=\"comments-display\"><img src='$gravMod' class=\"img-fluid\" /><div class=\"list-description\"><p class=\"reply-total\"><span class=\"reply-title\">$row_comment[username] </span><span class=\"reply-time\">$date_print2</span></p><p class=\"reply-content\">$row_comment[content]</p></div></li>";
                            }
                            else //logged in, your picture
                            {
                                echo "<li id='$row_comment[id]' class=\"comments-display\"><img src='$gravMod' class=\"img-fluid\" /><div class=\"list-description\"><p class=\"reply-total\"><span class=\"reply-title\">$row_comment[username] </span><span class=\"reply-time\">$date_print2</span><span><i id=\"trashCan\" class=\"fa fa-trash\" onclick=\"deleteComment('$row_comment[id]')\"></i></span></p><p class=\"reply-content\">$row_comment[content]</p></div></li>";
                            }                   
                        }
                    ?>
                </ul>
            </div>            
        </div>
        
    </div>
        
<?php mysqli_close($conn); ?>      
       



