<!DOCTYPE html>
<html>
    <meta charset="UTF-8">
<?php
    require_once 'users/init.php';
    require_once 'supplyment/dbAccess.php';
?>

<header>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.3/css/bootstrap.min.css" integrity="sha384-MIwDKRSSImVFAZCVLtU0LMDdON6KVCrZHyVQQj6e8wIEJkW4tvwqXrbMIya1vriY" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.3/js/bootstrap.min.js" integrity="sha384-ux8v3A6CPtOTqOzMKiuo3d/DomGaaClxFYdCu2HPMBEkf6x2xiDyJ7gkXU0MWwaD" crossorigin="anonymous"></script>

<style>
    .navbar{
        height: 50px;
        border-radius: 0 !important;
    }
    body{
        background: #f3f5f6;
    }
    .nav{
        padding-left: 20px;
    }
    .form-control{
        max-width:50%;
        display: inline;
        margin-right: 5px;
    }
    form{
        display: inline;
    }
    .form-inline{
        display:flex;
        padding-left: 20px;
    }
    .navbar{
        padding: 6px 1rem;
        border-radius: 0;
    }
    a{
        text-decoration:none;
    }
    a:hover{
        text-decoration:none;
    }
    .loader {
        border: 0.34rem solid #f3f3f3; /* Light grey */
        border-top: 0.4rem solid #3498db; /* Blue */
        border-radius: 50%;
        width: 3rem;
        height: 3rem;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
</header>

<body>
      
<nav class="navbar navbar-dark bg-inverse" style="z-index: 99;">
    
  <a class="navbar-brand" href="db.luokerenz.com">PicShell</a>
  
  <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2" aria-controls="exCollapsingNavbar2" aria-expanded="false" aria-label="Toggle navigation">
    &#9776;
  </button>
  <div class="collapse navbar-toggleable-xs" id="exCollapsingNavbar2">
    <div class="bg-inverse"> 
    <ul class="nav navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="explore.php">Explore</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">MapView</a>
        </li>
        
            <?php
                if($user->isLoggedIn()){
                    echo "<li class=\"nav-item\">";
                    echo "<a class='nav-link' href='../users/account.php' style=\"color:#5cb85c;\">WELCOME ".$user->data()->fname."</a>";
                    echo "</li>"
           ?>
                    <li class="nav-item">
                    <a class="nav-link" href="<?=$us_url_root?>users/logout.php">LOGOUT</a>
                    </li>
            <?php
                }else{
            ?>
                    <li class="nav-item">
                    <a class="nav-link" style="color:#5cb85c;" href="<?=$us_url_root?>users/new_login.php?category=login">Login</a> 
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="<?=$us_url_root?>users/new_login.php?category=signup">Signup</a> 
                    </li>
            <?php 
                }    
            ?>  
        </li>
    </ul>
    <form class="form-inline" action="../keyword.php" method="get">
        <?php if(empty($_GET['search'])){$sHolder="Search";}else{$sHolder=$_GET['search'];}?>
        <input class="form-control" type="text" name="search" placeholder="<?=$sHolder?>">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    </div>
  </div>

</nav>

