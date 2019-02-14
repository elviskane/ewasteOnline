<?php
header('content-type: application/json');
include '../core/connection.php';
$query="SELECT recyclerKey,paymentStatus, count(*) as ordersPaid FROM recycler_payment GROUP BY recyclerKey";
$results=$dbconnect->query($query);
$data=array();
foreach($results as $row){
    $key=$row['recyclerKey'];
    $res=mysqli_fetch_assoc($dbconnect->query("select * from recycler where recyclerKey='$key'"));
    $row['recyclerName']=$res['recyclerEmail'];
    $data[]=$row;
}
print json_encode($data);