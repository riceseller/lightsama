<?php 
    include 'topNav2.php';
?>
<link rel="stylesheet" type="text/css" href="users/css/indDisplay.css" />
<style>
    welcome{
        display: -webkit-flex; /* Safari */
        display: flex;
        flex-direction: column;
        width: 100%;
        background-image: url("https://s1.tuchong.com/welcome-image/small/27091117.jpg"); 
        background-size: cover;
        height: calc(100vh);
        order: 1;
        vertical-align: center;
    }
    welcome h1{
        display: block;
        -webkit-margin-start: 0px;
        -webkit-margin-end: 0px;
        -webkit-margin-before: 1.83em;
        -webkit-margin-after: 0.83em;
        color: white;
        font-size: 45px;
        margin-top: 23vh;
        order: 1;
        text-align: center;
    }
    
    welcome a{
        width: 15%;
        display: block;
        margin-top: 5vh;
        order: 2;
        text-align:center;
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #7892c2), color-stop(1, #476e9e));
	background:-moz-linear-gradient(top, #7892c2 5%, #476e9e 100%);
	background:-webkit-linear-gradient(top, #7892c2 5%, #476e9e 100%);
	background:-o-linear-gradient(top, #7892c2 5%, #476e9e 100%);
	background:-ms-linear-gradient(top, #7892c2 5%, #476e9e 100%);
	background:linear-gradient(to bottom, #7892c2 5%, #476e9e 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#7892c2', endColorstr='#476e9e',GradientType=0);
	background-color:#7892c2;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	border-radius:5px;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:20px;
	padding:10px 10px;
	text-decoration:none;
	text-shadow:2px 0px 27px #283966;
        -webkit-margin-start: 40%;
        -webkit-margin-end: auto;
        -webkit-margin-before: 1.83em;
        -webkit-margin-after: 0.83em;
    }
    welcome a:hover {
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #476e9e), color-stop(1, #7892c2));
        background:-moz-linear-gradient(top, #476e9e 5%, #7892c2 100%);
	background:-webkit-linear-gradient(top, #476e9e 5%, #7892c2 100%);
	background:-o-linear-gradient(top, #476e9e 5%, #7892c2 100%);
	background:-ms-linear-gradient(top, #476e9e 5%, #7892c2 100%);
	background:linear-gradient(to bottom, #476e9e 5%, #7892c2 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#476e9e', endColorstr='#7892c2',GradientType=0);
	background-color:#476e9e;
}
    welcome a:active {
	position:relative;
	top:1px;
}

</style>

<body>
    
<welcome>
    <h1>Link your Flickr To the Outside World</h1> 
    <a href="<?=$us_url_root?>users/new_login.php?category=login">get started</a>
</welcome>

<section class="Collage effect-parent">
    
</section>
       
<?php
    require_once "footer.php";
?>
</body>







</html>