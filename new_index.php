<?php 
    include 'topNav2.php';
?>
<link rel="stylesheet" type="text/css" href="users/css/new_index.css" />
<link rel="stylesheet" type="text/css" href="users/css/indDisplay.css" />

<body>
    
<welcome>
    <h1>Link Your Flickr To the Outside World</h1> 
    <a href="<?=$us_url_root?>users/new_login.php?category=login">get started</a>
</welcome>

<introduction>
    <h2>an indexing of high quality images</h2>
    <p>All images are scrapped from Flickr, 500px and Pixabay. You may connect your Flickr account
    to exchange resources with other sites. We make it faster</p>
</introduction>

<section class="Collage effect-parent">
    
</section>
       
<?php
    require_once "footer.php";
?>
</body>







</html>