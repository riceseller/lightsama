<?php
require_once "users/init.php";
require_once "newNavBar.php";
require_once "supplyment/dbAccess.php";
if(isset($_GET['page'])) {
    // get page number for location of the album list
    $page = $_GET["page"];
}else{
    $page = 1;
}
if(isset($_GET['id'])) {
    // id index exists
    $displayID = $_GET["id"];
}else{
    // head to temp page
    header('Location: explore.php');
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
    //get user sign up date
    $get_info_id = $user->data()->id;
    $raw = date_parse($user->data()->join_date);
    $signupdate = $raw['month']."/".$raw['day']."/".$raw['year'];
    //get user avatar
    $query11 = "select * from ScrapeUser where id=$displayID";
    $result11=$conn->query($query11);
    $row11 = mysqli_fetch_array($result11);
    if($row11[Ubelong]=='flickr'){
        $server = $row11[extraOne];
        $farm = $row11[extraTwo];
        $userr = $row11[userID];
        $gravMod = "https://c2.staticflickr.com/$farm/$server/buddyicons/".$userr.".jpg";
    }
    //get jumbo background img
    $query12 = "select u.url from Url u join Common c on u.id=c.p_id join ScrapeAlbum sa on c.albumBelong = sa.id where sa.scrapeUserID = $displayID order by rand() limit 1";
    $result12=$conn->query($query12);
    $row12 = mysqli_fetch_array($result12);
    $jumboBackground = $row12[url];
?>
<customheader>
    <style>
        .card-img{
            width:100%;
            height:auto;
        }
        .card-img-overlay{
            padding: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0) 0%,rgba(0,0,0,0) 83%,rgba(0,0,0,0.5) 100%,rgba(0,0,0,0.5) 100%);
        }
        .albumTool{
            display: inline;
            width:100%;
            bottom: 0;
            position: absolute;
            padding-left: 5%;
            padding-bottom: 2%;
        }
        .toolBut{
            color: #fff!important;
            font-size: 1.5rem;
        }
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
        .user-info{
            color: #fff;
        }
        .cusTitle{
            display: inline-flex;
            width: 70%;
            text-overflow: ellipsis;
            overflow: hidden;
        }
        .card-title a{
            color:#fff;
        }
    </style>
    <!--<link rel="stylesheet" href="../node_modules/jquery.modal.min.css" type="text/css" media="screen"/>
    <script src="../node_modules/jquery.modal.min.js" type="text/javascript" charset="utf-8"></script>-->
    <script>
        // load remote page via jquery
        $(document).on('click','#Gmodal',function(event) {
            event.preventDefault();
            var modal = $('#modal').modal();
            modal.find('.modal-body').load($(this).attr('href'), function () {
                    modal.show();
                });
        });
        // clear loaded dom page
        $(document).on('hidden.bs.modal', function (e) {
            var target = $(e.target);
            //console.log('clear via hidden.bs.modal');
            target.removeData('bs.modal').find(".modal-body").html('<p>Loading...</p>');
        });
        $(document).on('hide.bs.modal', function (e) {
            var target = $(e.target);
            //console.log('clear via hide.bs.modal');
            target.removeData('bs.modal').find(".modal-body").html('<p>Loading...</p>');
        });
    </script>
</customheader>

<div class="jumbotron jumbotron-fluid" style="background-image:url(<?=$jumboBackground;?>);background-size: cover;">
  <div class="container">
    <div id="userAvatar" style="background-image:url(<?=$gravMod;?>);"></div>
    <div class="user-info">
        <a id="user-name" style="font-size:36px;font-weight:700;"><?=ucfirst($user->data()->username)?></a><br>
        <a id="user-add" style="font-size:16px;font-weight:600;">Member Since: <?php echo $signupdate;?></a><br>
        <a style="font-size:16px;font-weight:600;">Number of Logins: <?=$user->data()->logins?></a>
    </div>
  </div>
</div>
<div class="container">
    <div class="card-columns">
        <?php
            $off = $page*50-50;
            $query7 =  "select id,title,belong,coverphoto from ScrapeAlbum where scrapeUserID=$displayID order by id desc limit 50 offset $off";
            $Pageurl = "/accAlbum.php?id=$displayID&";
            $totalPage = pageCount($query7);
            //echo $totalPage;
            $Presult=$conn->query($totalPage);
            $Prow = $Presult->fetch_assoc();
            $totalPageNum = floor($Prow['count(*)']/50)+1;
            //echo $totalPageNum;
            $result7=$conn->query($query7);
            if ($result7->num_rows > 0) {
            // output data of each row
            while($row7 = $result7->fetch_assoc()) {
                echo "<div class=\"card card-inverse\">";
                echo "<img class=\"card-img\" src=\"".$row7[coverphoto]."\" alt=\"Card image\">";
                echo "<div class=\"card-img-overlay\">";
                echo "<div class=\"container albumTool\">";
                echo "<h4 class=\"card-title cusTitle\">".$row7[title]."</h4>";
                echo "<h4 class=\"card-title pull-xs-right\"><a href=\"/users/albumModInfo.php?albumID=".$row7[id]."\" id=\"Gmodal\">&#9998</a></h4>";
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

<div id="modal" class="modal fade" 
     tabindex="-1" role="dialog" aria-labelledby="plan-info" aria-hidden="true">
    <div class="modal-dialog modal-full-screen">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
                <p>Loading ...</p>
            </div>
        </div>
    </div>
</div>

<?php mysqli_close($conn); ?>
<?php require_once 'footer.php'; ?>