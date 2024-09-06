<?php

ob_start();
include("db.php");
$sid = $_POST['sid'];
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$currency=  strtoupper($_POST['currency']);
$tax = $_POST['tax'];
$vattax = $_POST['vattax'];
$additionaltax = $_POST['additionaltax'];
$discount=$_POST['discount'];

$query = "UPDATE settings SET name='$name',address='$address',phone='$phone',currency='$currency',tax='$tax',vattax='$vattax',additionaltax='$additionaltax',discount='$discount' where id='$sid'";

$result = mysqli_query($conn, $query);
if ($result == 1) {

    header("Location:settings.php?add_cdata=success");
} else {
    header("Location:settings.php?add_cdata=failed");
    die();
}

function safe($conn, $value) {
    return mysqli_real_escape_string($conn, $value);
}
