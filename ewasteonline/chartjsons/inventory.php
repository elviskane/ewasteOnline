<?php
header('content-type: application/json');
include '../core/connection.php';
$query="SELECT * FROM inventory GROUP BY deviceKey";
$results=$dbconnect->query($query);
$data=array();

foreach($results as $row){
    $key=$row['deviceKey'];
    if($key==0){
        $row['devicetype']='.csv Devices';
    }else{
         $slct=mysqli_fetch_assoc($dbconnect->query("select * from device where deviceKey='$key'"));
         $row['devicetype']=$slct['deviceName'];
        
    }
   
    $data[]=$row;
}
print json_encode($data);