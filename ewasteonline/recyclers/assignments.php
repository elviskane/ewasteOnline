<!DOCTYPE html>
<html>
    <head>
    <title>New</title>
    <?php include'modules/header.php';?>
</head>
    <body>
       
        <?php include 'modules/navigate.php';?>
        <div id="client_mainContent">
        <?php include'modules/sidebarnav.php';?>
        <?php
        $picksql="select * from inventory where recyclerKey=0";
        $pickquery=$dbconnect->query($picksql);
           
        ?>
        <div class="submain_content">
              <div id="messagedis"><p><?=$messagedis;?></p></div>
              <?php include'discart.php'?>
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
                            <th>Quantity</th>
                            <th>Age</th>
                            <th>SellDate</th>
                            <th></th>
                        </tbody>
                        <tbody>
                            <?php while($res=mysqli_fetch_assoc($pickquery)):?>
                            <tr>
                                <td><?=$res['inventoryKey'];?></td>
                                 <td><?=$res['cartKey'];?></td>
                                 <td><?=$res['deviceKey'];?></td>
                                 <td><?=$res['recyclerKey'];?></td>
                                <td><?=$res['deviceName'];?></td>
                                 <td><?=$res['serialNumber'];?></td>
                                 <td><?=$res['quantity'];?></td>
                                 <td><?=$res['age'];?></td>
                                <td><?=$res['sellDate'];?></td>
                                <td>
                                <input type="checkbox" name="assign[]" value="<?=$res['inventoryKey'];?>"/>
                                 
                            </tr>
                            <?php endwhile;?>
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