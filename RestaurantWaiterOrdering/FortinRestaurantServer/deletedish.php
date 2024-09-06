<?php
ob_start();
$dishid = '';
if (isset($_REQUEST['dishid'])):
   if(!empty($_REQUEST['dishid'])):     
     $dishid = htmlspecialchars($_GET['dishid']);
   else:
       header("Location:addDish.php?delete=failed");
        die();
   endif;
   else:
       header("Location:addDish.php?delete=failed");
        die();
endif;

include("db.php"); 
$query ="DELETE FROM `dish` where id=".$dishid;
 $result =  mysqli_query($conn,$query);
 
 header("Location:addDish.php?delete=success");
        die();