<?php
ob_start();
include("db.php"); 
$tablename = safe($conn,htmlspecialchars($_POST['tablename']));
$tableflag=0;
$checktable=  mysqli_query($conn,"SELECT tablename FROM tablemaster");
if(mysqli_num_rows($checktable)>0)
{
    while ($row=  mysqli_fetch_row($checktable))
    {
        $tablenm=$row[0];
        if(strcasecmp($tablenm, $tablename)==0)
              $tableflag=1;
    }
}
if($tableflag==0)
{
 $query ="INSERT INTO `tablemaster`(tablename,tablestatus) VALUES"
         . " ('$tablename','0')";
 $result =  mysqli_query($conn,$query); 
}
 else {
       header("Location: addTable.php?add_rdata=checktablename"); 
       die();
}
 if($result==1){  
     header("Location: addTable.php?add_rdata=success");
} else {
    header("Location: addTable.php?add_rdata=failed");
        die();
}

function safe($conn,$value){
   return mysqli_real_escape_string($conn,$value);
} 
