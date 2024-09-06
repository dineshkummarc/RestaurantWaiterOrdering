<?php

$customernm=$_POST['customername'];
$phone=$_POST['phone'];
$rating=$_POST['rating'];
$comment=$_POST['feedback'];
$orderid=$_POST['orderid'];

$response = array();
require '../db.php';
    mysqli_query($conn,"INSERT INTO feedback(customername,phone,rating,comment,orderid) VALUES('$customernm','$phone','$rating','$comment','$orderid') ");

    $response["success"] = 0;
    echo json_encode($response);
