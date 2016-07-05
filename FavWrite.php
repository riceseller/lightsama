<?php

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
        include "supplyment/dbAccess.php";
        // AJAX request
        $current_id = $_GET['current_id']; 
        $current_pid=$_GET['current_pid'];
        $current_cat=$_GET['current_cat'];
        $current_comment=$_GET['current_comment'];
        
        echo $current_comment;
        
       
        if($current_cat=='check_like')
        {
            $query60="insert into fav(userid, favpic) values($current_id, $current_pid)";
            $conn->query($query60); 
        }
        else if($current_cat=='uncheck_like')
        {
            $query90="delete from fav where userid=$current_id and favpic=$current_pid";
            $conn->query($query90);
        }
        else if($current_cat=='comment_write')
        {
            echo "i am here";
            $query100="insert into comment(userid, compic, content) values($current_id, $current_pid, '$current_comment')";
            $conn->query($query100);
        }
                                                       
}

?>