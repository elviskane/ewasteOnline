<?php
header('content-type: application/json');
include '../core/connection.php';
$query="SELECT selldate, count(*) as sales FROM inventory GROUP BY sellDate";
$results=$dbconnect->query($query);
$data=array();
foreach($results as $row){
    $data[]=$row;
}
print json_encode($data);