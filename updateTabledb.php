<?php
ob_start();
include("db.php"); 
$tableid = htmlspecialchars($_POST['tableid']);
$tablename = safe($conn,htmlspecialchars($_POST['tablename']));
$status=0;

$query = "UPDATE `tablemaster` set "
        . "tablename='$tablename', tablestatus='$status' "
        . "where id=".$tableid;

//echo $query;
//die;
 $result =  mysqli_query($conn,$query); 
if($result==1){            
   
         header("Location:addTable.php?add_cdata=success");         
    
} else {
    header("Location:addTable.php?add_cdata=failed");
        die();
}


function safe($conn,$value){
   return mysqli_real_escape_string($conn,$value);
} 
