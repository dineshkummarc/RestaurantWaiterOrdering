<?php
ob_start();
include("db.php"); 
$paymentmodetype = safe($conn,htmlspecialchars($_POST['paymentmodetype']));

 $query ="INSERT INTO `paymentmode`(type) VALUES"
         . " ('$paymentmodetype')";
 $result =  mysqli_query($conn,$query); 
 if($result==1){  
     header("Location: addpaymentmode.php?add_rdata=success");
} else {
    header("Location: addpaymentmode.php?add_rdata=failed");
        die();
}

function safe($conn,$value){
   return mysqli_real_escape_string($conn,$value);
} 
