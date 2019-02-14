<!DOCTYPE html>
<html lang="en">
<head>
  <title>Search Inventory</title>
  <?php include'modules/header.php';?>
</head>
<body>
    <?php include'modules/navigate.php';?>
    <div id="mainContent">
  <?php include'modules/sidebarnav.php';?>
        <?php
        $errors=array();
        if(isset($_POST['search'])){
              $search=mysqli_real_escape_string($dbconnect,$_POST['searchtxt']);
            $search="%$search%";
                $picksql=$dbconnect->prepare("select inventoryKey,cartKey,deviceKey,recyclerKey,deviceName,serialNumber,quantity,price,age,sellDate from inventory where deviceName like ?");           
            }
        ?>
        
        
       
        <div class="submain_content">
            <?php include'../core/errors.php'?>
            <div class="container-fluid">
                <h2>Inventory</h2>
            <div class="general_table">
                    <h3>Pickup Items</h3>
                   <form method="post" action="" id="formserialize">
                    <table class="table table-bordered table-responsive">
                        <tbody>
                            <th>No</th>
                            <th>CartId</th>
                            <th>DeviceId</th>
                            <th>RecyclerId</th>
                            <th>DeviceName</th>
                            <th>SerialNumber</th>
                            <th>price</th>
                            <th>Quantity</th>
                            <th>Age</th>
                            <th>SellDate</th>
                            <th></th>
                        </tbody>
                        <tbody>
                           <?php if($picksql &&
                                     $picksql->bind_param("s",$search) &&
                                     $picksql->execute() &&
                                     $picksql->store_result() &&
                                     $picksql->bind_result($inventoryKey,$cartKey,$deviceKey,$recyclerKey,$deviceName,$serialNumber,$quantity,$price,$age,$sellDate)):
                            while($picksql->fetch()):
                            ?>
                            <tr>
                               <td><?=$inventoryKey;?></td>
                                 <td><?=$cartKey;?></td>
                                 <td><?=$deviceKey;?></td>
                                 <td><?=$recyclerKey;?></td>
                                <td><?=$deviceName;?></td>
                                 <td><?=$serialNumber;?></td>
                                 <td><?=$quantity;?></td>
                                <td><?=$price;?></td>
                                 <td><?=$age;?></td>
                                <td><?=$sellDate;?></td>
                                <td><input type="checkbox" name="assign[]" value="<?=$inventoryKey;?>"/></td>
                            </tr>
                            <?php endwhile;?>
                                <?php else:?>
                                <p>failed</p>
                                <?php endif; $picksql->close();?>
                        </tbody>
                    </table>
                <input class="btn btn-md btn-warning" type="button" name="addtocart" value="Add To Cart" onclick="add_to_cart();return false;"/>
                </form>
                </div>
            </div>
        </div>
    </div>
    <?php include'modules/footer.php';?>
</body>
</html>