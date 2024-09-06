<?php
ob_start();
include("db.php"); 
$typename = safe($conn,htmlspecialchars($_POST['typename']));

 $query ="INSERT INTO `dish_type`(typename) VALUES"
         . " ('$typename')";
 $result =  mysqli_query($conn,$query); 
 if($result==1){  
     header("Location: addDishType.php?add_rdata=success");
} else {
    header("Location: addDishType.php?add_rdata=failed");
        die();
}

function safe($conn,$value){
   return mysqli_real_escape_string($conn,$value);
} 
