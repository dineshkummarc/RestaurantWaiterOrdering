<?php
ob_start();
$typeid = '';
if (isset($_REQUEST['typeid'])):
   if(!empty($_REQUEST['typeid'])):     
     $typeid = htmlspecialchars($_GET['typeid']);
   else:
       header("Location:addDishType.php?delete=failed");
        die();
   endif;
   else:
       header("Location:addDishType.php?delete=failed");
        die();
endif;

include("db.php"); 
$query ="DELETE FROM `dish_type` where id=".$typeid;
 $result =  mysqli_query($conn,$query);
 
 header("Location:addDishType.php?delete=success");
        die();