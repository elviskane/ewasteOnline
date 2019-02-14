<?php
$dbconnect=mysqli_connect("localhost","root","","ewastedb");
if(mysqli_connect_error()){
echo 'database connection error or doesnt exit';
die();
}
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/ewasteonline/core/globalconst.php';
$cart_id ="";
$user_cart_id="";
$user_uname="";
$admin_uname="";
$recycler_uname="";
$cop_uname="";
$user_cookie_type="";
$token_cookie="";
$messagedis="";
if(isset($_COOKIE[CART_COOKIE])){
  $cart_id=$_COOKIE[CART_COOKIE];
}
if(isset($_COOKIE[USER_COOKIE])){
    $user_uname=$_COOKIE[USER_COOKIE];
}
if(isset($_COOKIE[ADMIN_COOKIE])){
    $admin_uname=$_COOKIE[ADMIN_COOKIE];
}
if(isset($_COOKIE[RECYCLER_COOKIE])){
    $recycler_uname=$_COOKIE[RECYCLER_COOKIE];
}
if(isset($_COOKIE[COP_COOKIE])){
    $cop_uname=$_COOKIE[COP_COOKIE];
}
if(isset($_COOKIE[USER_CART_COOKIE])){
    $user_cart_id=$_COOKIE[USER_CART_COOKIE];
}
if(isset($_COOKIE[USERTYPE_COOKIE])){
    $user_cookie_type=$_COOKIE[USERTYPE_COOKIE];
}
if(isset($_COOKIE[TOKEN_COOKIE])){
    $token_cookie=$_COOKIE[TOKEN_COOKIE];
}
if(isset($_SESSION['messagedis'])){
  $messagedis=$_SESSION['messagedis'];
  unset($_SESSION['messagedis']);  
  
}
if(isset($_SESSION['message'])){
   $messagedis=$_SESSION['message'];
  $_SESSION['message']=null;  
  
}