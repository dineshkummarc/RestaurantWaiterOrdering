<?php
$tableid=$_POST['tableid'];
$userid=$_POST['userid'];
$response = array();
require '../db.php';

$query1="UPDATE tablemaster set tablestatus='1' WHERE id='$tableid'";
$result1 =  mysqli_query($conn,$query1);

 $query ="INSERT INTO `ordertable`(tableid,userid,status,paymentstatus) VALUES"
         . " ('$tableid','$userid','1','unpaid')";
 $result =  mysqli_query($conn,$query); 
 
 $last_insert_id = mysqli_insert_id($conn);

          $response["orderid"]= $last_insert_id ;

    echo json_encode($response);

