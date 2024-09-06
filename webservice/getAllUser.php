<?php
$response = array();
require '../db.php';
    $result = mysqli_query($conn,"SELECT * FROM usermaster;") or die(mysql_error());
 
    if (mysqli_num_rows($result) > 0) {
        
    $response["user"] = array();
    
    while ($row = $result->fetch_assoc()) {
             
            $user = array();
            $user["id"] = $row["id"]; 
            $user["username"] = $row["username"];  
            $user["password"] = $row["password"]; 
           
                                          
          array_push($response["user"], $user);
          }
           $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no dishs found
    $response["success"] = 0;
    $response["message"] = "No waiter found";
    // echo no users JSON
    echo json_encode($response);
}
