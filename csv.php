<?php
header('Content-Type: application/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="tabledata.csv"');
if (isset($_POST['csv'])) {
    $csv = $_POST['csv'];
    echo $csv;
}
?>