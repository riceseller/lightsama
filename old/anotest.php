<?php
    $pid=153703345;
    $come_from=157436555;
?>



<html>
    
    <style>
        .inline {
            display: inline;
        }

        .link-button {
            background: none;
            border: none;
            text-decoration: none;
            cursor: pointer;
        }
      
    </style>    
    
    <a href="db.luokerekz.com">This is a regular link</a>
    
    <form method="POST" action="indDisplay2.php?pid=<?php echo $pid?>" class="inline">
        <input type="hidden" name="come_from" value=<?php echo $come_from?>>
        <button type="submit" class="link-button">test using both method</button>
    </form>
    
</html>