<!DOCTYPE html>
<html lang="en">
    
<?php 
    error_reporting(0);
    
    include("newNavBar.php");
    include "supplyment/dbAccess.php";
    if(isset($_GET['page'])) {
    // id index exists
    $page = $_GET["page"];
    }else{
        $page = 1;
    }
?>
    
<script src="/node_modules/jquery.min.js"></script>
<script src="/node_modules/jquery.collagePlus.js"></script>
<script src="/node_modules/jquery.removeWhitespace.js"></script>

    <style>
        .jumbotron{
            background-image: url("https://s1.tuchong.com/welcome-image/small/27091117.jpg"); 
            background-size: cover;
            height: calc(80vh);
            order: 1;
        }
        .jumbotron h1{
            text-align: center;
            -webkit-margin-start: 0px;
            -webkit-margin-end: 0px;
            -webkit-margin-before: 1.83em;
            -webkit-margin-after: 0.83em;
            color: white !important;
            font-size: 45px !important;
            margin-top: 23vh;
            text-align: center;
        }
        .jumbotron p{
            text-align: center;
        }
        .container .first{
            order: 2;          
        }
        .container h2{
            text-align:center;
            color: #515457;
            font-size: 30px;
            margin-top: 5vh;
            order: 1;
        }
        .container p{
            text-align:center;
            color: #515457;
            font-size: 20px;
            order: 2;
            margin-top: 3vh;
        }
        .container .second{
            order: 3;            
        }
        .shield{
           display:flex;
           justify-content: center;
        }
        .shield .btn{
            margin:2px;
        }
    </style>
    <title>PHOTOLIB</title>
    
    <div class="jumbotron">
        <h1>Link Your Flickr To The Outside World</h1>
        <p><a class="btn btn-primary btn-lg" href="<?=$us_url_root?>users/new_login.php?category=login" role="button">Get Started</a></p>
    </div>
    
    <div class="container first">
        <h2>an indexing of high quality images</h2>
        <p>All images are scrapped from Flickr, 500px and Pixabay. You may connect your Flickr account
            to exchange resources with other sites. We make it faster<br><br><br></p>
    </div>
    
    <div class="container second">
        <div class="shield">
            <button type="button" class="btn btn-outline-primary">Landscape</button>
            <button type="button" class="btn btn-outline-secondary">Beauty</button>
            <button type="button" class="btn btn-outline-success">Skyscraper</button>
            <br><br>      
        </div>
    </div>
        
    
</body>

</html>