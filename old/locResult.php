<?php
    include "topNav.php";
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="node_modules/jquery-lazyload/jquery.lazyload.js"></script>
<script>
    $(function() {
        $("img.lazy").lazyload(
                {effect : "fadeIn"});
    });
</script>
<style>
    .table{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width:100%;
    }
    #topSpace{
        order: 1;
        height: 2.5em;
        flex-shrink: 1;
    }
    #Atable{
        order: 2;
        flex-shrink: 0;
        /*background: #9F9386;*/
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }
    center{
        width: 100%;
    }
    img.lazy{
        width:  100%;
        height: 300px;
        margin: auto;
    }
    .lazy{
        object-fit: cover;
    }
</style>
<div class="table">
    <div id="topSpace"></div>
    <div id="Atable">
<?php
    $inputStr = $_GET["loc"];
    include "supplyment/dbAccess.php";
    
    $regex = "/^(?<long>-?[0-9]+)(?<longD>\.[0-9]+){0,1},(?<la>-?[0-9]+)(?<laD>\.[0-9]+){0,1}$/";
    $regexK = "/^[  a-zA-Z]+/";
    $searchStr = " ";
    //var_dump($inputStr);
    $loc = "none";
    
    if(preg_match($regex, $inputStr)){
        //gps mode
        $loc = "gps";
        preg_match($regex, $inputStr, $searchStr);
        //echo nl2br ("gps mode \n");
        $longitude = (float)($searchStr[long] + $searchStr[longD]);
        $latitude = (float)($searchStr[la] + $searchStr[laD]);
        //echo "longitude: ";
        //echo $longitude;
        //echo "latitude: ";
        //echo $latitude;
        //echo nl2br("\n");   
        $lower_long = $searchStr[long]-1;
        $upper_long = $searchStr[long]+1;
        $lower_la = $searchStr[la]-1;
        $upper_la = $searchStr[la]+1;
        $d2r = 0.0174532925199433;
        
        $sql="SELECT u.id, u.url, c.longitude, c.latitude,
          atan2(sqrt(pow(sin((($latitude-c.latitude)*$d2r)),2)+cos(c.latitude*$d2r)
          *cos($latitude*$d2r)*pow(sin((($longitude-c.longitude)*$d2r)/2),2)),
          sqrt(1-pow(sin((($latitude-c.latitude)*$d2r)),2)-cos(c.latitude*$d2r)
          *cos($latitude*$d2r)*pow(sin((($longitude-c.longitude)*$d2r)/2),2)))
          as distance
          FROM Coordinate c JOIN CoordinateCorrespondance co ON c.id=co.coeid
          JOIN Url u ON co.pid=u.id
          WHERE (c.longitude between $lower_long and $upper_long) 
          AND (c.latitude between $lower_la and $upper_la)
          ORDER BY distance";
        //echo $sql;
        /*
        #define d2r (M_PI / 180.0)
        //calculate haversine distance for linear distance
        double haversine_km(double lat1, double long1, double lat2, double long2)
        {
            double dlong = (long2 - long1) * d2r;
            double dlat = (lat2 - lat1) * d2r;
            double a = pow(sin(dlat/2.0), 2) + 
        cos(lat1*d2r) * cos(lat2*d2r) * pow(sin(dlong/2.0), 2);
            double c = 2 * atan2(sqrt(a), sqrt(1-a));
            double d = 6367 * c;

            return d;
        }
        */
    }
    else{
        //location keyword mode
        $loc = "key";
        //echo "loc keyword mode ";
        preg_match($regexK, $inputStr, $searchStr);
        $searchStr = implode($searchStr);
        //echo $searchStr;
        $sql = "SELECT u.url, u.id FROM Url u JOIN LocationCorrespondance lo ON u.id=lo.pid "
                . "JOIN Location l ON l.id=lo.locid "
                . "WHERE (l.country_location LIKE '%".$searchStr."%') "
                . "OR (l.county_location LIKE '%".$searchStr."%') "
                . "OR (l.region_location LIKE '%".$searchStr."%') ";
        //echo $sql;
    }
    //echo $sql;  
    //echo nl2br("\n");
    $result=$conn->query($sql);  
    //var_dump($result);
    if($result->num_rows>0)
    {
        echo "<center>Search result for ".$inputStr."</center>";
        echo "<br></br>";
        //echo "<br></br>";
        switch($loc){
            case "gps":
                echo "<table border='1'>
                <tr>
                <th>photo</th>
                <th>longitude</th>
                <th>latitude</th>
                <th>distance</th>
                </tr>";
                break;
            case "key":
                break;
            case "none":
                break;
        }
            //output 
            while($row=$result->fetch_assoc()) {
                    switch($loc){
                        case "gps":
                            echo "<tr>";
                            echo "<td><a href=\"/indDisplay.php?pid=".$row[id]."\"><img src=".$row[url]."></a></td>";
                            echo "<td>" . $row[longitude] . "</td>"; 
                            echo "<td>" . $row[latitude] . "</td>";
                            echo "<td>" . $row[distance] . "</td>";
                            echo "</tr>";
                            break;
                        case "key":
                            echo "<a style=\"text decoration: none\" "
                            . "href=\"indDisplay.php?pid=".$row[id]."\">"
                            ."<img class=\"lazy\" data-original= ".$row[url].""
                            . "> "   
                            ."</a>";
                            break;
                        case "none":
                            break;
                        }
            }
            if($loc=="gps"){echo "</table>";}
    }
    else 
    {
            echo "nothing in the db";
    }
    $loc = "none";
?>
    </div>
</div>
</body>
</html>