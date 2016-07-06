<?php 

   $ip=$_SERVER['REMOTE_ADDR'];
   echo "IP address= $ip";
   echo "\n";
   date_default_timezone_set('America/New_York'); 
   
   include "../supplyment/dbAccess.php";   
   $queryt="select comdate from comment where id=98";
   $resultt=$conn->query($queryt);
   $rowt=  mysqli_fetch_array($resultt);

?> 

<?php 

   $dteStart = new DateTime(); 
   $dteEnd   = new DateTime($rowt[0]); 

?> 

<?php 

   $dteDiff  = $dteStart->diff($dteEnd); 

?> 

<?php 

   print $dteDiff->format("%M");    //Months difference
   print "\n";
   print $dteDiff->format("%D");    //days difference 
   print "\n";
   print $dteDiff->format("%H");    //hours difference 
   print "\n";
   print $dteDiff->format("%I");    //minutes difference
   print "\n";
   
   if($dteDiff->format("%M")!='00')
   {
       $date_print=$dteDiff->format("%M");  
       if(substr($date_print, 0, 1)=='0')
       {
           $date_print=substr($date_print, 1, 1);
           if($date_print=='1')
           {
               $date_print2=''.$date_print.' month ago';               
           }
           else
           {
               $date_print2=''.$date_print.' months ago';               
           }
       }
       else 
       {
            $date_print2=''.$date_print.' months ago';            
       }
       
       echo $date_print2;
       echo "\n";
   }
   else if($dteDiff->format("%D")!='00')
   {
       $date_print=$dteDiff->format("%D");  
       if(substr($date_print, 0, 1)=='0')
       {
           $date_print=substr($date_print, 1, 1);
           if($date_print=='1')
           {
               $date_print2=''.$date_print.' day ago';               
           }
           else
           {
               $date_print2=''.$date_print.' days ago';               
           }
       }
       else 
       {
            $date_print2=''.$date_print.' days ago';            
       }
       
       echo $date_print2;
       echo "\n";
   }
   else if($dteDiff->format("%H")!='00')
   {
       $date_print=$dteDiff->format("%H");  
       if(substr($date_print, 0, 1)=='0')
       {
           $date_print=substr($date_print, 1, 1);
           if($date_print=='1')
           {
               $date_print2=''.$date_print.' hour ago';               
           }
           else
           {
               $date_print2=''.$date_print.' hours ago';               
           }
       }
       else 
       {
            $date_print2=''.$date_print.' hours ago';            
       }
       
       echo $date_print2;
       echo "\n";              
   }
   else if($dteDiff->format("%I")!='00')
   {
       $date_print=$dteDiff->format("%I");  
       if(substr($date_print, 0, 1)=='0')
       {
           $date_print=substr($date_print, 1, 1);
           if($date_print=='1')
           {
               $date_print2=''.$date_print.' minute ago';               
           }
           else
           {
               $date_print2=''.$date_print.' minutes ago';               
           }
       }
       else 
       {
            $date_print2=''.$date_print.' minutes ago';            
       }
       
       echo $date_print2;
       echo "\n";
   }
   else if($dteDiff->format("%S")!='00')
   {
       $date_print=$dteDiff->format("%S");  
       if(substr($date_print, 0, 1)=='0')
       {
           $date_print=substr($date_print, 1, 1);
           if($date_print=='1')
           {
               $date_print2=''.$date_print.' second ago';               
           }
           else
           {
               $date_print2=''.$date_print.' seconds ago';               
           }
       }
       else 
       {
            $date_print2=''.$date_print.' seconds ago';            
       }
       
       echo $date_print2;
       echo "\n";
   }

?> 
    