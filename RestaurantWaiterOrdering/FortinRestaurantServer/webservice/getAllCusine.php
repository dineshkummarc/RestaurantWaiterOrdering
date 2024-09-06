<?php
$response = array();
require '../db.php';
    $result = mysqli_query($conn,"SELECT * FROM cusine;") or die(mysql_error());
 
    if (mysqli_num_rows($result) > 0) {
        
    
    
    while ($row = $result->fetch_assoc()) {
             
            $cusine = array();
            $cusine["cusineid"]=$row["id"];
             $cusine["cusinename"]=$row["cusinename"];
             $cusine["cusineimage"]=$row["cusineimage"];
                                          
          array_push($response, $cusine);
          }
          // $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no dishs found
   // $response["success"] = 0;
    $response["message"] = "No Cusine found";
    // echo no users JSON
    echo json_encode($response);
}
