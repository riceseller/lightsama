<?php
header("Content-Type:text/html; charset=utf-8");
?>
<?php
    require_once 'users/init.php';
    require_once 'supplyment/dbAccess.php';
?>

<style>
            a{
                text-decoration: none;
                color: #212124;
            }
            a:hover{
                color: #006dac;
            }
            .topNav{
                justify-content: center;
                width: 100%;
                height: 50px;
                align-items: center;
                background: black;
                text-decoration: none;
                display: flex;
                z-index: 1000;
                position: fixed;
                top: 0;
                left: 0;
                font-weight: bold;
            } 
            a.nav{
                color: white; 
                font-family: "Proxima Nova", "Helvetica Neue", HelveticaNeue, Helvetica, 
                TeXGyreHeros, FreeSans, "Nimbus Sans L", "Liberation Sans", 
                Arial, sans-serif;
                text-decoration: underline;
            }
            a.nav:hover{
                color: white; 
            }
            .topNav .logo{
                width: 15%;
                /*background: #9F9386;*/
                max-width: 100px;
                text-align: center;
                vertical-align: middle;
                position: absolute;
                top: 13px;
                left: 40px;
            }
            .navButton {
                width:5%;
                max-width: 100px;
                /*background: coral;*/
                text-align: center;
                vertical-align: middle;
                position: absolute;
                top: 13px;
                left: 150px;
            }
            #search {
                width: 220px;
                margin: 1px;
                position: absolute;
                top: 7px;
                right: 250px;
            }
            #searchBox{
                border-radius: 2px;
            }
            #search_text{
                width: 183px;
                padding: 1px 0 1px 2px;
                font-size: 16px;
                border: 0 none;
                height: 34px;
                margin-right: 0;
                color: #78787a;
                outline: none;
                background: #d0d0d1;
                float: left;
                box-sizing: border-box;
                border-top-left-radius: 2px;
                border-bottom-left-radius: 2px;
                transition: all 0.15s;
            }
            ::-webkit-input-placeholder { /* WebKit browsers */
                color: #78787a;
            }
            :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
                color: #78787a;
            }
            ::-moz-placeholder { /* Mozilla Firefox 19+ */
                color: #78787a;
            }
            :-ms-input-placeholder { /* Internet Explorer 10+ */
                color: #78787a;
            }
            #search_text:focus {
                background: #ffffff;
            }
            #search_button {
                border: 0 none;
                background: #d0d0d1 url(../media/search.png) center no-repeat;
                width: 29px;
                float: left;
                padding: 0;
                text-align: center;
                height: 34px;
                cursor: pointer;
                border-top-right-radius: 2px;
                border-bottom-right-radius: 2px;
            }
            .button2{
                position: absolute;
                top: 12px;
                right: 455px; 
                width: 20px;
                height: 25px;
                overflow: hidden;
                -webkit-appearance: initial;
                background-color: initial;
                padding: initial;
                border: initial;
            }
            .user{
                max-width: 270px;
                text-align: center;
                vertical-align: middle;
                position: absolute;
                top: 8px;
                right: 100px;
            }
            .topNav .fa{               
                display:inline-block;
                font:normal normal normal 14px/1 FontAwesome;
                font-size:inherit;
                -webkit-font-smoothing:antialiased;
                -moz-osx-font-smoothing:grayscale
            }
            .topNav .i-no{ 
                position: absolute;
                top: 15px;
                right: 20px;
                color: #fff;                 
            }
            .topNav .i-yes{ 
                position: absolute;
                top: 15px;
                right: 20px;
                color: #a6e22e;                 
            }
            .topNav i:hover{
                border-color: #0099e5;
                color: #0099e5;
            }
            .topNav .fa-bell:before{
                content:"\f0f3"
            }           
            body{
                position: relative;
                display: -webkit-flex;
                display: flex;
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 0;
                padding: 0;
                flex-direction: column;
                -webkit-justify-content: flex-start;
                justify-content: flex-start;
                width: 100%;
                font-family: "Proxima Nova", "Helvetica Neue", HelveticaNeue, Helvetica, TeXGyreHeros, FreeSans, "Nimbus Sans L", "Liberation Sans", Arial, sans-serif;
                -webkit-font-smoothing: antialiased;
                margin-top: 50px;
            } 
            .normalform{
                
            }
            .normalform .input{
                
            }
            @font-face{
                font-family:'FontAwesome';
                src:url('../../fonts/fontawesome-webfont.eot?v=4.2.0');
                src:url('../../fonts/fontawesome-webfont.eot?#iefix&v=4.2.0') format('embedded-opentype'),url('../../fonts/fontawesome-webfont.woff?v=4.2.0') format('woff'),url('../../fonts/fontawesome-webfont.ttf?v=4.2.0') format('truetype'),url('../../fonts/fontawesome-webfont.svg?v=4.2.0#fontawesomeregular') format('svg');font-weight:normal;font-style:normal}
</style>

<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <navheader>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" type="text/css" href="../proxima-nova.css">
    </navheader>
    
        <div class="topNav">
            <div class="navButton">
                <a class="nav" href="<?=$us_url_root?>explore.php" >Explore</a>
            </div>
                        
            <div class="logo">
                <a  class="nav" href="http://db.luokerenz.com" >HAILOINN</a>
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
            <?php
                if($user->isLoggedIn())
                {
            ?>
                    <i class="i-no fa fa-bell" style="font-size: 20px;"></i>
            <?php
                }
            ?>
        </div>