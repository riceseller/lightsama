<!DOCTYPE html>
<html lang="en">
    
<?php 
    error_reporting(0);
    
    include("topNavBackUp.php");
    include "supplyment/dbAccess.php";
    if(isset($_GET['page'])) {
    // id index exists
    $page = $_GET["page"];
    }else{
        $page = 1;
    }
?>
    
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
    .container{
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
    }
</style>    

<script src="/node_modules/jquery.min.js"></script>
<script src="/node_modules/jquery.collagePlus.js"></script>
<script src="/node_modules/jquery.removeWhitespace.js"></script>

<script>
// All images need to be loaded for this plugin to work so
    $(document).ready(function(){
            collage();
            //$('.Collage').collageCaption();
    });
    // Here we apply the actual CollagePlus plugin
    function collage() {
        $('.Collage').removeWhitespace().collagePlus(
            {
                'fadeSpeed'     : 1000,
                'targetHeight'  : 400,
                'allowPartialLastRow' : true
            }
        );
    };
</script>

<script>
    function ChangeContent(iden){
        if(iden==='nature'){
           document.getElementById('nature').style.display="block";
           document.getElementById('linature').className="active";
           
           document.getElementById('culture').style.display="none";
           document.getElementById('liculture').className="";
           
           document.getElementById('bodyart').style.display="none";
           document.getElementById('liart').className="";
        }
        else if(iden==='bodyart'){
           document.getElementById('nature').style.display="none";
           document.getElementById('linature').className="";
           
           document.getElementById('culture').style.display="none";
           document.getElementById('liculture').className="";
           
           document.getElementById('bodyart').style.display="block";
           document.getElementById('liart').className="active";
        }
        else if(iden==='culture'){
           document.getElementById('nature').style.display="none";
           document.getElementById('linature').className="";
           
           document.getElementById('culture').style.display="block";
           document.getElementById('liculture').className="active";
           
           document.getElementById('bodyart').style.display="none";
           document.getElementById('liart').className="";
        }
    }
</script>
    
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>PHOTOLIB</title>
</head>



<body>
    <div class="jumbotron">
        <h1>Link Your Flickr To The Outside World</h1>
        <p><a class="btn btn-primary btn-lg" href="<?=$us_url_root?>users/new_login.php?category=login" role="button">Get Started</a></p>
    </div>
    
    <div class="container">
        <h2>an indexing of high quality images</h2>
        <p>All images are scrapped from Flickr, 500px and Pixabay. You may connect your Flickr account
    to exchange resources with other sites. We make it faster</p>
    </div>
</body>
    
    
    
    
</html>

