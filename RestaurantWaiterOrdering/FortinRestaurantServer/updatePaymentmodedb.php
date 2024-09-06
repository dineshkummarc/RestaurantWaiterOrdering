<?php
ob_start();
include("db.php"); 
$pid = htmlspecialchars($_POST['pid']);
$paymentmodetype = safe($conn,htmlspecialchars($_POST['type']));
$status=0;

$query = "UPDATE `paymentmode` set "
        . "type='$paymentmodetype' "
        . "where id=".$pid;

//echo $query;
//die;
 $result =  mysqli_query($conn,$query); 
if($result==1){            
   
         header("Location:addpaymentmode.php?add_cdata=success");         
    
} else {
    header("Location:addpaymentmode.php?add_cdata=failed");
        die();
}


function safe($conn,$value){
   return mysqli_real_escape_string($conn,$value);
} 
