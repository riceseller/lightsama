<?php
    include "topNav.php";
?>

<head lang="en">
        <style>
            .ind{              
                 display: -webkit-flex;
                 display: flex;
                 -webkit-justify-content: flex-start;
                 justify-content: flex-start;
             
                }
            #topSpace{
                order: 1;
                height: 2.5em;
                flex-shrink: 1;
                }
            #Aind{
                order: 2;
                flex-shrink: 0;
                }
            #Aitem{
                order: 2;
                flex-shrink:0;
                }
            .exif{
                order:3;
                flex-shrink: 0;
                flex-grow: 1;
                 }
            .other{
                order:4;
                flex-shrink: 0;
                 }
        </style>
</head>

<div class="ind">
    <div id="topSpace"></div>
<div id="Aind">
<?php
        //header('Content-type: image/jpeg;');
        $pid = $_GET["pid"];  //pid get from toolbar
        //$pid = "25874137636";
	include("supplyment/dbAccess.php");
	$query = "select url from Url where id='$pid'";
        //echo $query;
	$result=$conn->query($query);
        $row = mysqli_fetch_array($result);
        echo "<img src='".$row['url']."' width='800' height='600'/><br />";    
        //pull out image information for displaying
        
?>
</div> 
    
    
<?php
        include "exif.php";
        //include "similiarPic.php";
	$conn->close(); 
?>
    
</div>

</body>
</html>
