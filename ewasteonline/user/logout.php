<?php
include'../core/connection.php';
setcookie(COP_COOKIE,'',1,'/',$dormain,false);
setcookie(USER_COOKIE,'',1,'/',$dormain,false);
setcookie(USERTYPE_COOKIE,'',1,'/',$dormain,false);
header("location:../index.php");
$_SESSION['flush']="succesfuly logged out";
?>