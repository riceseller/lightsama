<!DOCTYPE html>
<html>
    <navheader>
        <link rel="stylesheet" type="text/css" href="proxima-nova.css">
        <style>
            .topNav{
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
            .searchBar2{
                width:200px;
                height: 20px;
                flex-grow: 1;
                text-align: center;
                vertical-align: middle;
                justify-content: center;
                position: absolute;
                top: 11px;
                right: 170px; 
            }
            .button2{
                position: absolute;
                top: 12px;
                right: 355px; 
                width: 20px;
                height: 25px;
                overflow: hidden;
            }
            .user{
                max-width: 50px;
                text-align: center;
                vertical-align: middle;
                position: absolute;
                top: 8px;
                right: 70px;
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
        </style>
    </navheader>
    
    <body>
        <div class="topNav">
            
            <div class="navButton">
                <a class="nav" href="explore.php">Explore</a>
            </div>
                        
            <div class="logo">
                <a  class="nav" href="http://db.luokerenz.com">PHOTOLIB</a>
            </div>
            
                <form action="keyword.php" method="get" >
                    <input class="searchBar2" type="text" placeholder="keyword search" name="search">
                    <input type="image" src="/media/mag2.png" class="button2">
                </form>
            
            <div class="user">
                <a class="nav" href="fuckyou.php">LOGIN</a>
                <a class="nav" href="gpsLocSearch.php">SIGNUP</a>
            </div>
            
        </div>