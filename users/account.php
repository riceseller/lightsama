<?php
error_reporting(0);
require_once "../newNavBar.php";

function displayBlock($row,$mode){
    if($mode==1){
        //display ind block using input
        if($row['Ubelong']=='flickr' or $row['Ubelong']=='Flickr'){
                $server = $row['extraOne'];
                $farm = $row['extraTwo'];
                $userr = $row['userID'];
                $avaStr = "background-image:url(https://c2.staticflickr.com/$farm/$server/buddyicons/$userr.jpg)";
            }elseif($row[Ubelong]=='500px'){
                $usrr = $row['extraTwo'];
                $avaStr = "background-image:url($usrr)";
            }else{
                $avaStr = "background-image:url($grav)";
            }
        $printID = $row['userID'];
        $printScrapUID = $row['scrapeUserID'];
        $printBelong = $row['Ubelong'];
        print "<div class='card accCardCenter'>";
        print "<div class='card-block'>";
        print "<img class='card-userAvatar' style=$avaStr>";
        print "<h4 class='card-title'>ID: $printID</h4>";
        print "<a href='../indUser.php?id=$printScrapUID' class='btn btn-primary card-btn'>PhotoStream</a>";
        print "<a href='../accAlbum.php?id=$printScrapUID' class='btn btn-primary card-btn'>Ablum</a>";
        print "<a class='btn btn-danger card-btn' href='ondelete.php?del=$printID&be=$printBelong' onclick='return checkDelete()'>&#128465</a>";
        print "</div>";
        print "</div>";
    }
    if($mode==2){
    //display add block directly
    print '<div class="card accCardCenter"><div class="card-block">'
            . '<h4> </h4>'
            . '<a href="../phpFlick/auth.php" style="font-size:80px;opacity:0.5;">&#8853</a>'
            . '<h4> </h4>'
            . '</div></div>';
    }
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
</style>

<script language="JavaScript" type="text/javascript">
    function checkDelete(){
        return confirm('Are you sure?');
    }
</script>
<script>
        $(document).on('click','#picUpLoad',function(event) {
            event.preventDefault();
            var modal = $('#modal').modal();
            modal.find('.modal-body').load($(this).attr('href'), function () {
                    modal.show();
                });
        });
</script>
</customHeader>

<?php if($user->isLoggedIn()){ ?>
<div class="footerPusher">
    <div class="jumbotron jumbotron-fluid" style="background-image:url(<?=$jumboBackground;?>);background-size: cover;margin-bottom:0;">
        <div class="container">
            <div id="userAvatar" style="background-image:url(<?=$gravMod;?>);"></div>
                <div class="user-info">
                    <a id="user-name" style="font-size:36px;font-weight:700;"><?=ucfirst($user->data()->username)?></a><br>
                    <a id="user-add" style="font-size:16px;font-weight:600;">Member Since: <?php echo $signupdate;?></a><br>
                    <a style="font-size:16px;font-weight:600;">Number of Logins: <?=$user->data()->logins?></a>
                </div>
        </div>
    </div>
          
    <div class="container first" style="padding-top:8px;padding-bottom:8px;">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active">Linked Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../users/user_settings.php">Edit Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../users/accountFav.php">Favorite</a>
            </li>
            <li class="nav-item">
                <a id="picUpLoad" class="nav-link" href="../users/flickrUpload.php">Upload</a>
            </li>
        </ul>                    
    </div>

    <div class="container second">
        <div class="card-deck-wrapper">
            <div class="card-deck">
                <?php
                    if($Umode==1){
                        //print $row[userID]
                        //displayBlock($row[scrapeUserID],$row[userID], $row[Ubelong]);
                        while($row = mysqli_fetch_array($result)) {
                            displayBlock($row,1);
                        }
                    }
                    displayBlock($row,2);
                ?>
            </div>
        </div>
    </div>
</div>
    
<?php require_once '../footer.php'; ?>
<?php }else{
    echo '<script type="text/javascript">alert("please sign in first!");</script>';
    echo "<script>window.location = '../users/new_login.php'</script>";
}?>


<?php $conn->close();?>


<div id="modal" class="modal fade" 
     tabindex="-1" role="dialog" aria-labelledby="plan-info" aria-hidden="true">
    <div class="modal-dialog modal-full-screen">
        <div class="modal-content">
            <div class="modal-header">               
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="ttt">Upload your picture here</h4>
            </div>
            <div class="modal-body">
                <center class="loader m-x-auto"> </center>
            </div>
        </div>
    </div>
</div>