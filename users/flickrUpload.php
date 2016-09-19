<?php
    require_once 'init.php'; 
    require_once '../supplyment/dbAccess.php';
    require_once '../phpFlick/phpFlickr.php';
    unset($_SESSION['phpFlickr_auth_token']);
    $api_key                 = "9c7e15fd3e006075c3647c94ee891bd8";
    $api_secret              = "59cd2bc5e832fe79";
    $f = new phpFlickr($api_key, $api_secret);

    $error=0;
    if($_POST){
        if(!$_POST['name'] || !$_FILES["file"]["name"]){
            $error=1;
        }else{
            if ($_FILES["file"]["error"] > 0){
                echo "Error: " . $_FILES["file"]["error"] . "<br />";
            }else if($_FILES["file"]["type"] != "image/jpg" && $_FILES["file"]["type"] != "image/jpeg" && $_FILES["file"]["type"] != "image/png" && $_FILES["file"]["type"] != "image/gif"){
                $error = 3;
            }else if(intval($_FILES["file"]["size"]) > 525000){
                $error = 4;
            }else{
                $dir= dirname($_FILES["file"]["tmp_name"]);
                $newpath=$dir."/".$_FILES["file"]["name"];
                rename($_FILES["file"]["tmp_name"],$newpath);
                //Instantiate phpFlickr
                $query2 = "select authToken from LinkUser where usersID=10";
                $result2=$conn->query($query2);
                $row2 = mysqli_fetch_array($result2);
                $f->setToken($row2[authToken]);
                $f->auth("write");
                $status = $f->async_upload($newpath, $_POST["name"]);
                if(!$status) {
                    $error = 2;
                }
             }
         }
    }
?>

<body>
    <div class="container">
        <h1>Photo Uploader Using Flickr</h1>
    <?php

    if (isset($_POST['name']) && $error==0) {
        echo "  <h2>Your file has been uploaded to $status</a></h2>";
    }else {
        if($error == 1){
            echo "  <font color='red'>Please provide both name and a file</font>";
        }else if($error == 2) {
            echo "  <font color='red'> $status Unable to upload your photo, please try again</font>";
        }else if($error == 3){
            echo "  <font color='red'>Please upload JPG, JPEG, PNG or GIF image ONLY</font>";
        }else if($error == 4){
            echo "  <font color='red'>Image size greater than 512KB, Please upload an image under 512KB</font>";
        }
    ?>
        <h2>Upload your Pic!</h2>
        <form  method="post" accept-charset="utf-8" enctype='multipart/form-data'>
            <p>Name: &nbsp; <input type="text" name="name" value="" ></p>
            <p>Picture: <input type="file" name="file"/></p>
            <p><input type="submit" value="Submit"></p>
        </form>
    <?php
    }
    ?>
    </div>
 </body>