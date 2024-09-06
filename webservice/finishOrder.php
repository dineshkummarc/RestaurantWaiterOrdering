<?php

$orderid = $_POST['orderid'];
$tableid = $_POST['tableid'];

$response = array();
require '../db.php';
$result = mysqli_query($conn, "SELECT sum(price) FROM orderdetails WHERE orderid=$orderid;");
$row = mysqli_fetch_row($result);
$amount = $row[0];

$enddatetime = date('Y-m-d H:i:s');

$updatequery = mysqli_query($conn, "UPDATE ordertable SET enddatetime='$enddatetime',amount='$amount',status='0' WHERE id=$orderid");

$query1 = "UPDATE tablemaster set tablestatus='0' WHERE id='$tableid'";
$result1 = mysqli_query($conn, $query1);

$response["success"] = 0;
echo json_encode($response);
?>