<?php
ob_start();
$cid = '';
if (isset($_REQUEST['cid'])):
   if(!empty($_REQUEST['cid'])):     
     $cid = htmlspecialchars($_GET['cid']);
   else:
       header("Location: addCusine.php?delete=failed");
        die();
   endif;
   else:
       header("Location: addCusine.php?delete=failed");
        die();
endif;

include("db.php"); 

// Check if Dish are mapped to Cuisine

$selQuery = "select * from dish where cusineid=".$cid;


 $resultselQuery =  mysqli_query($conn,$selQuery); 
    if (mysqli_num_rows($resultselQuery) > 0) :
        
        header("Location: addCusine.php?delete=exists");
        die();
        
    else:
       $query ="DELETE FROM `cusine` where id=".$cid;
        $result =  mysqli_query($conn,$query);
        header("Location: addCusine.php?delete=success");
        die();
    endif;

