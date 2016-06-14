<?php
    include("supplyment/dbAccess.php");
    $query2 = "select p_id from Common limit 1";
    $result2 = $conn->query(query);
    $row2 = mysqli_fetch_array($result2);
    include("indDisplay2.php?pid='".$row['p_id']."'");
?>