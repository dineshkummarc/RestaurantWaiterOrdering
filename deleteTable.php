<?php
ob_start();
$tableid = '';
if (isset($_REQUEST['tableid'])):
   if(!empty($_REQUEST['tableid'])):     
     $tableid = htmlspecialchars($_GET['tableid']);
   else:
       header("Location:addTable.php?delete=failed");
        die();
   endif;
   else:
       header("Location:addTable.php?delete=failed");
        die();
endif;

include("db.php"); 
$query ="DELETE FROM `tablemaster` where id=".$tableid;
 $result =  mysqli_query($conn,$query);
 
 header("Location:addTable.php?delete=success");
        die();