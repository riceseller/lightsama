<!DOCTYPE html>
<html>
    <header>
        <meta name="viewport" content="initial-scale=1.0">
        <meta charset="utf-8">
        <style>
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
            form {
                width:600px;
                margin-left:-200px;
                position: absolute;
                top:30%;
                left:50%;
                z-index: 1;
            }
            .search {
                padding:8px 15px;
                width:400px;
                background:rgba(255, 255, 255, 1);
                border:0px solid #dbdbdb;
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
            #map {
                height: 100%;
                z-index: 0;
            }
        </style>
    </header>
<?php include 'topNav.php';?>
        <form action="locResult.php" method="get">
            <input class=search type="text" placeholder="
                   Search for GPS coordinate (ex:34,45) or Location name
                   " required
                   id="searchBox" name="loc">
            <input class=button type ="submit" value="search"
                   id="searchButton">
        </form>
        <div id="map"></div>
        <?php
        include 'supplyment/dbAccess.php';
        $query="select longitude,latitude from Coordinate order by RAND() limit 10";
        $result=$conn->query($query);
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
            $location[]= array("lat"=>$row['latitude'], "long"=>$row['longitude'], "info" => "random");
            }
        }
        ?>
        <script type="text/javascript">
            function initMap() {
                var locations = <?php echo json_encode($location); ?>;
                var map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 3,
                  center: new google.maps.LatLng(0, 0),
                  mapTypeId: google.maps.MapTypeId.ROADMAP,
                  disableDefaultUI: true,
                  disableDoubleClickZoom: true,
                  draggable: false,
                  panControl: false,
                  rotateControl: false,
                  scaleControl: false,
                  zoomControl: false
                });

                var marker, i;
                var bounds = new google.maps.LatLngBounds();
                var infoWindow = new google.maps.InfoWindow();

                for (i = 0; i < locations.length; i++) {
                    bounds.extend(new google.maps.LatLng(locations[i]["lat"], locations[i]["long"]));
                    //var infowindow = new google.maps.InfoWindow();
                    marker = new google.maps.Marker({
                        animation: google.maps.Animation.DROP,
                        position: new google.maps.LatLng(locations[i]["lat"], locations[i]["long"]),
                        map: map
                    });
                    var content = "<a href=\"locResult.php?loc="+ locations[i]["long"] + "," + locations[i]["lat"] + "\">Search Near Here!</a>";

                    (function (marker, content) {
                        google.maps.event.addListener(marker, "click", function (e) {
                        //Wrap the content inside an HTML DIV in order to set height and width of InfoWindow.
                        infoWindow.setContent(content);
                        infoWindow.open(map, marker);
                        });
                        })(marker, content);
                    }
                map.fitBounds(bounds);
            }
      </script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLel3yQPZKEvMpW_SkzrO_n8_SBcqIpQU&callback=initMap"
    async defer></script>
    </body>  
</html>

<?php

//gmap api key:AIzaSyBLel3yQPZKEvMpW_SkzrO_n8_SBcqIpQU

?>

