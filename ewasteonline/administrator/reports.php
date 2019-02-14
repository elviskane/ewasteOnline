<!DOCTYPE html>
<html lang="en">
<head>
  <title>Reports</title>
  <?php include'modules/header.php';?>
</head>
<body>
    <?php include'modules/navigate.php';?>
    <div id="mainContent">
  <?php include'modules/sidebarnav.php';?>
        <?php
        $errors=array();
        $picksql="select * from inventory";
        $pickquery=$dbconnect->query($picksql);
        
        $sql="select * from recycler_payment";
        $query=$dbconnect->query($sql);
        ?>
        <div class="submain_content">
            <?php include'../core/errors.php'?>
            <div class="container-fluid">
                <h2>Administrator Reports</h2>
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
                            <th>Age</th>
                            <th>SellDate</th>
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
                                 
                            </tr>
                            <?php endwhile;?>
                        </tbody>
                    </table>
                   <a href="create.php?inventory" class="btn btn-md btn-primary">Create Inventory Report</a>
                </div>
                 <div class="general_table">
                    <h3>Payment Status</h3>
                    <table class="table table-bordered table-responsive">
                        <tbody>
                            <th>No</th>
                            <th>Recycler id</th>
                            <th>Recycler Email</th>
                            <th>Ammount</th>
                            <th>MpesaCode</th>
                            <th>Payment Status</th>
                            <th>Paystate</th>
                        </tbody>
                        <tbody>
                            <?php while($res=mysqli_fetch_assoc($query)):
                             $paystate=$res['paymentStatus'];
                            $recid=$res['recyclerKey'];
                            $recres=mysqli_fetch_assoc($dbconnect->query("select * from recycler where recyclerKey='$recid'"));
                            $names=$recres['recyclerEmail'];
                            ?>
                            <tr>
                                <td><?=$res['recycler_paymentkey'];?></td>
                                <td><?=$res['recyclerKey'];?></td>
                                <td><?=$names;?></td>
                                <td><?=$res['ammount'];?></td>
                                 <td><?=$res['mpesaCode'];?></td>
                                 <td><?=$res['paymentStatus'];?></td>
                                <td>
                                    <?php if($paystate==1):?>
                                    <a class="btn btn-md btn-success">Already Paid</a>
                                    <?php else:?>
                                     <a class="btn btn-md btn-success">Pending Payment</a>
                                    <?php endif;?>
                                </td>
                            </tr>
                            <?php endwhile;?>
                        </tbody>
                    </table>
                     <a href="create.php?pay" class="btn btn-md btn-primary">Create Payment Report</a>
                </div>
            </div>
        </div>
    </div>
    <?php include'modules/footer.php';?>
</body>
</html>