<!DOCTYPE html>
<html>
    <head>
    <title>Pickup History</title>
   <?php include'modules/header.php';?>
</head>
    <body>
       
        <?php include 'modules/navigate.php';?>
        <div id="client_mainContent">
        <?php include'modules/sidebarnav.php';?>
       <?php
        $errors=array();
            if($user_cookie_type==1){
               $sql="select * from pickup_order where userKey='$user_uname' and usertype='$user_cookie_type'";  
            }else{
                $sql="select * from pickup_order where userKey='$cop_uname' and usertype='$user_cookie_type'"; 
            }
       
        $query=$dbconnect->query($sql);
        if(isset($_POST['submit'])){
            $id=mysqli_real_escape_string($dbconnect,$_POST['id']);
            $code=mysqli_real_escape_string($dbconnect,$_POST['code']);
            $dbconnect->query("update payment set mpesaCode='$code',paymentStatus=1 where pickupKey='$id'");
            echo('<script> location.replace("orderhistory.php?payment='.$id.'");</script>');
        }
        if(isset($_POST['tracksubmit'])){
            $trackid=mysqli_real_escape_string($dbconnect,$_POST['trackid']);
            $shipping=mysqli_real_escape_string($dbconnect,$_POST['shipping']);
            $address=mysqli_real_escape_string($dbconnect,$_POST['address']);
            $date=mysqli_real_escape_string($dbconnect,$_POST['date_in']);
            $time=mysqli_real_escape_string($dbconnect,$_POST['time_in']);
            $statement="insert into track(pickup_id,shippingStatus,location,currentTime,currentDate)values('$trackid','$shipping','$address','$time','$date')";
            $query=$dbconnect->query($statement);
            if($query){
                echo('<script> location.replace("orderhistory.php");</script>');
                echo("<div class='btn-warning'>Tracking Information has Been Saved</div>");
            }
        }
        if(isset($_GET['items'])){
        $id=$_GET['items'];
        $getsql="select * from pickup_order where pickupKey='$id'";
        $getresult=mysqli_fetch_assoc($dbconnect->query($getsql));
        $cartid=$getresult['cartKey'];
        $picksql="select * from inventory where cartKey='$cartid'";
        $pickquery=$dbconnect->query($picksql);
        }
        if(isset($_GET['trackinfo'])){
        $id=$_GET['trackinfo'];
        $getsql="select * from track where pickup_id='$id'";
        $gettrack=$dbconnect->query($getsql);
        }
        if(isset($_GET['payment'])){
        $id=$_GET['payment'];
        $getsql="select * from pickup_order where pickupKey='$id'";
        $getresult=mysqli_fetch_assoc($dbconnect->query($getsql));
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
        $getsql="select * from pickup_order where pickupKey='$id'";
        $getresult=mysqli_fetch_assoc($dbconnect->query($getsql));
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
            <?php include'discart.php';?>
            <?php include'../core/errors.php'?>
            <div class="container-fluid">
                
                <h2>PickUp Orders</h2>
                
                <?php if(isset($_GET['track'])):?>
                <div class="general_form">
                <h2>Fill Track Information</h2>
                <form class="form-group" method="post" action="orderhistory.php">
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
                     <?php if(isset($_GET['track'])):?><a href="orderhistory.php" class="btn form-control btn-md btn-success">Cancel</a><?php endif;?>
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
                    <a href="orderhistory.php" class="btn btn-md btn-success">Cancel</a>
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
                    <a href="orderhistory.php" class="btn btn-md btn-success">Cancel</a>
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
                    <a href="orderhistory.php" class="btn btn-md btn-success">Cancel</a>
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
                    <a href="orderhistory.php" class="btn btn-md btn-success">Cancel</a>
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
                                    <a class="btn btn-xs btn-danger" href="orderhistory.php?payment=<?=$res['pickupKey'];?>&pay=<?=$res['pickupKey'];?>">Payment Pending..</a>
                                    
                                    <?php endif;?>
                                    <?php else:?>
                                      <a class="btn btn-md btn-success" href="orderhistory.php?payment=<?=$res['recycler_paymentkey'];?>&track=<?=$res['pickup_number'];?>">Track Information</a>
                                    <a class="btn btn-md btn-success" href="orderhistory.php?payment=<?=$res['recycler_paymentkey'];?>&trackinfo=<?=$res['pickup_number'];?>">view Information</a>
                                    <?php endif;?>
                                </td>
                            </tr>
                            <?php endwhile;?>
                        </tbody>
                    </table>
                    <?php if(isset($_GET['pay'])):?>
                    <form class="col-md-4" method="post" action="orderhistory.php">
                    <input type="hidden" name="id" value="<?=$_GET['pay'];?>">
                    <input class="form-control" type="text" maxlength=20 minlength=20 placeholder="Enter MpesaCode" name="code" required/>
                    <input class="btn btn-md btn-primary" type="submit" name="submit" value="Pay User" />
                    </form>
                    <?php endif;?>
                    <a href="orderhistory.php" class="btn btn-md btn-success form-control">Cancel</a>
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
                                 <td><a class="btn btn-xs btn-success" href="orderhistory.php?user=<?=$res['pickupKey'];?>">View User</a></td>
                                <td><a class="btn btn-xs btn-warning" href="orderhistory.php?items=<?=$res['pickupKey'];?>">View Items</a></td>
                                <td><a class="btn btn-xs btn-danger" href="orderhistory.php?payment=<?=$res['pickupKey'];?>">View Payment</a></td>
                            </tr>
                            <?php endwhile;?>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    <?php include'modules/footer.php';?>
    </div>   
     
    </body>


</html>