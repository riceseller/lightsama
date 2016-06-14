<?php include 'topNav2.php';?>
<header>       
    <script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
    <style>
        #map {
            height: 1000px;
        }
    </style>
</header>

<script type="text/javascript" src="http://maps.google.cn/maps/api/js?sensor=false&libraries=places"></script>

<script type="text/javascript">
// We'll run the AJAX query when the page loads.
window.onload=function(){
var json = [];
var map;
var markers = []; // Create a marker array to hold your markers
var mapStyle = [{"featureType":"landscape.man_made","elementType":"all","stylers":[{"color":"#faf5ed"},{"lightness":"0"},{"gamma":"1"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#bae5a6"}]},{"featureType":"road","elementType":"all","stylers":[{"weight":"1.00"},{"gamma":"1.8"},{"saturation":"0"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ffb200"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"lightness":"0"},{"gamma":"1"}]},{"featureType":"transit.station.airport","elementType":"all","stylers":[{"hue":"#b000ff"},{"saturation":"23"},{"lightness":"-4"},{"gamma":"0.80"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#a0daf2"}]}];

function locUpdate(lat,lng,dis) {
    dis = dis || 200000;
    lat = lat || 0;
    lng = lng || 0;
    /*$.getJSON(
    "/locreturn.php", // The server URL 
    { lat:0, lng:0 }, // Data you want to pass to the server.
    show // The function to call on completion.
    );*/
    /*$.getJSON("/locreturn.php").done(function(data) {
     json = data;
     setMarkers(json);
    });*/
    //document.getElementById("testlat").innerHTML = lat;
    $.post("/locreturn.php", {latitude:lat, longitude:lng, distance:dis}, function(data, textStatus) {
    //data contains the JSON object
    //textStatus contains the status: success, error, etc
    json = data;
    //document.getElementById("testlat").innerHTML = json;
    setMarkers(json);
    }, "json");
}

function setMarkers(locations) {
    //alert(locations);
    for (var i = 0; i < locations.length; i++) {
        //alert(beach);
        var beach = locations[i];
        (function(beach){
        setTimeout(function() {
            var myLatLng = new google.maps.LatLng(beach[1], beach[2]);
            var infowindow = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                animation: google.maps.Animation.DROP
                //title: beach[0]
            });
            markers.push(marker);
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                  infowindow.setContent(locations[i][0]);
                  infowindow.open(map, marker);
                };
            })(marker, i));
        }, (i*150));
        }(beach));
    }
}

function reloadMarkers(lat,lng,dis) {
 
    // Loop through markers and set map to null for each
    for (var i=0; i<markers.length; i++) {
     
        markers[i].setMap(null);
    }
    
    // Reset the markers array
    markers = [];
    
    // Call set markers to re-add markers
    locUpdate(lat,lng,dis);
    //map.fitBounds(bounds);
}

function checkBounds(map) {
    var latNorth = map.getBounds().getNorthEast().lat();
    var latSouth = map.getBounds().getSouthWest().lat();
    var newLat;

    if(latNorth<85 && latSouth>-85)     /* in both side -> it's ok */
        return;
    else {
        if(latNorth>85 && latSouth<-85)   /* out both side -> it's ok */
            return;
        else {
            if(latNorth>85)   
                newLat =  map.getCenter().lat() - (latNorth-85);   /* too north, centering */
            if(latSouth<-85) 
                newLat =  map.getCenter().lat() - (latSouth+85);   /* too south, centering */
        }   
    }
    if(newLat){
        var newCenter= new google.maps.LatLng( newLat ,map.getCenter().lng() );
        map.setCenter(newCenter);
    }   
}

function centerUpdate(map) {
    var bounds = map.getBounds();

    var center = bounds.getCenter();
    var ne = bounds.getNorthEast();
    var latSent = center.lat();
    var lngSent = center.lng();

    // r = radius of the earth in statute miles
    var r = 3963.0;  

    // Convert lat or lng from decimal degrees into radians (divide by 57.2958)
    var lat1 = latSent / 57.2958; 
    var lon1 = lngSent / 57.2958;
    var lat2 = ne.lat() / 57.2958;
    var lon2 = ne.lng() / 57.2958;

    // distance = circle radius from center to Northeast corner of bounds
    var dis = r * Math.acos(Math.sin(lat1) * Math.sin(lat2) + 
      Math.cos(lat1) * Math.cos(lat2) * Math.cos(lon2 - lon1));
    document.getElementById("update").innerHTML = dis;
    reloadMarkers(latSent,lngSent,dis);
}

function initialize() {
    
    var mapOptions = {
        minZoom: 2,
        Zoom: 3,
        center: new google.maps.LatLng(0,0),
        styles: mapStyle,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    bounds = new google.maps.LatLngBounds();
    
    google.maps.event.addListener(map, 'center_changed', function() {
        checkBounds(map);
    });
    google.maps.event.addListener(map, 'dragend', function(){
        centerUpdate(map);
    });
    google.maps.event.addListener(map, 'zoom_changed', function(){
        centerUpdate(map);
    });
    //setMarkers(beaches);
    locUpdate();
    //map.fitBounds(bounds);
    
}

initialize();
};
</script>

  
</head>

</script>

<div id="map"></div>
<div id="update">123</div>
<div id="testlat">444</div>
</body>    
</html>