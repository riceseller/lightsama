<?php

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
        include "supplyment/dbAccess.php";
        // AJAX request
        $current_id = $_GET['current_id']; 
        $current_pid=$_GET['current_pid'];
        $current_cat=$_GET['current_cat'];
        $current_comment=$_GET['current_comment'];
        $current_cid=$_GET['current_cid'];
        $current_request=$_GET['current_request'];
        
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
            $query100="insert into comment(userid, compic, content, comdate) values($current_id, $current_pid, '$current_comment', NOW())";
            $conn->query($query100);
        }
        else if($current_cat=='comment_delete')
        {
            $query101="delete from comment where id=$current_cid";
            $conn->query($query101);
        }
        else if($current_request=='problem')
        {
            $content="<div id=\"abc\">
                        <div id=\"popupContact\">
                            <form action=\"<?=$us_url_root?>emailresponse.php?purpose=bug\" id=\"form\" method=\"post\" name=\"form\">
                                <img id=\"close\" src=\"../media/close.png\" onclick =\"div_hide()\">
                                <h2>Report Problem</h2>
                                <hr>
                                <input id=\"name\" name=\"name\" placeholder=\"Name\" type=\"text\">
                                <input id=\"email\" name=\"email\" placeholder=\"Email\" type=\"text\">
                                <textarea id=\"msg\" name=\"message\" placeholder=\"Describe Your Problem\"></textarea>
                                <a href=\"javascript:%20check_empty()\" id=\"submit\">Send</a>
                            </form>
                        </div>
                    </div>";
            echo $content;
            
        }
        else if($current_request=='term')
        {
            $content="<div id=\"abc2\">
                        <div id=\"popupContact\">
                            <div id=\"term\">
                                <img id=\"close\" src=\"../media/close.png\" onclick =\"div_hide2()\">
                                <h2>Term & Privacy</h2>
                                <hr>
                                <textarea>legal rights preserved</textarea>
                            </div>
                        </div>
                    </div>";
            echo $content;
        }
        else if($current_request=='contact')
        {
            $content="<div id=\"abc3\">   
                        <div id=\"popupContact\">   
                            <form action=\"<?=$us_url_root?>emailresponse.php?purpose=contact\" id=\"form2\" method=\"post\" name=\"form2\">
                                <img id=\"close\" src=\"../media/close.png\" onclick = \"div_hide3()\">
                                <h2>Contact Us</h2>
                                <hr>
                                <input id=\"name2\" name=\"name\" placeholder=\"Name\" type=\"text\">
                                <input id=\"email2\" name=\"email\" placeholder=\"Email\" type=\"text\">
                                <textarea id=\"msg2\" name=\"message\" placeholder=\"leave your feedback\"></textarea>
                                <a href=\"javascript:%20check_empty2()\" id=\"submit\">Send</a>
                            </form>
                        </div>
                    </div>";
            echo $content;
        }
        
                                                       
}

?>