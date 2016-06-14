<div class="exif">
<?php
	$sql="SELECT *FROM Common WHERE p_id='$pid'";
	$result2=$conn->query($sql);
	//output
	while($row2=$result2->fetch_assoc())
	{
            if($row2[title]==None)
            {
                echo "This picure does not have a title<br>";
            }
            else
            {
                echo "".$row2[title]."<br>";
            }
            echo "".$row2[description]."<br>";
            echo "Camera Model: ".$row2[model]."<br>";
	    echo "Camera Exposure: ".$row2[exposure]."<br>";
            echo "Camera Aperture: ".$row2[aperture]."<br>";
	    echo "Iso Speed: ".$row2[iso_speed]."<br>";
	    echo "Picture Taken date: ".$row2[date]."<br>";
	    echo "Focal Speed: ".$row2[focal]."<br>";
	    echo "Camera Lens: ".$row2[lens]."<br>";
	    echo "Category it Belongs: ".$row2[belong]."<br>";
	    //echo $row2[title];
	    //echo $row2[descript];
	}
                
        echo "<br></br>";
        $sqlT = "select t.tagName from Tag t join TagRelation tr on t.id=tr.tagid where tr.pid=$pid";
        $result3=$conn->query($sqlT);
        //echo"$result3";
        if($result3->num_rows>0){
            //echo "<center>picture Tag info with id $pid</center>";
            echo "<table border=1 >";
            echo "<tr>";
            while($row3=$result3->fetch_assoc())
            {
                echo "<td>$row3[tagName]</td>";
                    
            }
            echo "</tr></table>";
        }
        else
        {
            echo "this picture of pid $pid does not have any tag info";
        }
	//$conn->close();
?>
</div>
