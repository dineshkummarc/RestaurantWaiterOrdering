<?php
ob_start();
include("db.php"); 
$cid = htmlspecialchars($_POST['cid']);
$cusinename = safe($conn,htmlspecialchars($_POST['cusinename']));
$cusineimage = $_FILES['cusineimage']['name'];


if($cusineimage=='')
    $query = "UPDATE `cusine` set "
        . "cusinename='$cusinename'"
        . "where id=".$cid;
else
$query = "UPDATE `cusine` set "
        . "cusinename='$cusinename' ,cusineimage='$cusineimage'"
        . "where id=".$cid;

 $result =  mysqli_query($conn,$query); 
if($result==1){            
    $file_path = 'upload/';        
   
    $file_path = $file_path . basename( $_FILES['cusineimage']['name']);
    if(move_uploaded_file($_FILES['cusineimage']['tmp_name'], $file_path)) {
      
         header("Location:addCusine.php?add_cdata=success");         
    } else{        
        header("Location:addCusine.php?add_cdata=failed");
    }         
   
} else {
   header("Location:addCusine.php?add_cdata=failed");
        die();
}


function safe($conn,$value){
   return mysqli_real_escape_string($conn,$value);
} 
