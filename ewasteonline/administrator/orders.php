<!DOCTYPE html>
<html lang="en">
<head>
  <title>Administrator</title>
  <?php include'modules/header.php';?>
</head>
<body>
    <?php include'modules/navigate.php';?>
    <div id="mainContent">
  <?php include'modules/sidebarnav.php';?>
        <?php
        $sql="select * from pickup_order";
        $query=$dbconnect->query($sql);
        if(isset($_POST['submit'])){
            $id=mysqli_real_escape_string($dbconnect,$_POST['id']);
            $code=mysqli_real_escape_string($dbconnect,$_POST['code']);
            $pst=1;
            $update=$dbconnect->prepare("update payment set mpesaCode=?,paymentStatus=? where pickupKey=?");
            $update->bind_param("sii",$code,$pst,$id);
            $update->execute();
            $update->close();
            $_SESSION['messagedis']="Payment Has Been Made";
            echo('<script> location.replace("orders.php?payment='.$id.'");</script>');
        }
        if(isset($_POST['tracksubmit'])){
            $trackid=mysqli_real_escape_string($dbconnect,$_POST['trackid']);
            $shipping=mysqli_real_escape_string($dbconnect,$_POST['shipping']);
            $address=mysqli_real_escape_string($dbconnect,$_POST['address']);
            $date=mysqli_real_escape_string($dbconnect,$_POST['date_in']);
            $time=mysqli_real_escape_string($dbconnect,$_POST['time_in']);
            $statement=$dbconnect->prepare("insert into track(pickup_id,shippingStatus,location,currentTime,currentDate)values(?,?,?,?,?)");
            $query=$dbconnect->query($statement);
            $statement->bind_param("iisss",$trackid,$shipping,$address,$time,$date);
            $statement->execute();
            if($statement){
                $_SESSION['messagedis']="Tracking information has Been Added";
              $statement->close();
                echo('<script> location.replace("orders.php");</script>');
            }
        }
        if(isset($_GET['items'])){
        $id=$_GET['items'];
        $getsql=$dbconnect->prepare("select * from pickup_order where pickupKey=?");
        $getsql->bind_param("i",$id);
        $getsql->execute();
        $getresult=$getsql->get_result()->fetch_array();
      
        $cartid=mysqli_real_escape_string($dbconnect,$getresult['cartKey']);
        $picksql=$dbconnect->query("select * from inventory where cartKey='$cartid'");
        }
        if(isset($_GET['trackinfo'])){
        $id=$_GET['trackinfo'];
        $getsql="select * from track where pickup_id='$id'";
        $gettrack=$dbconnect->query($getsql);
        }
        if(isset($_GET['payment'])){
        $id=$_GET['payment'];
        $getsql=$dbconnect->prepare("select * from pickup_order where pickupKey=?");
        $getsql->bind_param("i",$id);
            $getsql->execute();
        $getresult=$getsql->get_result()->fetch_array();
        $pickid=$getresult['pickupKey'];
        $type=$getresult['usertype'];
        if($type==3){
             $paysql="select * from recycler_payment where pickup_number='$pickid'";
        }else{
              $paysql="select * from payment where pickupKey='$pickid'";
        }

        $payquery=$dbconnect->query($paysql);
        }

        if(isset($_GET['user'])){
        $id=$_GET['user'];
        $getsql=$dbconnect->prepare("select * from pickup_order where pickupKey=?");
            $getsql->bind_param("i",$id);
            $getsql->execute();
            
        $getresult=$getsql->get_result()->fetch_array();
        $userid=$getresult['userKey'];
        $usertype=$getresult['usertype'];
            if($usertype==1){
                $usersql="select * from customer where userKey='$userid'";
                $userquery=$dbconnect->query($usersql);
            }else{
                $copsql="select * from cooperation where userKey='$userid'";
                $copquery=$dbconnect->query($copsql);
            }


        }





        ?>
        <div class="submain_content">
             <div id="messagedis"><p><?=$messagedis;?></p></div>
            <div class="container-fluid">

                <h2>PickUp Orders</h2>

                <?php if(isset($_GET['track'])):?>
                <div class="general_form">
                <h2>Fill Track Information</h2>
                <form class="form-group" method="post" action="orders.php">
                    <div class="col-md-4">
                        <select name="shipping" class="form-control">
                            <option value="1">Shipping...</option>
                            <option value="2">Arrived</option>
                        </select>
                    <input class="form-control" type="text" name="trackid" placeholder="Enter pickup Id" value="<?=$_GET['track'];?>" required/>
                    </div>
                     <div class="col-md-4">
                    <input class="form-control" type="text" name="address" placeholder="Enter Current Shipping Location" required/>
                    <input class="form-control" type="date" name="date_in" value="<?php echo date('Y-m-d'); ?>" required/>

                    </div>
                     <div class="col-md-4">
                          <input class="form-control" type="time" name="time_in" value="<?=date('h:i');?>" required/>
                    <input class="form-control btn btn-md btn-primary" type="submit" name="tracksubmit" value="Submit Information"/>

                    </div>
                     <?php if(isset($_GET['track'])):?><a href="orders.php" class="btn form-control btn-md btn-success">Cancel</a><?php endif;?>
                </form>

                </div>
              <?php endif;?>

                <?php if(isset($_GET['user'])):?>
                <?php if($usertype==1):?>
                <div class="general_table">
                    <h3>Current Existing Customers</h3>
                    <table class="table table-bordered table-responsive">
                        <tbody>
                            <th>No</th>
                            <th>FistName</th>
                            <th>LastName</th>
                            <th>UserName</th>
                            <th>Password</th>
                            <th>Dob</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>NationalId</th>
                            <th>Location</th>
                            <th>Image</th>
                        </tbody>
                        <tbody>
                            <?php while($res=mysqli_fetch_assoc($userquery)):?>
                            <tr>
                                <td><?=$res['userKey'];?></td>
                                 <td><?=$res['FirstName'];?></td>
                                 <td><?=$res['LastName'];?></td>
                                 <td><?=$res['UserName'];?></td>
                                 <td><?=$res['Password'];?></td>
                                 <td><?=$res['DateOfBirth'];?></td>
                                 <td><?=$res['email'];?></td>
                                 <td><?=$res['Phone'];?></td>
                                 <td><?=$res['nationalid'];?></td>
                                 <td><?=$res['Location'];?></td>
                                 <td><?=$res['image'];?></td>
                            </tr>
                            <?php endwhile;?>
                        </tbody>
                    </table>
                    <a href="orders.php" class="btn btn-md btn-success">Cancel</a>
                </div>
                <?php else:?>
                <div class="general_table">
                    <h3>Current Existing Cooperations</h3>
                    <table class="table table-bordered table-responsive">
                        <tbody>
                            <th>No</th>
                            <th>CompanyName</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Location</th>
                            <th>Password</th>
                            <th>Image</th>
                        </tbody>
                        <tbody>
                            <?php while($res=mysqli_fetch_assoc($copquery)):?>
                            <tr>
                                <td><?=$res['userKey'];?></td>
                                 <td><?=$res['Names'];?></td>
                                 <td><?=$res['companyEmail'];?></td>
                                 <td><?=$res['phonenumber'];?></td>
                                 <td><?=$res['companyAddress'];?></td>
                                 <td><?=$res['location'];?></td>
                                 <td><?=$res['password'];?></td>
                                 <td><?=$res['image'];?></td>
                            </tr>
                            <?php endwhile;?>
                        </tbody>
                    </table>
                    <a href="orders.php" class="btn btn-md btn-success">Cancel</a>
                </div>
                <?php endif;?>
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
                            <?php while($res=mysqli_fetch_assoc($picksql)):?>
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
                            <?php $picksql->close();?>
                        </tbody>
                    </table>
                    <a href="orders.php" class="btn btn-md btn-success">Cancel</a>
                </div>
                 <?php endif;?>
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
                    <a href="orders.php" class="btn btn-md btn-success">Cancel</a>
                </div>
                <?php endif;?>
                <?php if(isset($_GET['payment'])):?>
                <div class="general_table">
                    <h3>Payment Status</h3>
                    <table class="table table-bordered table-responsive">
                        <tbody class="text-center">
                            <th>No</th>
                            <th>pickupId</th>
                            <th>MpesaCode</th>
                            <th>Payment Status</th>
                            <?php if($type!=3):?><th>Pay Users</th><?php else:?><th>View and Input track Info</th><?php endif;?>
                        </tbody>
                        <tbody>
                            <?php while($res=mysqli_fetch_assoc($payquery)):
                             $paystate=$res['paymentStatus'];
                            ?>
                            <tr>
                                <td><?=(($type!=3)? $res['paymentKey'] : $res['recycler_paymentkey']);?></td>
                                <td><?=(($type!=3)? $res['paymentKey'] : $res['pickup_number']);?></td>
                                 <td><?=$res['mpesaCode'];?></td>
                                 <td><?=$res['paymentStatus'];?></td>
                                <td>
                                    <?php if($type!=3):?>
                                    <?php if($paystate==1):?>
                                    <a class="btn btn-md btn-success">User Already Paid</a>
                                    <?php else:?>
                                    <a class="btn btn-xs btn-danger" href="orders.php?payment=<?=$res['pickupKey'];?>&pay=<?=$res['pickupKey'];?>">Pay Users</a>

                                    <?php endif;?>
                                    <?php else:?>
                                      <a class="btn btn-md btn-success" href="orders.php?payment=<?=$res['recycler_paymentkey'];?>&track=<?=$res['pickup_number'];?>">Track Information</a>
                                    <a class="btn btn-md btn-success" href="orders.php?payment=<?=$res['recycler_paymentkey'];?>&trackinfo=<?=$res['pickup_number'];?>">view Information</a>
                                    <?php endif;?>
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
                    <a href="orders.php" class="btn btn-md btn-success form-control">Cancel</a>
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
                            <th>ViewUser</th>
                            <th>ViewItems</th>
                            <th>ViewPayment</th>
                        </tbody>
                        <tbody>
                            <?php while($res=mysqli_fetch_assoc($query)):?>
                            <tr>
                                <td><?=$res['pickupKey'];?></td>
                                 <td><?=$res['cartKey'];?></td>
                                 <td><?=$res['userKey'];?></td>
                                 <td><?=$res['amountPayable'];?></td>
                                <td><?=$res['usertype'];?></td>
                                 <td><a class="btn btn-xs btn-success" href="orders.php?user=<?=$res['pickupKey'];?>">View User</a></td>
                                <td><a class="btn btn-xs btn-warning" href="orders.php?items=<?=$res['pickupKey'];?>">View Items</a></td>
                                <td><a class="btn btn-xs btn-danger" href="orders.php?payment=<?=$res['pickupKey'];?>">View Payment</a></td>
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
