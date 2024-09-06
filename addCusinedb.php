<?php
ob_start();
include("db.php"); 
$cusinename='';
if (isset($_REQUEST['cusinename'])):
   if(!empty($_REQUEST['cusinename'])):     
     $cusinename = safe($conn,htmlspecialchars($_POST['cusinename']));
   else:
       header("Location: addCusine.php?add_cdata=empty");
        die();
   endif;
   else:
       header("Location: addCusine.php?add_cdata=empty");
        die();
endif;

$cusineimage = $_FILES['cusineimage']['name'];


$query ="INSERT INTO `cusine`(cusinename,cusineimage) VALUES ('$cusinename','$cusineimage')";
$result =  mysqli_query($conn,$query); 
 if($result==1){    
         
   $file_path = 'upload/';

    $file_path = $file_path . basename( $_FILES['cusineimage']['name']);
    echo "image path:".$file_path;
    if(move_uploaded_file($_FILES['cusineimage']['tmp_name'], $file_path)) {
        
         header("Location: addCusinedb.php?add_cdata=success");         
    } else{        
        header("Location: addCusinedb.php?add_cdata=failed");
    }
 
} else {
    header("Location: addCusinedb.php?add_cdata=failed");
        die();
}

function safe($conn,$value){
   return mysqli_real_escape_string($conn,$value);
} 

