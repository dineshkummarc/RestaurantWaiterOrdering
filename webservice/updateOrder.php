<?php
require '../db.php';
$dataraw = json_decode(file_get_contents("php://input"));
//$data = json_decode($_REQUEST['request']);
$orders = $dataraw->order;

foreach ($orders as $data) :
//print_r($data);die;
$orderid = $data->orderid;
$dishid = $data->dishid;
$quantity = $data->quantity;
$userid = $data->userid;
$status = "0";
//pending=0,Received=1,cancel=3
//$order = array();
//$order = $data->order;
$pricequery="SELECT price FROM dish where id=".$dishid;
$priceresult=  mysqli_query($conn, $pricequery);
$row=  mysqli_fetch_row($priceresult);
$getprice=$row[0];
$price=$getprice*$quantity;
//echo $price;

$query = "INSERT INTO orderdetails(dishid,quantity,price,status,orderid)
VALUES('$dishid','$quantity','$price','$status','$orderid')";
$result = mysqli_query($conn, $query);
endforeach;
if ($result) :
    
$data = array(
        'status' => 200,
        'message' => 'success'

    );

else:

    $data = array(
        'status' => 418,
        'message' => 'fail'
    );


endif;


header("Content-type: application/json; charset=utf-8");
echo json_encode($data);
$conn->close();
exit();
