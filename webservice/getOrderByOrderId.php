<?php 

$orderid=$_POST['orderid'];
$response = array();
require '../db.php';
    $result = mysqli_query($conn,"SELECT od.id,od.dishid,d.dishname,od.quantity,od.price,od.status FROM orderdetails od,dish d WHERE orderid=$orderid AND od.dishid=d.id;") or die(mysql_error());
 
    if (mysqli_num_rows($result) > 0) {
            
    while ($row =  mysqli_fetch_array($result)) {
       
            $order= array();
            $order["orderdetailid"]=$row[0];
            $order["dishid"] = $row[1]; 
             $order["dishname"] = $row[2]; 
            $order["quantity"] = $row[3];  
            $order["price"] = $row[4]; 
            $order["status"]=$row[5];
             array_push($response, $order);
    }
 
    echo json_encode($response);
} else {
    // no dishs found
    $response["success"] = 0;
    $response["message"] = "No table found";
    // echo no users JSON
    echo json_encode($response);
}