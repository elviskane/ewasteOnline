<?php
$cartstq1="select * from cart where cartKey='$user_cart_id'";
$cartquery1=$dbconnect->query($cartstq1);
$res=mysqli_fetch_assoc($cartquery1);
$items=json_decode($res['cartItems'],true);
$i=1;
$subtotal=0;
$itemcount=0;
?>

<div class="cartcontainer show_me">
    <div class="btn_hide text-center"></div>
<div class="cart">
  <h2 class="text-center">E-waste cart</h2>
    <?php if(mysqli_num_rows($cartquery1)==0):?>
    <h3>Your Cart Is Empty</h3>
    <?php else:?>
<table class="table table-responsive">
<tbody>
  <th class="text-center">#</th>
  <th class="text-center">deviceKey</th>
    <th class="text-center">deviceName</th>
    <th class="text-center">Serial Number</th>
    <th class="text-center">device Age</th>
  <th class="text-center">quantity</th>
    <th class="text-center">Price</th>
<th class="text-center">subtotal(Ksh.)</th>
</tbody>
<tbody>
<?php foreach ($items as $item) {
    $key=$item['deviceKey'];
    $name=$item['deviceName'];
    $serial=$item['serialnumber'];
     $age=$item['age'];
    $price=$item['price'];
    $quan=$item['quantity'];
    ?>
<tr class="text-center">
<td><?=$i;?></td>
<td><?=$key;?></td>
<td><?=$name;?></td>
<td><?=$serial;?></td>
<td><?=$age;?></td>
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
    
    <?php endif?>
    </div>
</div>