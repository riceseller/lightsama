<?php
    include "supplyment/dbAccess.php";
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
?>

    <div class="container-fluid" style="padding: 0;">
        <div class="col-xs-9">
            <div class="imgSpacer"></div>
        </div>
        <div class="col-xs-3 iconDisplay">
            <div class="row iconsShow">
                <div class="col-xs-3">
                    <a href="#"><i class="fa fa-heart" style="color: white;"></i></a>
                    <p class="iconDisplayText"><?php echo $current_fav;?></p>
                </div>
                <div class="col-xs-3">
                    <a href="#"><i class="fa fa-eye" style="color: white;"></i></a>
                    <p class="iconDisplayText"><?php echo $view;?></p>
                </div>
                <div class="col-xs-3">
                    <a href="#"><i class="fa fa-comments" style="color: white;"></i></a>
                    <p class="iconDisplayText"><?php echo $view;?></p>
                </div>
                <div class="col-xs-3">
                    <a href="#"><i class="fa fa-close" style="color: white;" data-dismiss="modal"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-9 imgDisplay">
            <img class="img-fluid" src="<?php echo $url; ?>" />
        </div>
        <div class="col-md-3 infoDisplay" style="background-color: #222222;">
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
        </div>
    </div>



