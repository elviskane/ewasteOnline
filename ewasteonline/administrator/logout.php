<?php
include'../core/connection.php';
setcookie(ADMIN_COOKIE,'',1,'/',$dormain,false);
header("location:../index.php");
$_SESSION['flush']="succesfuly logged out";
?>