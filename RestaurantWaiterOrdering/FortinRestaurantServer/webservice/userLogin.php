<?php
$username=$_POST["username"];
$password=$_POST["password"];
$response = array();
require '../db.php';
    $result = mysqli_query($conn,"SELECT * FROM usermaster where username='$username' and password='$password';") or die(mysql_error());
  
    if (mysqli_num_rows($result) > 0) {
         while ($row = $result->fetch_assoc()) {
       $response["userid"]=$row['id'];
    $response["message"] ="Login Success";
           $response["success"] = 1;
         }
    // echoing JSON response
    echo json_encode($response);
} else {
    // no waiter found
    $response["success"] = 0;
    $response["message"] = "Invalid Username and Password";
    // echo no users JSON
    echo json_encode($response);   
}
