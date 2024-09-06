<?php
ob_start();
$uid = '';
if (isset($_REQUEST['uid'])):
   if(!empty($_REQUEST['uid'])):     
     $uid = htmlspecialchars($_GET['uid']);
   else:
       header("Location:addUser.php?delete=failed");
        die();
   endif;
   else:
       header("Location:addUser.php?delete=failed");
        die();
endif;

include("db.php"); 
$query ="DELETE FROM `usermaster` where id=".$uid;
 $result =  mysqli_query($conn,$query);
 
 header("Location:addUser.php?delete=success");
        die();