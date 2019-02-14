<!DOCTYPE html>
<html>
    <head>
    <title>Pickup</title>
  <?php include'modules/header.php';?>
</head>
    <body>
       
        <?php include 'modules/navigate.php';?>
        <div id="client_mainContent">
        <?php include'modules/sidebarnav.php';?>
        <?php
        $errors=array();
        $sql="select * from pickup_order where userKey='$recycler_uname' and userType=3";
        $query=$dbconnect->query($sql);
        
        if(isset($_GET['items'])){
        $id=$_GET['items'];
        $getsql="select * from pickup_order where pickupKey='$id'";
        $getresult=mysqli_fetch_assoc($dbconnect->query($getsql));
        $cartid=$getresult['cartKey'];
        $picksql="select * from inventory where recycler_cart='$cartid'";
        $pickquery=$dbconnect->query($picksql);
        }
        
        if(isset($_GET['payment'])){
        $id=$_GET['payment'];
        $getsql="select * from pickup_order where pickupKey='$id' and userType=3";
        $getresult=mysqli_fetch_assoc($dbconnect->query($getsql));
        $pickid=$getresult['pickupKey'];
       
        $paysql="select * from recycler_payment where pickup_number='$pickid'";
        $payquery=$dbconnect->query($paysql);
        }
        if(isset($_GET['trackinfo'])){
        $id=$_GET['trackinfo'];
        $getsql="select * from track where pickup_id='$id'";
        $gettrack=$dbconnect->query($getsql);
        }
        
       
        
        
        ?>
        <div class="submain_content">
            <?php include'../core/errors.php'?>
             <?php include'discart.php'?>
            <div class="container-fluid">
                
                <h2>PickUp Orders</h2>
        <?php if(isset($_GET['trackinfo'])):?>
                 <div class="general_table">
                    <h3>Current Locations</h3>
                    <table class="table table-bordered table-responsive">
                        <tbody>
                            <th>No</th>
                            <th>PickUp Id</th>
                            <th>Shipping Status</th>
                            <th>Location</th>
                            <th>currentTime</th>
                            <th>currentDate</th>
                        </tbody>
                        <tbody>
                            <?php while($res=mysqli_fetch_assoc($gettrack)):?>
                            <tr>
                                <td><?=$res['id'];?></td>
                                 <td><?=$res['pickup_id'];?></td>
                                 <td><?=$res['shippingStatus'];?></td>
                                 <td><?=$res['location'];?></td>
                                 <td><?=$res['currentTime'];?></td>
                                 <td><?=$res['currentDate'];?></td>
                            </tr>
                            <?php endwhile;?>
                        </tbody>
                    </table>
                    <a href="pickup.php" class="btn btn-md btn-success">Cancel</a>
                </div>
                <?php endif;?>
                <?php if(isset($_GET['items'])):?>
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
                    <a href="pickup.php" class="btn btn-md btn-success">Cancel</a>
                </div>
                 <?php endif;?>
                <?php if(isset($_GET['payment'])):?>
                <div class="general_table">
                    <h3>Payment Status</h3>
                    <table class="table table-bordered table-responsive">
                        <tbody>
                            <th>No</th>
                            <th>pickupId</th>
                            <th>Amount</th>
                            <th>MpesaCode</th>
                            <th>Payment Status</th>
                            </tbody>
                        <tbody>
                            <?php while($res=mysqli_fetch_assoc($payquery)):
                             $paystate=$res['paymentStatus'];
                            ?>
                            <tr>
                                 <td><?=$res['recycler_paymentkey'];?></td>
                                <td><?=$res['pickup_number'];?></td>
                                <td><?=$res['ammount'];?></td>
                                 <td><?=$res['mpesaCode'];?></td>
                                <td>
                                    <a class="btn btn-md btn-success">User Already Paid</a>
                                </td>
                            </tr>
                            <?php endwhile;?>
                        </tbody>
                    </table>
                    <?php if(isset($_GET['pay'])):?>
                    <form class="col-md-4" method="post" action="orders.php">
                    <input type="hidden" name="id" value="<?=$_GET['pay'];?>">
                    <input class="form-control" type="text" maxlength=20 minlength=20 placeholder="Enter MpesaCode" name="code" required/>
                    <input class="btn btn-md btn-primary" type="submit" name="submit" value="Pay User" />
                    </form>
                    <?php endif;?>
                    <a href="pickup.php" class="btn btn-md btn-success form-control">Cancel</a>
                </div>
                 <?php endif;?>
                <div class="general_table">
                    <h3>Placed Pickup Orders</h3>
                    <table class="table table-bordered table-responsive">
                        <tbody>
                            <th>No</th>
                            <th>CartId</th>
                            <th>userId</th>
                             <th>usertype</th>
                            <th>Ammount due</th>
                            <th>Track PickUp</th>
                            <th>ViewItems</th>
                            <th>ViewPayment</th>
                        </tbody>
                        <tbody>
                            <?php while($res=mysqli_fetch_assoc($query)):?>
                            <tr>
                                <td><?=$res['pickupKey'];?></td>
                                 <td><?=$res['cartKey'];?></td>
                                 <td><?=$res['userKey'];?></td>
                                 <td><?=$res['usertype'];?></td>
                                 <td><?=$res['amountPayable'];?></td>
                               
                                 <td><a class="btn btn-xs btn-success" href="pickup.php?trackinfo=<?=$res['pickupKey'];?>">Track</a></td>
                                <td><a class="btn btn-xs btn-warning" href="pickup.php?items=<?=$res['pickupKey'];?>">View Items</a></td>
                                <td><a class="btn btn-xs btn-danger" href="pickup.php?payment=<?=$res['pickupKey'];?>">View Payment</a></td>
                            </tr>
                            <?php endwhile;?>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
            <?php include'modules/footer.php';?>
    </body>
</html>
