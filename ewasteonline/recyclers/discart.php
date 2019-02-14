<?php
$cart_id=mysqli_real_escape_string($dbconnect,$cart_id);
$cartstq1=$dbconnect->prepare("select * from cart where cartKey=?");
$cartstq1->bind_param("i",$cart_id);
$cartstq1->execute();
$cartquery1=$cartstq1->get_result()->fetch_array();
$items=json_decode($cartquery1['cartItems'],true);
$i=1;
$subtotal=0;
$itemcount=0;
?>

<div class="cartcontainer show_me">
    <div class="btn_hide"></div>
<div class="cart">
 
    <?php if(!$cartquery1):?>
    <h1 class="text-center">Your E-waste Cart Is Empty</h1>
    <?php else:?>
<h2 class="text-center">E-waste cart</h2>
<table class="table table-responsive">
<tbody>
  <th class="text-center">#</th>
    <th class="text-center">inventoryKey</th>
  <th class="text-center">deviceKey</th>
    <th class="text-center">deviceName</th>
  <th class="text-center">quantity</th>
    <th class="text-center">Price</th>
<th class="text-center">subtotal(Ksh.)</th>
</tbody>
<tbody>
<?php foreach ($items as $item) {
    $id=$item['inventoryKey'];
    $key=$item['deviceKey'];
    $name=$item['deviceName'];
    $price=$item['price'];
    $quan=$item['quantity'];
    ?>
<tr class="text-center">
<td><?=$i;?></td>
<td><?=$id;?></td>
<td><?=$key;?></td>
<td><?=$name;?></td>
<td><?=$quan;?></td>
<td>Ksh.<?=$price;?></td>
<td>Ksh.<?=$item['quantity']*$price;?></td>
</tr>
    <?php
      $i++;
      $itemcount+=$item['quantity'];
      $subtotal+=($price*$item['quantity']);
  } ?>
</tbody>
</table>
    <table class="table compute">
      <thead><th class="text-center">TotalItems</th><th class="text-center">Buy Back Value</th></thead>
      <tbody>
        <tr class="text-center">
          <td><?=$itemcount;?></td>
          <td>Ksh.<?=$subtotal;?></td>
        </tr>
      </tbody>
    </table>
    <button class="btn btn-md btn-success" onclick="checkoutbtn(<?=$subtotal;?>)"> <h5>checkout >></h5> </button>
    
    <?php endif;
    $cartstq1->close();
    ?>
    </div>
</div>