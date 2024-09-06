<?php
$response = array();
require '../db.php';
    $result = mysqli_query($conn,"SELECT * FROM dish;") or die(mysql_error());
 
    if (mysqli_num_rows($result) > 0) {
        
    
    
    while ($row = $result->fetch_assoc()) {
             
            $dish = array();
         
             $dish["id"] = $row["id"]; 
            $dish["cusineid"] = $row["cusineid"];  
        
            $dish["dishname"] = $row["dishname"]; 
            $dish["dishtype"] = $row["dishtype"]; 
            $dish["description"] = $row["description"]; 
            $dish["price"] = $row["price"]; 
            
            $dish["dishimage"] = $row["dishimage"]; 
                                          
          array_push($response, $dish);
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
