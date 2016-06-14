<html>
    <header>
        <style>
            form {
                width:500px;
                margin-left:-200px;
                position: absolute;
                top:25%;
                left:50%;
                
            }
            .search {
                padding:8px 15px;
                width:400px;
                background:rgba(255, 255, 255, 1);
                border:5px solid #dbdbdb;
            }
            .button {
                position:relative;
                padding:6px 15px;
                left:-8px;
                border:2px solid #207cca;
                background-color:#207cca;
                color:#fafafa;
            }
            .button:hover  {
                background-color:#fafafa;
                color:#207cca;
            }
            p.logo {
                text-align: left;
            }
            p.navigation {
                text-align: right;
            }
            h1 {
                text-align: center;
            }
            explobody{
                position: absolute;
                left: 1%;
                right: 1%;
                text-align: center;
            }
            img.apple{
                display: flex;
                position: absolute;
                top: 0;
                left: 10px;
                
            }
            img.canon{
                position: absolute;
                top: 0;
                left: 160px;
                
            }
            img.samsung{
                position: absolute;
                top: 0;
                left: 330px;
                
            }
            img.nikon{
                position: absolute;
                top: 0;
                left: 500px;
               
            }
            img.sony{
                position: absolute;
                top: 0;
                left: 670px;
            }
            .lazy{
                object-fit: cover;
            }
            p.big{
                font-size: 150%;
                font-weight: bold;
                text-align: center;
            }
            p.small{
                font-size: 100%;
                font-weight: normal;
                text-align: center;
                margin-top: 0.5cm;
            }
            p.next{
                font-size: 100%;
                font-weight: normal;
                text-align: center;
                margin-top: 3cm;
             
            }
            div.big{
                position: relative;
                
            }
            div.small{
                position: relative;
                top: 10px;
            }
            div.box{
                position: relative;
                top: 20px;  
            }
            table {
                width:45%;
            }
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            th, td {
                padding: 5px;
                text-align: left;
            }
            table#t01 tr:nth-child(even) {
                background-color: #eee;
            }
            table#t01 tr:nth-child(odd) {
                background-color:#fff;
            }
            table#t01 th	{
                background-color: black;
                color: white;
            }
            
        </style>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="node_modules/jquery-lazyload/jquery.lazyload.js"></script>
        <?php
        include "supplyment/dbAccess.php";
	$query = "SELECT rank, model, c.appearance 
                    FROM (      
                        SELECT c.model, c.appearance, (@rank := @rank+1) AS rank      
                            FROM (           
                                SELECT model, COUNT(model) appearance           
                                    FROM Common WHERE NOT(model=' ')           
                                        GROUP BY model      
                                        )c, (SELECT @rank :=0) b      
                                        ORDER BY c.appearance DESC )c limit 5;";    //rank camera popularity
	$result=$conn->query($query);
        
        $queryt = "SELECT rank, lens, c.appearance FROM (      "
                . "    SELECT c.lens, c.appearance, (@rank := @rank+1) AS rank      "
                . "         FROM (           "
                . "             SELECT lens, COUNT(lens) appearance           "
                . "                FROM Common WHERE NOT(lens='0' OR lens=' ')           "
                . "             GROUP BY lens      "
                . "              )c, (SELECT @rank :=0) b      "
                . "             ORDER BY c.appearance DESC )c limit 5;";    //rank camera popularity
	$resultt=$conn->query($queryt);
        ?>
     
    </header>
    
<?php include 'topNav.php';?>
 
    <div class="big">
        <p class="big">CAMERA TYPE SEARCH</p>
    </div>
    
    <div class="small">
        <p class="small">choose a category and then click search</p>
    </div>
    
    <div class="box">
        <form action="CameraSearch.php" id="cameraSearch" method="get">
                        <input class=search type="text" placeholder="camera or keywords type in" required
                        id="searchBox" name="res2">
                        <input class=button type ="submit" value="search"
                        id="searchButton">
                        <select id="selectBox" name="mode">
                            <option value="Camera">Camera</option>
                            <option value="Lens">Lens</option>
                        </select>
                   </form>     
    </div>
    
    <p class="next"></p>
    
    <script>
        $(function() {
            $("img.lazy").lazyload(
                    {effect : "fadeIn"});
        });
    </script>
        <explobody>
          
            
            <br></br>
            <br></br>
            <br></br>
            <br></br>
            <?php
                if($result->num_rows>0)
                {
                    //echo "<center>popular camera rank as of now</center>";
                    echo "<table id=\"t01\" style=\"float: left;\">"
                    .    "<caption>Camera Model Top Rank</caption>"
                    .    "<tr>"
                            . "<th>rank</th>"
                            . "<th>model</th>"
                            . "<th>appearance</th>"
                       . "</tr>";
                    //outpupt
                    while($row=$result->fetch_assoc())
                    {
                        if(is_null($row[model]))
                        {
                            break;
                        }
                        echo "<tr>";
                        echo "<td>" .$row[rank]. "</td>";
                        if(ctype_space($row[model]))
                        {
                            echo "<td>model type unspecified</td>";
                        }
                        else
                        {
                            echo "<td>" .$row[model]. "</td>";
                        }
                        echo "<td>" .$row[appearance]. "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                
                if($resultt->num_rows>0)
                {
                    //echo "<center>popular camera rank as of now</center>";
                    echo "<table id=\"t01\" style=\"float: right;\">"
                    .    "<caption>Camera Lens Top Rank</caption>"
                    .    "<tr>"
                            . "<th>rank</th>"
                            . "<th>lens type</th>"
                            . "<th>appearance</th>"
                       . "</tr>";
                    //outpupt
                    while($rowt=$resultt->fetch_assoc())
                    {
                        echo "<tr>";
                        echo "<td>" .$rowt[rank]. "</td>";
                        if(isset($rowt[lens]))
                        {
                            echo "<td>" .$rowt[lens]. "</td>";
                        }
                        else
                        {
                            echo "null entry";
                        }
                        echo "<td>" .$rowt[appearance]. "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            ?>
        </explobody>
    
    </body>
    <?php
	$conn=close();
        ?>
</html>