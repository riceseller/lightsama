<?php
    require_once 'users/init.php';
?>

<!DOCTYPE html>

<html>
    
    <navheader>
        <link rel="stylesheet" type="text/css" href="proxima-nova.css">
        <style>
            topNav{
                justify-content: center;
                width: 100%;
                height: 50px;
                align-items: center;
                background: black;
                text-decoration: none;
                display: flex; 
            } 
            a.nav{
                color: white; 
            }
            .logo{
                width: 15%;
                /*background: #9F9386;*/
                max-width: 100px;
                text-align: center;
                vertical-align: middle;
                position: absolute;
                top: 13px;
                left: 80px;
            }
            .navButton {
                width:5%;
                max-width: 100px;
                /*background: coral;*/
                text-align: center;
                vertical-align: middle;
                position: absolute;
                top: 13px;
                left: 200px;
            }
            #searchBar2{
                width:200px;
                height: 20px;
                flex-grow: 1;
                text-align: center;
                vertical-align: middle;
                justify-content: center;
                position: absolute;
                top: 11px;
                right: 270px; 
            }
            .button2{
                position: absolute;
                top: 12px;
                right: 455px; 
                width: 20px;
                height: 25px;
                overflow: hidden;
            }
            .user{
                max-width: 270px;
                text-align: center;
                vertical-align: middle;
                position: absolute;
                top: 8px;
                right: 80px;
            }
            body{
                position: relative;
                display: -webkit-flex;
                display: flex;
                margin: 0;
                padding: 0;
                flex-direction: column;
                -webkit-justify-content: flex-start;
                justify-content: flex-start;
                width: 100%;
                height: 100%;
                font-family: "Proxima Nova", "Helvetica Neue", HelveticaNeue, Helvetica, TeXGyreHeros, FreeSans, "Nimbus Sans L", "Liberation Sans", Arial, sans-serif;
                text-rendering: optimizeLegibility;
                -webkit-font-smoothing: antialiased;
            } 
            .normalform{
                
            }
            .normalform .input{
                
            }
        </style>
    </navheader>
    
    <body>
        <topNav>
            
            <div class="navButton">
                <a class="nav" href="<?=$us_url_root?>explore.php" >Explore</a>
            </div>
                        
            <div class="logo">
                <a  class="nav" href="http://db.luokerenz.com" >PHOTOLIB</a>
            </div>
            
                <form class="normalform" action="keyword.php" method="get" >
                    <input id="searchBar2" type="text" placeholder="keyword search" name="search">
                    <input type="image" src="/media/mag2.png" class="button2">
                </form>
            
            <div class="user">
                <?php
                if($user->isLoggedIn())
                {
                    echo "<a class='nav' href='users/account.php' style='text-decoration:None' >WELCOME " .$user->data()->fname." <br></a>";
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