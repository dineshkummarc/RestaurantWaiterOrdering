<?php
include '../db.php';
$orderid = $_POST['orderid'];
$response = array();
$responsedish = array();
$resultnew = mysqli_query($conn, "SELECT startdatetime,status,amount,grandtotal,paymentmode,discount,id FROM ordertable where id='$orderid'");
if (mysqli_num_rows($resultnew) > 0) {
    $order = array();
    $orderdish=array();
    $rownew = mysqli_fetch_row($resultnew);
    $startdatetime = $rownew[0];
    $status = $rownew[1];
    $amount = $rownew[2];
    $grandtotal = $rownew[3];
    $mode1 = $rownew[4];
    $disc = $rownew[5];
    $orderid = $rownew[6];
    $typenm = mysqli_query($conn, "select type from paymentmode where id='$mode1'");
    $typerow = mysqli_fetch_row($typenm);
    $mode = $typerow[0];
    if ($status == "0")
        $status1 = "Unpaid";
    else if ($status == "1")
        $status1 = "Process";
    else if ($status == "2")
        $status1 = "Paid";
    else if ($status == "3")
        $status1 = "Finish";
    else
        $status1 = "Cancel";
    $order["orderid"] = $orderid;
    //echo "orderid" . $orderid . "<br/>";
    $order["startdatetime"] = $startdatetime;
    //echo "time:" . $startdatetime . "<br/>";
    //echo "status:" . $status . "<br/>";
    $order["status"] = $status;
    $resulttax = mysqli_query($conn, "SELECT * FROM settings");
    while ($rowtax = mysqli_fetch_row($resulttax)) {
        $tax = $rowtax[5];
        $taxvalue = $tax / 100;
        $vattax = $rowtax[6];
        $vattaxvalue = $vattax / 100;
        $additionaltax = $rowtax[7];
        $additionaltaxvalue = $additionaltax / 100;
        $disconut = $rowtax[8];
        $disconutvalue=$disconut/100;
    }
    $result = mysqli_query($conn, "SELECT od.price,od.quantity,od.dishid,d.dishname FROM ordertable ot,orderdetails od,dish d where ot.id='$orderid' and od.orderid=ot.id and od.dishid=d.id") or die(mysql_error());
    $amount = 0;
    $grosstotal = 0;
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {

            $price = $row[0];
            $quantity = $row[1];
            $dish = $row[3];
            $amount = $amount + $price;
            //echo "dish:" . $dish . "<br/>";
            $orderdish["dishnm"] = $dish;
            //echo "quantity:" . $quantity . "<br/>";
            $orderdish["quantity"] = $quantity;
            //echo "price:" . $price . "<br/>";
            $orderdish["price"] = $price;
             array_push($responsedish, $orderdish);
        }
        $grosstotal = $amount + ($amount * $taxvalue) + ($amount * $vattaxvalue) + ($amount * $additionaltaxvalue)- ($amount * $disconutvalue);
//        if ($grandtotal == 0)
//            $grandtotal = $amount + ($amount * $taxvalue) + ($amount * $vattaxvalue) + ($amount * $additionaltaxvalue) - ($amount * $disconutvalue) - ($amount * $adddiscvalue);
    }

    // echo "amount:" . $amount . "<br/>";
    $order["amount"] = $amount;
    //echo "tax:" . $tax . "<br/>";
    $order["tax"] = $tax;
    //echo "vattax:" . $vattax . "<br/>";
    $order["vattax"] = $vattax;
    //echo "additional tax" . $additionaltax . "<br/>";
    $order["additionaltax"] = $additionaltax;
    //echo "discount:" . $disconut . "<br/>";
    if ($disconut != 0)
        $order["discount"] = $disconut;
    //echo "gross total:" . $grosstotal . "<br/>";
    $order["grosstotal"] = $grosstotal;
    //echo "grandtotal:" . $grandtotal . "<br/>";
   // $order["grandtotal"] = $grandtotal;
    array_push($response, $order);
    echo json_encode($responsedish);
    echo json_encode($response);
}
else {
    $response["success"] = 0;
    $response["message"] = "No Order found";
    // echo no users JSON
    echo json_encode($response);
}
?>
