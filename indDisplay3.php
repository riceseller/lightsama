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


    <div class="modal-header">               
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        <h4 class="modal-title" id="picTitle" style="text-align:center;"><p><?php echo $row[title];?></p></h4>
    </div>
    <div class="container-fluid">
        <div class="col-md-9 picDisplay">
            <img class="img-fluid" src="<?php echo $url; ?>" />
        </div>
        <div class="col-md-3">
            <div class="row" id="userInfo">
                <div class="col-md-4" id="userInfoPic">
                    <img class="img-fluid" style="<?php
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
                </div>
                <div class="col-md-8">
                    <div class="row" id="userNameD">
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
                    <div class="row" id="takenTime">
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
            </div>
            <div class="row picViewerInfo">
                <div class="col-md-4">
                    <p><?php echo $view;?><br><?php if($view=='1'){echo "view";} else{echo "views";}?></p>
                </div>
                <div class="col-md-4">
                    <p id="favIncrement"><?php echo $current_fav;?><br>favorites</p>
                </div>
                <div class="col-md-4">
                    <?php echo "<p>".$comment_count."<br>";?>
                    <?php if($comment_count==1 || $comment_count==0){echo "comment</p>";} else {echo "comments</p>";}?>
                </div>
            </div>
            <div class="row commentDisplay">
                <p>this is a whole portion that puts comments as ul lists including comment submission and comment sync button</p>
            </div>           
            <div class="row exifFirstLine">
                <div class="col-md-6">
                    <img class="img-fluid" src="/media/camera.png" height="97px" width="98px">
                </div>
                <div class="col-md-6" id="cameraType">
                    <?php
                            if($row[model]==None)
                            {
                                echo "<p>no camera info</br>";
                            }
                            else
                            {
                                echo "<p>".$row[model]." </br>";                                
                            }
                            if($row[lens]==None)
                            {
                                echo "no lens info</p>";
                            }
                            else
                            {
                                echo " ".$row[lens]." </p>";
                            }
                    ?>
                </div>
            </div>
            <div class="row exifSecondLine">
                <div class="col-md-6">
                    <div class="col-md-6">
                        <img class="img-fluid" src="/media/aperture.png" height="22" width="22">
                    </div>
                    <div class="col-md-6">
                        <?php
                            if($row[aperture]==None)
                            {
                                echo "<p style=\"font-size: 13px; padding-top: 5px;\"> f/ - </p>";
                            }
                            else
                            {
                                echo "<p style=\"font-size: 13px; padding-top: 5px;\"> f/".$row[aperture]." </p>";                                    
                            }
                        ?>
                    </div>                   
                </div>
                <div class="col-md-6">
                    <div class="col-md-6">
                        <img class="img-fluid" src="/media/exposure.png" height="22" width="22">
                    </div>
                    <div class="col-md-6">
                        <?php
                                if($row[exposure]==None)
                                {
                                    echo "<p style=\"font-size: 13px; padding-top: 5px;\"> - </p>";
                                }
                                else
                                {
                                    echo "<p style=\"font-size: 13px; padding-top: 5px;\"> ".$row[exposure]." </p>";
                                }
                            ?>
                    </div>
                </div>
            </div>
            <div class="row exifThirdLine">
                <div class="col-md-6">
                    <div class="col-md-6">
                        <img class="img-fluid" src="/media/focal.png" height="22" width="22">
                    </div>
                    <div class="col-md-6">
                        <?php
                                if($row[focal]==None or $row[focal]<=0)
                                {
                                    echo "<p style=\"font-size: 13px; padding-top: 5px;\"> - mm </p>";
                                }
                                else
                                {
                                    echo "<p style=\"font-size: 13px; padding-top: 5px;\"> ".$row[focal]." mm </p>";
                                }
                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-6">
                        <img class="img-fluid" src="/media/iso.png" height="22" width="22">
                    </div>
                    <div class="col-md-6">
                        <?php
                                if($row[iso_speed]==None or $row[iso_speed]<=0)
                                {
                                    echo "<p style=\"font-size: 13px; padding-top: 5px;\"> - </p>";
                                }
                                else
                                {
                                    echo "<p style=\"font-size: 13px; padding-top: 5px;\"> ".$row[iso_speed]." </p>";
                                }
                        ?>
                    </div>
                </div>
            </div>           
        </div>
    </div>

