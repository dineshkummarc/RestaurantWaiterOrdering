<?php
$response = array();
require '../db.php';
    $result = mysqli_query($conn,"SELECT * FROM settings;") or die(mysql_error());
 
    if (mysqli_num_rows($result) > 0) {
    
    while ($row = $result->fetch_assoc()) {
             
            $settings = array();
            $settings["id"]=$row["id"];
            $settings["name"]=$row["name"];
            $settings["address"]=$row["address"];
            $settings["phone"]=$row["phone"];
            $settings["currency"]=$row["currency"];
            $settings["tax"]=$row["tax"];
            $settings["vattax"]=$row["vattax"];
            $settings["additionaltax"]=$row["additionaltax"];
            $settings["discount"]=$row["discount"];
                                                       
          array_push($response, $settings);
          }
          // $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no dishs found
   // $response["success"] = 0;
    $response["message"] = "No Settings found";
    // echo no users JSON
    echo json_encode($response);
}
