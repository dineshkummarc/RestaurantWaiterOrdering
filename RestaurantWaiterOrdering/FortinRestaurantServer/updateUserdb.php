<?php
ob_start();
include("db.php"); 
$uid = htmlspecialchars($_POST['uid']);
$username = safe($conn,htmlspecialchars($_POST['username']));
$password = safe($conn,htmlspecialchars($_POST['password']));
$role=$_POST['role'];

$query = "UPDATE `usermaster` set "
        . "username='$username', password='$password',role='$role' "
        . "where id=".$uid;

echo $query;
 $result =  mysqli_query($conn,$query); 
if($result==1){            
   
         header("Location:addUser.php?add_cdata=success");         
    
} else {
    header("Location:addUser.php?add_cdata=failed");
        die();
}


function safe($conn,$value){
   return mysqli_real_escape_string($conn,$value);
} 
