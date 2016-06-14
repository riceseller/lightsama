<!DOCTYPE html>
<html>
    <navheader>
        <style>
            .topNav{
                justify-content: space-around;
                width: 100%;
                height: 50px;
                align-items: center;
                background: black;
                font-family: Circular, Georgia, Helvetica, Arial;
                display: -webkit-flex;
                display: flex;
            }
            a.nav{
                color: white;
            }
            .logo{
                order: 2;
                width: 15%;
                /*background: #9F9386;*/
                max-width: 150px;
                text-align: center;
                vertical-align: middle;
            }
            .navButton {
                order: 4;
                width:25%;
                max-width: 250px;
                /*background: coral;*/
                text-align: center;
                vertical-align: middle;
            }
            #leftSpace{
                align-self: flex-start;
                width: 100px;
                height: 70px;
                /*background: darkturquoise;*/
            }
            #centerSpace{
                order: 3;
                width: 50%;
                flex-grow: 2;
                height: 70px;
                /*background: darkturquoise;*/
            }
            #rightSpace{
                order:5;
                width: 100px;
                height: 70px;
                /*background: darkturquoise;*/
            }
            .body{
                margin: 0;
                padding: 0;
                display: flex;
                flex-direction: column;
            }
            
        </style>
    </navheader>
    <body>
        <div class="topNav">
            <div id="leftSpace"></div>
            <div class="navButton">
                <a class="nav" href="gpsLocSearch.php">Location Search</a>
                <a  class="nav" href="camelensSearch.php">Camera Search</a>
            </div>
            <div id="centerSpace"></div>
            <div class="logo">
                <a  class="nav" href="http://db.luokerenz.com">PHOTOLIB</a>
            </div>
            <div id="rightSpace"></div>
        </div>
        <br>