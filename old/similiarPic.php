<div class="other">
<br></br>
<br></br>
<center>similar pictures </center>  

<?php
    include("supplyment/dbAccess.php");
    $counter=0;
    $query8="SELECT u.url FROM Url u, assoCorresp p WHERE u.id=p.cpid AND p.ppid='$pid' ORDER BY ranking DESC limit 10";
    $result8=$conn->query($query8);
    
    while($row8 = mysqli_fetch_array($result8))
    {
            echo "<img src='".$row8['url']."' width='500' height='400' align='center' />";   
    }
    $conn->close();
?>

</div>