<?php
header('content-type: application/json');
include '../core/connection.php';
$query="SELECT usertype, count(*) as ordersPlaced FROM pickup_order GROUP BY usertype";
$results=$dbconnect->query($query);
$data=array();
foreach($results as $row){
    $data[]=$row;
}
print json_encode($data);