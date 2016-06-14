<html>
    <head lang="en">
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>search result return</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="node_modules/jquery-lazyload/jquery.lazyload.js"></script>
        
        <?php
                
            include 'topNav.php';
            $iden=0;
            
            $mode = $_GET["mode"];
            $inputStr = $_GET["res2"];
            
            include 'supplyment/dbAccess.php';
            
            if($mode==="Lens")
            {
                $query = "SELECT u.id, u.url FROM Url u, Common c where u.id=c.p_id "
                    . "     AND c.lens like '%".$inputStr."%'";
            }
            else
            {
                $query = "SELECT u.id, u.url FROM Url u, Common c where u.id=c.p_id "
                    . "     AND c.model like '%".$inputStr."%'";
            }
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
            <center>Search result from <?php echo $mode; ?> keyword <?php echo $inputStr; ?></center>
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
                    echo "<center>your lens keyword returns nothing</center>";
                }
                ?>
        </body>
</html>