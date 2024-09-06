<?php
include '../db.php';
$status=$_POST['status'];
$response = array();

    $result = mysqli_query($conn,"SELECT * FROM tablemaster;") ;
            
 
    if (mysqli_num_rows($result) > 0) {
        
   // $response["activetable"] = array();
    
    while ($row = $result->fetch_assoc()) {
        
        if($row["tablestatus"]==$status)
        {
            $activetable = array();
            $activetable["id"] = $row["id"]; 
            $activetable["name"] = $row["tablename"];  
            $activetable["status"] = $row["tablestatus"]; 
             array_push($response, $activetable);
        }                                        
         
          }
          // $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no dishs found
    $response["success"] = 0;
    $response["message"] = "No table found";
    // echo no users JSON
    echo json_encode($response);
}
