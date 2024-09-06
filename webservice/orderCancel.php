<?php

$orderid=$_POST['orderid'];
require '../db.php';
$response = array();
mysqli_query($conn,"UPDATE ordertable SET status='4' where id='$orderid'");
mysqli_query($conn,"UPDATE orderdetails SET status='3' where orderid='$orderid'");
$getdata=mysqli_query($conn,"SELECT tableid from ordertable where id='$orderid'");
$getrow=  mysqli_fetch_row($getdata);
$tid=$getrow[0];

mysqli_query($conn,"UPDATE tablemaster SET tablestatus='0' where id='$tid'");

$response["success"] = 0;
echo json_encode($response);