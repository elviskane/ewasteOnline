<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/style.css">
  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
<?php
include '../../core/connection.php';

$deviceId=mysqli_real_escape_string($dbconnect,$_POST['id']);
$price=mysqli_real_escape_string($dbconnect,$_POST['price']);
$name=mysqli_real_escape_string($dbconnect,$_POST['name']);
$serial=mysqli_real_escape_string($dbconnect,$_POST['serial']);
$quantity=mysqli_real_escape_string($dbconnect,$_POST['quantity']);
$age=mysqli_real_escape_string($dbconnect,$_POST['age']);
$date=mysqli_real_escape_string($dbconnect,$_POST['date_in']);
$itemz=array();
$itemz[]=array(
  'deviceKey' => $deviceId,
  'deviceName'  => $name,
    'serialnumber' =>$serial,
    'age' => $age,
    'price'   => $price,
    'quantity'=> $quantity
);

$dormain=(($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false);

if($user_cart_id != ""){
  $cartqst="select * from cart where cartKey='{$user_cart_id}'";
  $cartq=$dbconnect->query($cartqst);
  $cartres=mysqli_fetch_assoc($cartq);
  $prevous_items=json_decode($cartres['cartItems'],true);
  $itemz_match=0;
  $new_items=array();
  foreach ($prevous_items as $pitems) {
   
    $new_items[] = $pitems;
  }
  if($itemz_match != 1){
    $new_items=array_merge($itemz,$prevous_items);
  }else{
      echo("<script>alert('E-waste has already Been Added');</script>");
  }
  $items_json=json_encode($new_items);
  $cart_expire=date("Y-m-d H:i:s",strtotime("+30 days"));
  $cartupst="update cart set cartItems='{$items_json}' where cartKey='{$user_cart_id}'";
  $dbconnect->query($cartupst);
  setcookie(USER_CART_COOKIE,'',1,'/',$dormain,false);
  setcookie(USER_CART_COOKIE,$user_cart_id,CART_COOKIE_EXPIRE,'/',$dormain,false);
}else{
  $itemz_json = json_encode($itemz);
  $cartst="insert into cart(cartItems)values('{$itemz_json}')";
  $dbconnect->query($cartst);
  $user_cart_id=$dbconnect->insert_id;
  setcookie(USER_CART_COOKIE,$user_cart_id,CART_COOKIE_EXPIRE,'/',$dormain,false);
}
$dbconnect->query("insert into inventory(cartKey,deviceKey,deviceName,serialNumber,quantity,price,age,selldate)values('$user_cart_id','$deviceId','$name','$serial','$quantity','$price','$age','$date')");
$_SESSION['messagedis']="E-waste Has Been Added To Cart"; 
?>
