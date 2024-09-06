<?php

$cusineid = $_POST['cusineid'];
$response = array();
require '../db.php';
$result = mysqli_query($conn, "SELECT d.*,dt.typename FROM dish d,dish_type dt WHERE d.dishtype=dt.id and cusineid='$cusineid';") or die(mysql_error());

if (mysqli_num_rows($result) > 0) {



    while ($row = mysqli_fetch_array($result)) {

        $cusinedish = array();

        $cusinedish["dishid"] = $row[0];
        $cusinedish["cusineid"] = $row[1];
        $cusinedish["dishname"] = $row[2];
        $cusinedish["dishimage"] = $row[3];
        // $cusinedish["dishtypeid"] = $row[4];
        $cusinedish["description"] = $row[5];
        $cusinedish["price"] = $row[6];
        $cusinedish["dishtpe"] = $row[7];
        array_push($response, $cusinedish);
    }
    // $response["success"] = 1;
    // echoing JSON response
    echo json_encode($response);
} else {
    // no dishs found
    // $response["success"] = 0;
    $response["message"] = "No dish found";
    // echo no users JSON
    echo json_encode($response);
}
