<?php 
error_reporting(0);
require_once "../newNavBar.php"; 
?>
<?php 
if(isset($_GET['page'])) {
    // get page number for location of the album list
    $page = $_GET["page"];
}else{
    $page = 1;
}
function pageCount($inputStr){
    $replace = 'select count(*) from ';
    $replace2 = ' ';
    $regex = '/select(.*)from/';
    $regex2 = '/limit(.*)/';
    $mid = preg_replace($regex, $replace, $inputStr);
    return preg_replace($regex2, $replace2, $mid);
}
?>

<?php 
    $grav = get_gravatar(strtolower(trim($user->data()->email)));
    $get_info_id = $user->data()->id;
    // $groupname = ucfirst($loggedInUser->title);
    $raw = date_parse($user->data()->join_date);
    $signupdate = $raw['month']."/".$raw['day']."/".$raw['year'];
    $userdetails = fetchUserDetails(NULL, NULL, $get_info_id); //Fetch user details

    $query2 = "select custom1,custom2 from users where id=$get_info_id"; //custom1=>cover photo custom2=>avatar
    $result2=$conn->query($query2);
    $row2 = mysqli_fetch_array($result2);
    if($row2['custom2']==''){
        $gravMod = $grav;
    }else{
        $gravMod = $row2['custom2'];
    }
    $query = "select su.*, lu.scrapeUserID from LinkUser lu join ScrapeUser su on lu.scrapeUserID=su.id where usersID=$get_info_id";
    $result=$conn->query($query);
    //$row = mysqli_fetch_array($result);
    #24380571446
    if($result->num_rows>0){
        $Umode = 1;
        if($row2['custom1']==''){
            //select default cover photo
            $query3 = "select urlSource from Url where id=24493854475";
            $result3=$conn->query($query3);
            $row3 = mysqli_fetch_array($result3);
            $jumboBackground = $row3['urlSource'];
        } else {
            $jumboBackground = $row2['custom1'];
        }
    }else{
        //this account has no linked account
        $Umode = 0;
        $query3 = "select urlSource from Url where id=24493854475";
        $result3=$conn->query($query3);
        $row3 = mysqli_fetch_array($result3);
        $jumboBackground = $row3['urlSource'];
    }
?>
<customHeader>
<style>
    #userAvatar{
        z-index: 1;
        height: 100px;
        width: 100px;
        /* fill the container, preserving aspect ratio, and cropping to fit */
        background-size: cover;
        /* center the image vertically and horizontally */
        background-position: center;
        /* round the edges to a circle with border radius 1/2 container size */
        border-radius: 50%;
    }
    #userAvatar a{
        width: 100%;
        height: 100%;
        opacity: 0;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        font-weight: 700;
        color: #FFF;
    }
    .card-userAvatar{
        z-index: 1;
        height: 100px;
        width: 100px;
        /* fill the container, preserving aspect ratio, and cropping to fit */
        background-size: cover;
        /* center the image vertically and horizontally */
        background-position: center;
        /* round the edges to a circle with border radius 1/2 container size */
        border-radius: 50%;
        margin-bottom: 0.75rem;
    }
    .user-info{
        color: #fff;
    }
    .card-btn{
        margin-right:5px;
        margin-bottom: 5px;
    }
    .accCardCenter{
        vertical-align:middle!important;
        text-align:center;
    }
    .jumbotron .favJumbotron{
        height: auto;
    }
</style>
</customHeader>

<?php if($user->isLoggedIn()){ ?>
<div class="footerPusher">
<div class="jumbotron jumbotron-fluid favJumbotron" style="background-image:url(<?=$jumboBackground;?>);background-size: cover;margin-bottom:0;">
  <div class="container">
    <div id="userAvatar" style="background-image:url(<?=$gravMod;?>);"></div>
    <div class="user-info">
        <a id="user-name" style="font-size:36px;font-weight:700;"><?=ucfirst($user->data()->username)?></a><br>
        <a id="user-add" style="font-size:16px;font-weight:600;">Member Since: <?php echo $signupdate;?></a><br>
        <a style="font-size:16px;font-weight:600;">Number of Logins: <?=$user->data()->logins?></a>
    </div>
  </div>
</div>

<script>
        // load remote page via jquery
        $(document).on('click','.overlay',function(event) {
            event.preventDefault();            
            var modal = $('#gridSystemModal').modal();
            modal.find('.modal-content').load($(this).attr('href'), function () {
                    //$('.modal-content').css('height',$( window ).height());
                    modal.show();                   
                });
        });
</script>

<div class="container first" style="padding-top:8px;padding-bottom:8px;">
    <ul class="nav nav-tabs">
      <li class="nav-item">
          <a class="nav-link" href="../users/account.php">Linked Account</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="../users/user_settings.php">Edit Info</a>
      </li>
      <li class="nav-item">
          <a class="nav-link active">Favorite</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="../users/flickrUpload.php">Upload</a>
      </li>
    </ul>                    
</div>

<div class="preLoadClass">
<section class="Collage effect-parent">
    <?php
        $off = $page*40-40;
        $queryCo = "select distinct su.*, u.id as uid, u.url, u.width, u.height, c.* from Url u join Common c on u.id=c.p_id join fav f on c.p_id=f.favpic join ScrapeUser su on su.id=c.userBelong where f.userid=$get_info_id and u.width is not null and u.height is not null order by c.dateR desc limit 40 offset $off";
        $Pageurl = "../users/accountFav.php?";
        $totalPage = pageCount($queryCo);
        //echo $totalPage;
        $Presult=$conn->query($totalPage);
        $Prow = $Presult->fetch_assoc();
        $totalPageNum = floor($Prow['count(*)']/40)+1;
        $result=$conn->query($queryCo);
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<div class=\"Image_Wrapper\" style=\"width=\"".$row[width]."\" height=\"".$row[height]."\"\">";        
                    echo "<div class=\"hovereffect\">";
                        echo "<a style=\"text-decoration:none;\" href=\"#\">";
                            echo "<img src=\"".$row[url]."\" width=\"".$row[width]."\" height=\"".$row[height]."\">";                      
                        echo "</a>";                    
                        echo "<a class=\"overlay\" href=\"/indDisplay4.php?pid=".$row[uid]."&url=".$row[url]."\">";echo "</a>";
                        
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
    
<?php require_once '../footer.php'; ?>
<?php }else{
    echo '<script type="text/javascript">alert("please sign in first!");</script>';
    echo "<script>window.location = '../users/new_login.php'</script>";
}?>
<?php mysqli_close($conn); ?>


<div id="gridSystemModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modalDialogID">
    <div class="modal-content" id="modalContentID">
      
    </div>
  </div>
</div>
    
</body>
</html>