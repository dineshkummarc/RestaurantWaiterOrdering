<?php
ob_start();
include("db.php"); 
$cusine=htmlspecialchars($_POST['cusineid']);
$dishname=htmlspecialchars($_POST['dishname']);
$desc=htmlspecialchars($_POST['discription']);
$price=htmlspecialchars($_POST['price']);
$type=htmlspecialchars($_POST['typeid']);
$dishimage = $_FILES['dishimage']['name'];
$dishflag=0;
$checkdish=  mysqli_query($conn,"SELECT dishname FROM dish");
if(mysqli_num_rows($checkdish)>0)
{
    while ($row=  mysqli_fetch_row($checkdish))
    {
        $dishnm=$row[0];
        if(strcasecmp($dishnm, $dishname)==0)
              $dishflag=1;
    }
}
else {
    $dishflag=0;
}
if($dishflag==0)
{
$query ="INSERT INTO `dish`(cusineid,dishname,dishimage,dishtype,description,price) VALUES ('$cusine','$dishname','$dishimage','$type','$desc','$price')";
$result =  mysqli_query($conn,$query);  
}
 else {
       header("Location: addDish.php?add_rdata=checkdishname"); 
       die();
}

//$query ="INSERT INTO `dish`(cusineid,dishname,dishimage,dishtype,description,price) VALUES ('$cusine','$dishname','$dishimage','$type','$desc','$price')";
//$result =  mysqli_query($conn,$query); 
//echo $query;
//die();
 if($result==1){    
         
   $file_path = 'upload/';

    $file_path = $file_path . basename( $_FILES['dishimage']['name']);
    
    if(move_uploaded_file($_FILES['dishimage']['tmp_name'], $file_path)) {
        
         header("Location: addDish.php?add_cdata=success");         
    } else{        
        header("Location: addDish.php?add_cdata=failed");
    }
 
} else {
    header("Location: addDish.php?add_cdata=failed");
        die();
}

function safe($conn,$value){
   return mysqli_real_escape_string($conn,$value);
} 

