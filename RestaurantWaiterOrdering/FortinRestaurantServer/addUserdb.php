<?php
ob_start();
include("db.php"); 
$username = safe($conn,htmlspecialchars($_POST['uname']));
$password = htmlspecialchars($_POST['password']);
$role=$_POST['cmbrole'];

 $query ="INSERT INTO `usermaster`(username,password,role) VALUES"
         . " ('$username','$password','$role')";
 $result =  mysqli_query($conn,$query); 
 if($result==1){            
   
         header("Location: addUser.php?add_rdata=success");         
   
} else {
    header("Location: addUser.php?add_rdata=failed");
        die();
}

function safe($conn,$value){
   return mysqli_real_escape_string($conn,$value);
} 
