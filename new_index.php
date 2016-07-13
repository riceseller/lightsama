<?php 
    include 'topNavBackUp.php';
?>
<link rel="stylesheet" type="text/css" href="users/css/indDisplay.css" />
<style>
    welcome{
        display: -webkit-flex; /* Safari */
        display: flex;
        flex-direction: column;
        width: 100%;
        background-image: url("welcome.png"); 
        background-size: contain;
        height: calc(120vh - 50px);
        order: 1;
    }
    welcome h1{
        display: block;
        -webkit-margin-start: 0px;
        -webkit-margin-end: 0px;
        -webkit-margin-before: 1.83em;
        -webkit-margin-after: 0.83em;
        color: white;
        font-size: 45px;
        top: 25vh;
        order: 1;
        text-align: center;
    }
    h1 .slogan{
        max-width: 100%;
        margin: 0;
        line-height: 1;
        text-align: center;       
    }
    .hvr-fade{
        display:inline-block;
        vertical-align:middle;
        text-align: center;
        -webkit-transform:translateZ(0);
        transform:translateZ(0);
        box-shadow:0 0 1px rgba(0,0,0,0);
        -webkit-backface-visibility:hidden;
        backface-visibility:hidden;
        -moz-osx-font-smoothing:grayscale;
        overflow:hidden;
        -webkit-transition-duration:.3s;
        transition-duration:.3s;
        -webkit-transition-property:color,background-color;
        transition-property:color,background-color;
        order: 2;
        top: 10vh;
    }
    .hvr-fade:active,.hvr-fade:focus,.hvr-fade:hover{
        background-color:#2098d1;color:#fff}@-webkit-keyframes
</style>

<body>
    
<welcome>
    <h1 class="slogan">Link your Flickr To the Outside World</h1> 
</welcome>

<section class="Collage effect-parent">
    
</section>
       
<?php
    require_once "footer.php";
?>
</body>







</html>