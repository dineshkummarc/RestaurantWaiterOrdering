<?php

$response = array();
require '../db.php';
$result = mysqli_query($conn, "SELECT o.id,o.tableid,t.tablename FROM tablemaster t,ordertable o where t.tablestatus='1' and o.tableid=t.id and o.status='1';") or die(mysql_error());
if (mysqli_num_rows($result) > 0) {
    $amount = 0;
    while ($row = mysqli_fetch_row($result)) {

        $table = array();
        $table["orderid"] = $row[0];
        $oid = $row[0];
        $table["tableid"] = $row[1];
        $table["tablename"] = $row[2];
        $oque = mysqli_query($conn, "select count(*),sum(price) from orderdetails where orderid='$oid'");
        $orow = mysqli_fetch_row($oque);
        $table["totaldish"] = $orow[0];
        $table["amount"] = $orow[1];
        $uque = mysqli_query($conn, "select u.username from usermaster u,ordertable ot where ot.id='$oid' and ot.userid=u.id");
        $urow = mysqli_fetch_row($uque);
        $table["username"] = $urow[0];
        array_push($response, $table);
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
} else {

    $response["success"] = 0;
    $response["message"] = "No table found";
    // echo no users JSON
    echo json_encode($response);
}
