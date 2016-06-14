
    <head lang="en">
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>search result return</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="node_modules/jquery-lazyload/jquery.lazyload.js"></script>
        <?php
                
            include 'topNav.php';
            $iden=0;
            
            $inputStr = $_GET["res"];
            include 'supplyment/dbAccess.php';
            
            $query = "SELECT u.id, u.url FROM Url u, Common c "
                    . "     WHERE c.descript like '%".$inputStr."%'"
                    . "     AND c.p_id=u.id "
                    . "UNION "
                    . "SELECT u.id, u.url FROM Url u, Common c "
                    . "     WHERE c.title like '%".$inputStr."%'"
                    . "     AND c.p_id=u.id "
                    . "UNION "
                    . "SELECT u.id, u.url FROM Url u, Common c, TagRelation tr, Tag t "
                    . "     WHERE t.tagName like '%".$inputStr."%' AND t.id=tr.tagid "
                    . "         AND tr.pid=c.p_id AND c.p_id=u.id";
            //echo $query;
            $result=$conn->query($query);    
        ?>
        
        <style>
            img {
                position: relative;
                width:  33%;
                height: 40%;
                margin: auto;
                /* only works for desktop broswer,
                test on 15' laptop */
            }
            .lazy{
                object-fit: cover;
            }
        </style>
    </head>
        <body>
            <script>
                $(function() {
                    $("img.lazy").lazyload(
                            {effect : "fadeIn"});
                });
            </script>
            <br></br>
            <br></br>
            <center>Search result from keyword <?php echo $inputStr; ?></center>
            <br></br>
            <br></br>
                <?php
                while($row=$result->fetch_assoc())  //fetch pid, use pid to print out image
                {
                    $iden=1;
                    echo "<a style=\"text decoration: none\" href=\"indDisplay.php?pid=".$row[id]."\">"
.                       "     <img class=\"lazy\" data-original= ".$row[url].""
                            . "/> "   
.                       "</a>";
                }
                if($iden==0)
                {
                    echo "<center>your keyword returns nothing</center>";
                }
                ?>
        </body>
</html>