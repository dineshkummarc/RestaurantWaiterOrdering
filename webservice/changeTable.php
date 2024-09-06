<?php

$orderid = $_POST['orderid'];
$oldtableid = $_POST['oldtableid'];
$newtableid = $_POST['newtableid'];
$response = array();
require '../db.php';
$updatetablestatus = "UPDATE tablemaster set tablestatus='0' WHERE id='$oldtableid'";
mysqli_query($conn, $updatetablestatus);
 mysqli_query($conn, "UPDATE ordertable SET tableid='$newtableid' WHERE id=$orderid");
 mysqli_query($conn, "UPDATE tablemaster SET tablestatus='1' WHERE id=$newtableid");


$response["success"] = 0;
echo json_encode($response);
