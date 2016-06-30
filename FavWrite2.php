<?php

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
    ) {
        include "supplyment/dbAccess.php";
        // AJAX request
        $current_id = $_GET['current_id']; 
        $current_pid=$_GET['current_pid'];
        $current_cat=$_GET['current_cat'];
        
        $query90="delete from fav where userid=$current_id and favpic=$current_pid";
        $conn->query($query90); 
        
    }

?>
