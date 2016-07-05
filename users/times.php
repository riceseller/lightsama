<?php
    date_default_timezone_set('Asia/Singapore'); 
    include "../supplyment/dbAccess.php";
    $now=new DateTime();
    
    $queryt="select comdate from comment where id=90";
    $resultt=$conn->query($queryt);
    $rowt=mysqli_fetch_array($resultt);
    echo $rowt[0];
    $db_date=new DateTime($rowt[0]);
      
    $time_difference  = $now->diff($db_date);    
?>
	<div class="row text-center">
	
		<div class="col-xs-4">
			<div><p>db time</p><strong class="text-success"><?php echo $db_date->format("H:I:S");?></strong></div>
                        <div><p>current time</p><strong class="text-success"><?php echo $now->format("H:I:S");?></strong></div>
                        <div><p>time difference</p><strong class="text-success"><?php echo $time_difference->format("%H:%I:%S");?></strong></div>
		</div>				
				
	</div>
