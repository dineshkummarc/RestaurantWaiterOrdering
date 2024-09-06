<?php
ob_start();
include("db.php"); 
$typeid = htmlspecialchars($_POST['typeid']);
$typename = safe($conn,htmlspecialchars($_POST['typename']));

$query = "UPDATE `dish_type` set "
        . "typename='$typename'"
        . "where id=".$typeid;

echo $query;
//die;
 $result =  mysqli_query($conn,$query); 
if($result==1){            
   
         header("Location:addDishType.php?add_cdata=success");         
    
} else {
    header("Location:addDishType.php?add_cdata=failed");
        die();
}


function safe($conn,$value){
   return mysqli_real_escape_string($conn,$value);
} 
