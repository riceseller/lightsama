<?php
    require_once 'users/init.php';
?>

<!DOCTYPE html>

<html>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <navheader>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../proxima-nova.css">
        <link rel="stylesheet" type="text/css" href="users/css/topNav.css" />
    </navheader>
    
        <topNav>
            <div class="navButton">
                <a class="nav" href="<?=$us_url_root?>explore.php" >Explore</a>
            </div>
                        
            <div class="logo">
                <a  class="nav" href="http://hailoinn.luokerenz.com" >HAILOINN</a>
            </div>
            
            <div id='search'>
                <form id='searchBox' action="../keyword.php" method="get">
                    <?php if(empty($_GET['search'])){$sHolder="Search";}else{$sHolder=$_GET['search'];}?>
                    <input type="text" name="search" id="search_text" placeholder=<?php print "\"".$sHolder."\"";?>/>
                    <input type="button" name="search_button" id="search_button"></a>
                </form>
            </div>
            
            <div class="user">
                <?php
                if($user->isLoggedIn())
                {
                    echo "<a class='nav' href='../users/account.php' style='text-decoration:None' >WELCOME " .$user->data()->fname." <br></a>";
                ?>
                    <a class="nav" href="<?=$us_url_root?>users/logout.php">LOGOUT</a>;  
                <?php
                }
                else
                {
                    ?>
                    <a class="nav" href="<?=$us_url_root?>users/new_login.php?category=login">LOGIN<br></a> 
                    <a class="nav" href="<?=$us_url_root?>users/new_login.php?category=signup">SIGNUP</a>
                    <?php 
                }                
                ?>
            </div>
        </topNav>