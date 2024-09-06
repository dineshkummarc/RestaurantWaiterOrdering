<?php
ob_start();
$pid = '';
if (isset($_REQUEST['pid'])):
   if(!empty($_REQUEST['pid'])):     
     $pid = htmlspecialchars($_GET['pid']);
   else:
       header("Location:addpaymentmode.php?delete=failed");
        die();
   endif;
   else:
       header("Location:addpaymentmode.php?delete=failed");
        die();
endif;

include("db.php"); 
$query ="DELETE FROM `paymentmode` where id=".$pid;
 $result =  mysqli_query($conn,$query);
 
 header("Location:addpaymentmode.php?delete=success");
        die();