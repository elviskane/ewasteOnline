<!DOCTYPE html>
<html lang="en">
<head>
  <title>Inventory</title>
  <?php include'modules/header.php';?>
</head>
<body>
    <?php include'modules/navigate.php';?>
    <div id="mainContent">
  <?php include'modules/sidebarnav.php';?>
        <?php
        $errors=array();
        $picksql=$dbconnect->query("select * from inventory");
        ?>
        <div class="submain_content">
            <?php include'../core/errors.php'?>
            <div class="container-fluid">
                <h2>Inventory</h2>
            <div class="general_table">
                    <h3>Pickup Items</h3>
                    <table class="table table-bordered table-responsive">
                        <tbody>
                            <th>No</th>
                            <th>CartId</th>
                            <th>DeviceId</th>
                            <th>RecyclerId</th>
                            <th>DeviceName</th>
                            <th>SerialNumber</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Age</th>
                            <th>SellDate</th>
                        </tbody>
                        <tbody>
                            <?php while($res=mysqli_fetch_assoc($picksql)):?>
                            <tr>
                                <td><?=$res['inventoryKey'];?></td>
                                 <td><?=$res['cartKey'];?></td>
                                 <td><?=$res['deviceKey'];?></td>
                                 <td><?=$res['recyclerKey'];?></td>
                                <td><?=$res['deviceName'];?></td>
                                 <td><?=$res['serialNumber'];?></td>
                                 <td><?=$res['quantity'];?></td>
                                <td><?=$res['price'];?></td>
                                 <td><?=$res['age'];?></td>
                                <td><?=$res['sellDate'];?></td>
                                
                            <?php endwhile;?>
                                <?php $picksql->close();?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php include'modules/footer.php';?>
    <script>
    function assignRecycler(){
    
        alert(checked);
    }
    
    </script>
</body>
</html>