<?php
    require_once 'init.php'; 
    require_once '../supplyment/dbAccess.php';
    require_once '../phpFlick/phpFlickr.php';
    
    if($user->isLoggedIn()){
        $useriid = $user->data()->id;
        unset($_SESSION['phpFlickr_auth_token']);
        $api_key                 = "9c7e15fd3e006075c3647c94ee891bd8";
        $api_secret              = "59cd2bc5e832fe79";
        $f = new phpFlickr($api_key, $api_secret);

        $error=0;
        if($_POST){
            if(!$_POST['description'] || !$_POST['name'] || !$_FILES["file"]["name"]){
                $error=1;
            }else{
                if ($_FILES["file"]["error"] > 0){
                    echo '<script type="text/javascript">alert("Post error occurs!");</script>';
                }else if($_FILES["file"]["type"] != "image/jpg" && $_FILES["file"]["type"] != "image/jpeg" && $_FILES["file"]["type"] != "image/png" && $_FILES["file"]["type"] != "image/gif"){
                    echo '<script type="text/javascript">alert("File format incorrect!");</script>';
                }else if(intval($_FILES["file"]["size"]) > 525000){
                    echo '<script type="text/javascript">alert("File size is over 512KB!");</script>';
                }else{
                    $dir= dirname($_FILES["file"]["tmp_name"]);
                    $newpath=$dir."/".$_FILES["file"]["name"];
                    rename($_FILES["file"]["tmp_name"],$newpath);
                    //Instantiate phpFlickr
                    $query2 = "select authToken from LinkUser where usersID=$useriid";
                    $result2=$conn->query($query2);
                    $row2 = mysqli_fetch_array($result2);
                    $f->setToken($row2[authToken]);
                    $f->auth("write");
                    if (isset($_POST['tags'])){$status = $f->sync_upload($newpath, $_POST["name"], $_POST['description'],$_POST['tags']);
                    }else{$status = $f->sync_upload($newpath, $_POST["name"], $_POST['description']);}
                    if(!$status) { echo '<script type="text/javascript">alert("Error occurs while uploading");</script>';;}
                    else{
                    $test = shell_exec("python /home/luokerenz/realtime/flickr_refresh_RT.py $status 2>&1");
                    //echo "<script type=\"text/javascript\">alert(\"Return: ".$test."\");</script>";}
                    echo "<script type=\"text/javascript\">alert(\"Upload successful!\");</script>";}
                 }
             }
        }
    }
?>

<body>
    <?php if($user->isLoggedIn()): ?>
    <div class="container">
        <h1>Photo Uploader Using Flickr</h1>
        <h2>Upload your Pic!</h2>
        <h2><?=$test?></h2>
        <form  method="post" accept-charset="utf-8" enctype='multipart/form-data'>
            <p>Name: &nbsp; <input type="text" name="name" value="" ></p>
            <p>Description: &nbsp; <input type="text" name="description" value="" ></p>
            <p>Tags seperated with space strictly: &nbsp; <input type="text" name="tags" value="" ></p>
            <p>Picture: <input type="file" name="file"/></p>
            <p><input type="submit" value="Submit"></p>
        </form>
    </div>
    <?php else : ?>
    
    <?php endif; ?>
</body>