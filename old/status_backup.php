<?php
include('topNav.php');
include('supplyment/dbAccess.php');

if(isset($_GET['interval'])) {
    // id index exists
    $interval = $_GET["interval"];
}else{
    $interval = 1;
}
$conn->query("SET @x := 0;");
$query = "SELECT * FROM (SELECT (@x:=@x+1) AS x, mt.* FROM DbStatic mt ) t "
        . "WHERE x MOD $interval = 0;";
#echo $query;
$result=$conn->query($query);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        #echo "time: " . $row["time"]. " - Common: " . $row["Common"]. " - Processed " . $row["Processed"]. "<br>";
        $out[] = array($row["time"],intval($row["Common"]),intval($row["Processed"]),intval($row["Coordinate"]),intval($row["Location"]),intval($row["Tag"]));
    }
} else {
    echo "0 results";
}
$conn->close();

?>
<head>
<style>
    #chart_div{
        height: 90vh;
        width: 100%;
    }
</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawTrendlines);

function drawTrendlines() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Time');
      data.addColumn('number', 'Common');
      data.addColumn('number', 'Processed');
      data.addColumn('number', 'Coordinate');
      data.addColumn('number', 'Location');
      data.addColumn('number', 'Tag');

      data.addRows(<?php echo json_encode( $out ) ?>
      );

      var options = {
        hAxis: {
          title: 'Database Statistics'
        },
        vAxis: {
          title: 'Number'
        },
        colors: ['#AB0D06', '#007329', '#40FF00', '#2E2EFE', '#FE2EC8'],
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
</script>
</head>
<a>use "?interval=" to adjust time interval</a>
<div id="chart_div"></div>

</body>
</html>