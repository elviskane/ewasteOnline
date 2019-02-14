<?php
header('content-type: application/json');
include '../core/connection.php';
$query="SELECT userKey, count(*) as ordersPlaced FROM pickup_order where usertype=3 GROUP BY userKey";
$results=$dbconnect->query($query);
$data=array();
foreach($results as $row){
    $key=$row['userKey'];
    $res=mysqli_fetch_assoc($dbconnect->query("select * from recycler where recyclerKey='$key'"));
    $row['recyclerName']=$res['recyclerEmail'];
    $data[]=$row;
}
print json_encode($data);