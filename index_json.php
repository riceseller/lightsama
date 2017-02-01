<?php

require_once "supplyment/dbAccess.php";
$request_get = $_GET["category"];

if($request_get == 'landscape') {
    $query = "select distinct c.title, su.*, u.id as uid, u.url, u.width, u.height from Url u, Common c, ScrapeUser su, TagRelation tr where c.p_id!=160630813 and tr.pid=c.p_id and tr.tagid=1046 and u.id=c.p_id and c.nsfw=0 and c.userBelong=su.id and u.width is not null and u.height is not null and c.title is not null and c.title!='None' and c.title!='?' order by c.dateR desc limit 20";
    $result=mysqli_query($conn, $query);    
}

else if($request_get == 'skyscraper') {
    $query = "select distinct c.title, su.*, u.id as uid, u.url, u.width, u.height from Url u, Common c, ScrapeUser su, TagRelation tr where c.p_id!=160630813 and tr.pid=c.p_id and tr.tagid=6241 and u.id=c.p_id and c.nsfw=0 and c.userBelong=su.id and u.width is not null and u.height is not null and c.title is not null and c.title!='None' and c.title!='?' order by c.dateR desc limit 20";
    $result=mysqli_query($conn, $query); 
}

else if($request_get == 'beauty') {
    $query = "select distinct c.title, su.*, u.id as uid, u.url, u.width, u.height from Url u, Common c, ScrapeUser su, TagRelation tr where c.p_id!=160630813 and tr.pid=c.p_id and tr.tagid=12048 and u.id=c.p_id and c.nsfw=0 and c.userBelong=su.id and u.width is not null and u.height is not null and c.title is not null and c.title!='None' and c.title!='?' order by c.dateR desc limit 20";
    $result=mysqli_query($conn, $query); 
}

if ($result -> num_rows > 0) {
    $response = array();
    $posts = array();
    while($row = mysqli_fetch_assoc($result)) {
        $posts[]=array('id'=>$row['id'], 'url'=>$row['url'], 'uid'=>$row['uid'], 'title'=>$row['title'], 'width'=>$row['width'], 'height'=>$row['height'], 'extraOne'=>$row['extraOne'], 'extraTwo'=>$row['extraTwo'], 'userID'=>$row['userID'], 'Ubelong'=>$row['Ubelong']);
    }
    $response['list'] = $posts;
    $fp = json_encode($response);
    echo $fp;
}
?>