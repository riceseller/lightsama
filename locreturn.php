<?php
    require_once 'supplyment/dbAccess.php';
    ?>

<script>
        // load remote page via jquery
        $(document).on('click','#mapImgLoad',function(event) {
            event.preventDefault();            
            
            var modal = $('#gridSystemModal').modal();
            modal.find('.modal-content').load($(this).attr('href'), function () {
                    //$('.modal-content').css('height',$( window ).height());
                    modal.show();                   
                });
        });
</script>

<?php


    $step = 0;
    if(isset($_POST['distance'])) {
    $disInput = $_POST['distance'];
    $latInput = $_POST['latitude'];
    $lngInput = $_POST['longitude'];
    $limit = floor($disInput/300);
    if ($limit<10){ $limit = 20; }
    if ($limit>40){ $limit = 40; }
    //$limit = 5; //for debug
    $query = "select u.urlSmall,longitude,latitude,pid from Url u join (select pid,longitude,latitude from (SELECT id,longitude,latitude,(3959*acos(cos(radians($latInput))*cos(radians(latitude))*cos(radians(longitude)-radians($lngInput))+sin(radians($latInput))*sin(radians(latitude)))) AS distance FROM Coordinate HAVING distance < $disInput ORDER BY rand(123) LIMIT 0,$limit) as c join CoordinateCorrespondance co on co.coeid=c.id) as sub on sub.pid=u.id";
    }else{
    $query="select u.urlSmall,longitude,latitude,pid from Url u join (select pid,longitude,latitude from (select id,longitude,latitude from Coordinate order by RAND(123) limit $limit) as c join CoordinateCorrespondance co on co.coeid=c.id) as sub on sub.pid=u.id";
    }
    $result=$conn->query($query);
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
        //$location[]= array("lat"=>$row['latitude'], "long"=>$row['longitude'], "info" => "random");
            $infoData = '<li><a id=\"mapImgLoad\" style="text-decoration:none;" href=/indDisplay4.php?pid='.$row['pid'].'&url='.$row['urlSmall'].'>'
                    . '<img id=scroll'.$step.' src=\''.$row['urlSmall'].'\' style="max-width:150px">'
                    . '</a></li>';
            $lat = $row['latitude'];
            $lng = $row['longitude'];
            $return[$step] = [$infoData , $lat , $lng];
            $step = $step + 1;
        //echo 'locations.push ( {latlng: new google.maps.Latlng('.$lat.','.$lng.') } ) ;';
        }
    }
    echo json_encode($return);
    //example code below
    /*$query_lista  = mysql_query($sql_lista);
    $achados_lista = mysql_num_rows($query_lista);
    while ($achados_lista = mysql_fetch_array($query_lista)) {
        $lat = $achados_lista['MONITLATITUDE'];
        $lon = $achados_lista['MONITLONGITUDE'];
        $Data = $achados_lista['MONITDATA'];
        $hora = $achados_lista['MONITHORA'];
        $raio = $achados_lista['MONITRAIO'];
        $provedor = $achados_lista['MONITPROVEDOR'];
        $velocidade = $achados_lista['MONITVELOCIDADE'];
        echo 'locations.push ( {Data:"'.$Data.'", latlng: new google.maps.LatLng('.$lat.', '.$lon.'), hora:"'.$hora.'", raio:"'.$raio.'",provedor:"'.$provedor.'",velocidade:"'.$velocidade.'"} );';
    }*/ 
    /* test query, distance in miles
     * SELECT id,(3959*acos(cos(radians(78.3232))*cos(radians(latitude))*cos(radians(longitude)-radians(65.3234))+sin(radians(78.3232))*sin(radians(latitude)))) AS distance FROM Coordinate HAVING distance < 3000 ORDER BY distance LIMIT 0,20;
     */
?>

<div id="gridSystemModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modalDialogID">
    <div class="modal-content" id="modalContentID">
      
    </div>
  </div>
</div>