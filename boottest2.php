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

<head>
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
            margin-bottom: 10vh;
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
        
        
        
        
        #custom-bootstrap-menu.navbar-default .navbar-brand {
            color: rgba(119, 119, 119, 1);
        }
        #custom-bootstrap-menu.navbar-default {
            font-size: 14px;
            background-color: rgba(248, 248, 248, 1);
            border-width: 1px;
            border-radius: 4px;
            order:3;
        }
        #custom-bootstrap-menu.navbar-default .navbar-nav>li>a {
            color: rgba(119, 119, 119, 1);
            background-color: rgba(248, 248, 248, 0);
        }
        #custom-bootstrap-menu.navbar-default .navbar-nav>li>a:hover,
        #custom-bootstrap-menu.navbar-default .navbar-nav>li>a:focus {
            color: rgba(51, 51, 51, 1);
            background-color: rgba(248, 248, 248, 0);
        }
        #custom-bootstrap-menu.navbar-default .navbar-nav>.active>a,
        #custom-bootstrap-menu.navbar-default .navbar-nav>.active>a:hover,
        #custom-bootstrap-menu.navbar-default .navbar-nav>.active>a:focus {
            color: rgba(85, 85, 85, 1);
            background-color: rgba(231, 231, 231, 1);
        }
        #custom-bootstrap-menu.navbar-default .navbar-toggle {
            border-color: #ddd;
        }
        #custom-bootstrap-menu.navbar-default .navbar-toggle:hover,
        #custom-bootstrap-menu.navbar-default .navbar-toggle:focus {
            background-color: #ddd;
        }
        #custom-bootstrap-menu.navbar-default .navbar-toggle .icon-bar {
            background-color: #888;
        }
        #custom-bootstrap-menu.navbar-default .navbar-toggle:hover .icon-bar,
        #custom-bootstrap-menu.navbar-default .navbar-toggle:focus .icon-bar {
            background-color: #888;
        }
        




        
    </style>
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
    
    <div id="custom-bootstrap-menu" class="navbar navbar-default " role="navigation">
    <div class="container-fluid">
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="/">Home</a>
                </li>
                <li><a href="/products">Products</a>
                </li>
                <li><a href="/about-us">About Us</a>
                </li>
                <li><a href="/contact">Contact Us</a>
                </li>
            </ul>
        </div>
    </div>
    </div>
    
    
    
    
</body>

</html>