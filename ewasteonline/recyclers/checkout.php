<?php include 'modules/header.php';?>
<?php
$dormain=(($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false);
  if(isset($_POST['submit'])){
    $type=$_POST['usertype'];
    $total=$_POST['totalamount'];
      $code=$_POST['code'];
    $orderst=$dbconnect->prepare("insert into pickup_order(cartKey,userKey,usertype,amountPayable)values(?,?,?,?)");
      $orderst->bind_param("iiid",$cart_id,$recycler_uname,$type,$total);
      $orderst->execute();
     $orderid=$dbconnect->insert_id;
      $orderst->close();
      if($orderst){
        $paymentst=$dbconnect->prepare("insert into recycler_payment(pickup_number,recyclerKey,ammount,mpesaCode,paymentStatus)values(?,?,?,?,?)");
          $pst=1;
          $paymentst->bind_param("iidsi",$orderid,$recycler_uname,$total,$code,$pst);
            $paymentst->execute();
          if($paymentst){
               $dormain=(($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false);

            setcookie(CART_COOKIE,'',1,'/',$dormain,false);
          }else{
              array_push($errors,mysqli_error($dbconnect));
          }
          
          ?>
<!DOCTYPE html>
<html>
    <head>
    <title>CheckOut | recycler</title>
</head>
    <body>
       
        <?php include 'modules/navigate.php';?>
        <div id="client_mainContent">
        <?php include'modules/sidebarnav.php';?>
        <?php
        $errors=array();
        ?>
        <div class="submain_content">
            <?php include'../core/errors.php'?>
              <?php include'discart.php'?>
            <div class="container-fluid">
                <h2>CheckOut</h2>
<div class="text-center thanks" style="color:#7b68ee;">
  
    <h1>THANK YOU FOR BUY YOUR EWASTE TO US. HELP KEEP ENVIROMENT HABITABLE</h1>
    
</div>
            </div>
            </div>
        </div>
    </body>
</html>
<?php
      }else{
          echo("failed try again later");
      }
   
    }
?>
<?php ob_start();?>

<div class="modal fade details-1" id="checkoutmodal" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <button class="close" type="button" onclick="closecheckoutmodal()" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title text-center">SHIPPING INFORMATION DEATAILS</h4>
             <h4 class="modal-title text-center">PAY TO:0723664772 VIA MPESA</h4>
        </div>
        
        <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <span id="modals_error" class="bg-danger"></span>
                
                <div class="col-md-12">
                    <form action="checkout.php" method="post" id="add_product_form">
                        <?php
                  $st="select * from recycler where recyclerKey='$recycler_uname'";
                  $stquery=$dbconnect->query($st);
                  $stres=mysqli_fetch_assoc($stquery);
                  ?>
                        <div class="form-group">
                            <div class="col-md-4">
                            <input class="form-control" type="email" name="email" placeholder="enter Email" value="<?=$stres['recyclerEmail'];?>" required/>
                            <input class="form-control" type="text" name="address" placeholder="enter Address" value="<?=$stres['recyclerAddress'];?>" required/>
                            <input class="form-control" type="text" name="mobile" placeholder="enter PhoneNumber" value="<?=$stres['recyclerPhone'];?>" required/>
                            <input class="form-control" type="text" name="loc" placeholder="enter Location" value="<?=$stres['recyclerLocation'];?>" required/>
                            </div>
                            <div class="col-md-4">
                            <input class="form-control" type="text" name="user" style="color:#7b68ee; border-color:#7b68ee;" placeholder="UserType" value="Registered Recycler" readonly required/>
                            <input type="hidden" name="usertype" placeholder="UserType" value="3" required/>
            <select class="form-control" name="types" style="border-radius: 20px; margin-bottom:20px;">
                  <option value="mpesa">mpesa</option>
                </select>
                <input class="form-control" type="text" name="code" placeholder="mpesa transaction code" required/>
                <input class="form-control" type="number" style="color:#7b68ee; border-color:#7b68ee;" name="totalamount" id="totalamount" value="<?=$_POST['total'];?>" readonly/>
                    </div>
                        </div>
                        
                        <div class=" text-center">
            <input id="fini" type="submit" name="submit" class="btn btn-warning" value="Finish"/>
            
        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
        
        </div>
    </div>
</div>
<script src="js/modals.js"></script>
<?php echo ob_get_clean();?>

