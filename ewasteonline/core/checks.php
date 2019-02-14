<?php
header('content-type: application/json');
include 'connection.php';
if(isset($_GET['custuname'])){
    $uname=$_GET['custuname'];
    $query="SELECT * FROM customer where UserName='$uname'";
    $results=$dbconnect->query($query);
    $data=array();
    foreach($results as $row){
        $data[]=$row;
    }
    print json_encode($data);
}
if(isset($_GET['custemail'])){
    $uname=$_GET['custemail'];
    $query="SELECT * FROM customer where email='$uname'";
    $results=$dbconnect->query($query);
    $data=array();
    foreach($results as $row){
        $data[]=$row;
    }
    print json_encode($data);
}
if(isset($_GET['custphone'])){
    $uname=$_GET['custphone'];
    $query="SELECT * FROM customer where Phone='$uname'";
    $results=$dbconnect->query($query);
    $data=array();
    foreach($results as $row){
        $data[]=$row;
    }
    print json_encode($data);
}
if(isset($_GET['custnat'])){
    $uname=$_GET['custnat'];
    $query="SELECT * FROM customer where nationalid='$uname'";
    $results=$dbconnect->query($query);
    $data=array();
    foreach($results as $row){
        $data[]=$row;
    }
    print json_encode($data);
}
if(isset($_GET['copname'])){
    $uname=$_GET['copname'];
    $query="SELECT * FROM cooperation where Names='$uname'";
    $results=$dbconnect->query($query);
    $data=array();
    foreach($results as $row){
        $data[]=$row;
    }
    print json_encode($data);
}
if(isset($_GET['copemail'])){
    $uname=$_GET['copemail'];
    $query="SELECT * FROM cooperation where companyEmail='$uname'";
    $results=$dbconnect->query($query);
    $data=array();
    foreach($results as $row){
        $data[]=$row;
    }
    print json_encode($data);
}
if(isset($_GET['copphone'])){
    $uname=$_GET['copphone'];
    $query="SELECT * FROM cooperation where phonenumber='$uname'";
    $results=$dbconnect->query($query);
    $data=array();
    foreach($results as $row){
        $data[]=$row;
    }
    print json_encode($data);
}
if(isset($_GET['recemail'])){
    $uname=$_GET['recemail'];
    $query="SELECT * FROM recycler where recyclerEmail='$uname'";
    $results=$dbconnect->query($query);
    $data=array();
    foreach($results as $row){
        $data[]=$row;
    }
    print json_encode($data);
}
if(isset($_GET['recphone'])){
    $uname=$_GET['recphone'];
    $query="SELECT * FROM recycler where recyclerPhone='$uname'";
    $results=$dbconnect->query($query);
    $data=array();
    foreach($results as $row){
        $data[]=$row;
    }
    print json_encode($data);
}
if(isset($_GET['adminuname'])){
    $uname=$_GET['adminuname'];
    $query="SELECT * FROM administrator where UserName='$uname'";
    $results=$dbconnect->query($query);
    $data=array();
    foreach($results as $row){
        $data[]=$row;
    }
    print json_encode($data);
}
if(isset($_GET['adminemail'])){
    $uname=$_GET['adminemail'];
    $query="SELECT * FROM administrator where email='$uname'";
    $results=$dbconnect->query($query);
    $data=array();
    foreach($results as $row){
        $data[]=$row;
    }
    print json_encode($data);
}
if(isset($_GET['adminnat'])){
    $uname=$_GET['adminnat'];
    $query="SELECT * FROM administrator where nationalid='$uname'";
    $results=$dbconnect->query($query);
    $data=array();
    foreach($results as $row){
        $data[]=$row;
    }
    print json_encode($data);
}