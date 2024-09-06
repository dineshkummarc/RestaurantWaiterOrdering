<?php
$response = array();
require '../db.php';
    $result = mysqli_query($conn,"SELECT * FROM tablemaster;") or die(mysql_error());
 
    if (mysqli_num_rows($result) > 0) {
        
    $response["table"] = array();
    
    while ($row = $result->fetch_assoc()) {
             
            $table = array();
            $table["id"] = $row["id"]; 
            $table["name"] = $row["tablename"];  
            $table["status"] = $row["tablestatus"]; 
           
                                          
          array_push($response["table"], $table);
          }
           $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no dishs found
    $response["success"] = 0;
    $response["message"] = "No table found";
    // echo no users JSON
    echo json_encode($response);
}
