<?php
    require_once 'init.php'; 
    require_once '../supplyment/dbAccess.php';
    require_once '../phpFlick/phpFlickr.php';
    if(isset($_POST['albumID']) && isset($_POST['Atitle']) && isset($_POST['Adescription']) && isset($_POST['flickr_albumID'])) {
        $albumID = $_POST['albumID'];
        $title = $_POST['Atitle'];
        $description = $_POST['Adescription'];
        $api_key                 = "9c7e15fd3e006075c3647c94ee891bd8";
        $api_secret              = "59cd2bc5e832fe79";
        $f = new phpFlickr($api_key, $api_secret);
        $query2 = "select lu.authToken,sa.albumID from ScrapeAlbum sa join LinkUser lu on sa.scrapeUserID=lu.scrapeUserID where sa.id=$albumID";
        $result2=$conn->query($query2);
        $row2 = mysqli_fetch_array($result2);
        $f->setToken($row2[authToken]);
        $f->auth("write");
        $f->photosets_editMeta($_POST['flickr_albumID'],$title,$description);
        echo '<script type="text/javascript">alert("flickr api executed");</script>';
        $query1 = "update ScrapeAlbum set title = $title, description = $description where id=$albumID";
        $result1=$conn->query($query1);
        echo '<script type="text/javascript">alert("database update executed");</script>';
    }else{
        echo '<script type="text/javascript">alert("error, not enough parameter");</script>';
    }
