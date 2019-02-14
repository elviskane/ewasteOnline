<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/style.css">
  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
<?php
include '../../core/connection.php';

foreach($_POST['assign'] as $id){
$getdata=mysqli_fetch_assoc($dbconnect->query("select * from inventory where inventoryKey='$id'"));
$inventkey=$getdata['inventoryKey'];
$itemz=array();
$itemz[]=array(
  'inventoryKey'        => $getdata['inventoryKey'],
  'deviceKey' => $getdata['deviceKey'],
  'deviceName'  => $getdata['deviceName'],
    'price'   => $getdata['price'],
    'quantity'=> $getdata['quantity']
);

$dormain=(($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false);

if($cart_id != ""){
  $cartqst="select * from cart where cartKey='{$cart_id}'";
  $cartq=$dbconnect->query($cartqst);
  $cartres=mysqli_fetch_assoc($cartq);
  $prevous_items=json_decode($cartres['cartItems'],true);
  $itemz_match=0;
  $new_items=array();
  foreach ($prevous_items as $pitems) {
    if($itemz[0]['inventoryKey'] == $pitems['inventoryKey']) {
     $itemz_match=1;
    }
    $new_items[] = $pitems;
  }
  if($itemz_match != 1){
    $new_items=array_merge($itemz,$prevous_items);
  }else{
      echo("<script>alert('E-waste has already Been Added');</script>");
  }
  $items_json=json_encode($new_items);
  $cart_expire=date("Y-m-d H:i:s",strtotime("+30 days"));
  $cartupst="update cart set cartItems='{$items_json}' where cartKey='{$cart_id}'";
  $dbconnect->query($cartupst);
  setcookie(CART_COOKIE,'',1,'/',$dormain,false);
  setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$dormain,false);
}else{
  $itemz_json = json_encode($itemz);
  $cartst="insert into cart(cartItems)values('{$itemz_json}')";
  $dbconnect->query($cartst);
  $cart_id=$dbconnect->insert_id;
  setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$dormain,false);
}
$recid=$_COOKIE[RECYCLER_COOKIE];
$dbconnect->query("update inventory set recycler_cart='$cart_id',recyclerKey='$recid' where inventoryKey='$inventkey'");
    $_SESSION['messagedis']="Items Have Been Added To Cart";
}
?>
