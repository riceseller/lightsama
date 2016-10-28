<?php 
    error_reporting(0);  
    include "../newNavBar.php";
    include "../supplyment/dbAccess.php";
    if(isset($_GET['page'])) {
    // id index exists
    $page = $_GET["page"];
    }else{
        $page = 1;
    }
?>
        <style>
            table {
                width:100%;
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
            .CamCard {
                background-color:#fefefe;
                margin: auto; 
                border: 1px solid #eee;
            }
            body{
                background-color: #fefefe;
            }
        </style>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="node_modules/jquery-lazyload/jquery.lazyload.js"></script>
        <?php
	$query = "SELECT rank, model, c.appearance 
                    FROM (      
                        SELECT c.model, c.appearance, (@rank := @rank+1) AS rank      
                            FROM (           
                                SELECT model, COUNT(model) appearance           
                                    FROM Common WHERE NOT(model='None') AND NOT(model='0')           
                                        GROUP BY model      
                                        )c, (SELECT @rank :=0) b      
                                        ORDER BY c.appearance DESC )c limit 5;";    //rank camera popularity
	$result=$conn->query($query);
        
        $queryt = "SELECT rank, lens, c.appearance FROM (      "
                . "    SELECT c.lens, c.appearance, (@rank := @rank+1) AS rank      "
                . "         FROM (           "
                . "             SELECT lens, COUNT(lens) appearance           "
                . "                FROM Common WHERE NOT(lens='0' OR lens=' ' OR lens='None')           "
                . "             GROUP BY lens      "
                . "              )c, (SELECT @rank :=0) b      "
                . "             ORDER BY c.appearance DESC )c limit 5;";    //rank lens popularity
	$resultt=$conn->query($queryt);
        ?>
        <div class="row CamCard">
            <div class="col-lg-3">
                <div class="card" style="text-align: center; border: none;">
                    <img class="card-img-top" style="margin-top: 25px; background-color: #fefefe;" src="https://farm6.staticflickr.com/5616/cameras/72157626544376501_model_large_69e7e5cfc6.jpg" alt="Card image cap">
                    <div class="card-block" style="background-color: #fefefe;">
                        <h4 class="card-title">Iphone</h4>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card" style="text-align: center; border: none;">
                    <img class="card-img-top" style="margin-top: 25px; background-color: #fefefe;" src="https://farm6.staticflickr.com/5616/cameras/72157626544376501_model_large_69e7e5cfc6.jpg" alt="Card image cap">
                    <div class="card-block" style="background-color: #fefefe;">
                        <h4 class="card-title">Iphone</h4>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card" style="text-align: center; border: none;">
                    <img class="card-img-top" style="margin-top: 25px; background-color: #fefefe;" src="https://farm6.staticflickr.com/5616/cameras/72157626544376501_model_large_69e7e5cfc6.jpg" alt="Card image cap">
                    <div class="card-block" style="background-color: #fefefe;">
                        <h4 class="card-title">Iphone</h4>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card" style="text-align: center; border: none;">
                    <img class="card-img-top" style="margin-top: 25px; background-color: #fefefe;" src="https://farm6.staticflickr.com/5616/cameras/72157626544376501_model_large_69e7e5cfc6.jpg" alt="Card image cap">
                    <div class="card-block" style="background-color: #fefefe;">
                        <h4 class="card-title">Iphone</h4>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>    
        
           <br>
           <br>
           <br>
           <br>
        <div class="row">
        <div class="col-md-6">
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
            }?>
        </div>
        <div class="col-md-6">
            <?php
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
        </div>
        </div>
    </body>
    <?php mysqli_close($conn); ?>
</html>