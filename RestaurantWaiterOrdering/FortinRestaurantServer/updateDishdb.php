<?php

ob_start();
include("db.php");
$dishid = htmlspecialchars($_POST['dishid']);
$dishname = safe($conn, htmlspecialchars($_POST['dishname']));
$cusine = safe($conn, htmlspecialchars($_POST['cusineid']));
$dishtype = safe($conn, htmlspecialchars($_POST['typeid']));
$description = htmlspecialchars($_POST['description']);
$price = safe($conn, htmlspecialchars($_POST['price']));
$dishimage = $_FILES['dishimage']['name'];

if ($dishimage == '')
    $query = "UPDATE `dish` set "
            . "cusineid='$cusine',dishname='$dishname',dishtype='$dishtype',description='$description',price='$price' "
            . "where id=" . $dishid;
else
    $query = "UPDATE `dish` set "
            . "cusineid='$cusine',dishname='$dishname',dishtype='$dishtype',description='$description',price='$price',dishimage='$dishimage' "
            . "where id=" . $dishid;


$result = mysqli_query($conn, $query);
if ($result == 1) {
    $file_path = 'upload/';

    $file_path = $file_path . basename($_FILES['dishimage']['name']);
    if (move_uploaded_file($_FILES['dishimage']['tmp_name'], $file_path)) {
        //echo "success";
        header("Location:addDish.php?add_cdata=success");
    } else {
        header("Location:addDish.php?add_cdata=failed");
    }
} else {
    header("Location:addDish.php?add_cdata=failed");
    die();
}

function safe($conn, $value) {
    return mysqli_real_escape_string($conn, $value);
}
