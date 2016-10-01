<?php
require_once "users/init.php";
require_once "newNavBar.php";
require_once "supplyment/dbAccess.php";

$query = "SELECT * FROM DbStatic;";
$result=$conn->query($query);
$xAxis[] = 'x';
$oCommon[] = 'Common';
$oProcessed[] = 'Processed';
$oCoordinate[] = 'Coordinate';
$oLocation[] = 'Location';
$oTag[] = 'Tag';
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $xAxis[] = $row["time"];
        $oCommon[] = intval($row["Common"]);
        $oProcessed[] = intval($row["Processed"]);
        $oCoordinate[] = intval($row["Coordinate"]);
        $oLocation[] = intval($row["Location"]);
        $oTag[] = intval($row["Tag"]);
    }
} else {
    echo "0 results";
}
$conn->close();
?>

<div id="chart"></div>

<customHeader>
    <style>
        #chart{
            height: calc(100vh - 50px);
            width: 100%;
        }
    </style>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.10/c3.min.css" rel="stylesheet" />   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.10/c3.min.js"></script>
    
    <script type="text/javascript">
        var chart = c3.generate({
            bindto: '#chart',
            data: {
                x: 'x',
                xFormat: '%Y_%m_%d_%H',
                columns: [
                    <?php echo json_encode($xAxis);?>,
                    <?php echo json_encode($oCommon);?>,
                    <?php echo json_encode($oProcessed);?>,
                    <?php echo json_encode($oCoordinate);?>,
                    <?php echo json_encode($oLocation);?>,
                    <?php echo json_encode($oTag);?>
                ]
            },
            axis: {
                x: {
                    type: 'timeseries',
                    tick: {
                        format: '%Y-%m-%d-%H'
                    }
                }
            },
            zoom: {
                enabled: true
            },
            points: {
                show: false
            }
        });
    </script>
        
</customHeader>

<?php include 'footer2.php';?>
</body>
</html>