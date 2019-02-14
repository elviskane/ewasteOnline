<!DOCTYPE html>
<html lang="en">
<head>
  <title>Payment</title>
  <?php include'modules/header.php';?>
</head>
<body>
    <?php include'modules/navigate.php';?>
    <div id="mainContent">
  <?php include'modules/sidebarnav.php';?>
        <?php
                $errors=array();
                $sql="select * from recycler_payment";
                $query=$dbconnect->query($sql);
            ?>
        <div class="submain_content">
            <?php include'../core/errors.php'?>
            
            <div class="container-fluid">
                <h2>Recycler Payments</h2>
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
                            $recres=$dbconnect->prepare("select * from recycler where recyclerKey=?");
                            $recres->bind_param("i",$recid);
                            $recres->execute();
                            $rec=$recres->get_result()->fetch_assoc();
                            $names=$rec['recyclerEmail'];
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
                </div>
            </div>
        </div>
    </div>
    <?php include'modules/footer.php';?>
</body>
</html>