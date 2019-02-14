<?php include 'modules/header.php';?>
<?php
$dormain=(($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false);
if($user_cookie_type==1){
    $userKey=$user_uname;
    
}else{
    $userKey=$cop_uname;
}
  if(isset($_POST['submit'])){
    $type=$_POST['usertype'];
    $total=$_POST['totalamount'];
    $orderst=$dbconnect->prepare("insert into pickup_order(cartKey,userKey,usertype,amountPayable)values(?,?,?,?)");
     $orderst->bind_param("iiid",$user_cart_id,$userKey,$type,$total);
      $orderst->execute();
     $orderid=$dbconnect->insert_id;
      $orderst->close();
      
      if($orderst){
           $paymentst=$dbconnect->prepare("insert into payment(pickupKey,mpesaCode)values(?,?)");
          $st="pending....";
          $paymentst->bind_param("is",$orderid,$st);
          $paymentst->execute();
          $paymentst->close();
           $dormain=(($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false);

            setcookie(USER_CART_COOKIE,'',1,'/',$dormain,false);
          ?>
<!DOCTYPE html>
<html>
    <head>
    <title>CheckOut | Client</title>
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
                <h2>Inventory</h2>
<div class="text-center thanks" style="color:#7b68ee;">
  
    <h1>THANK YOU FOR SELL YOUR EWASTE TO US. HELP KEEP ENVIROMENT HABITABLE</h1>
    
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
            <h4 class="modal-title text-center" style="color:#7b68ee;">PICKUP INFORMATION DETAILS</h4>
        </div>
        
        <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <span id="modals_error" class="bg-danger"></span>
                
                <div class="col-md-12">
                    <form action="checkout.php" method="post" id="add_product_form">
                        <?php
                        if($user_cookie_type==1){
                            $st="select * from customer where userKey='$user_uname'";
                        }elseif($user_cookie_type==2){
                  $st="select * from cooperation where userKey='$cop_uname'";
                        }else{
                            
                        }
                  $stquery=$dbconnect->query($st);
                  $stres=mysqli_fetch_assoc($stquery);
                  ?>
                        <div class="form-group">
                            <div class="col-md-6">
                            <input class="form-control" type="email" name="email" placeholder="enter Email" value="<?=(($user_cookie_type==1)? $stres['email']: $stres['companyEmail']);?>" required/>
                            <input class="form-control" type="text" name="address" placeholder="enter Address" value="<?=(($user_cookie_type==1)? $stres['Location']: $stres['companyAddress']);?>" required/>
                            <input class="form-control" type="text" name="mobile" placeholder="enter PhoneNumber" value="<?=(($user_cookie_type==1)? $stres['Phone']: $stres['phonenumber']);?>" required/>
                            <input class="form-control" type="text" name="loc" placeholder="enter Location" value="<?=(($user_cookie_type==1)? $stres['Location']: $stres['location']);?>" required/>
                            </div>
                            <div class="col-md-6">
                            <input class="form-control" type="text" style="color:#7b68ee; border-color:#7b68ee;" name="user" placeholder="UserType" id="usertype" value="<?=(($user_cookie_type==1)? 'Registered Customer':'Registered Cooperation');?>" readonly required/>
                            <input type="hidden" name="usertype" placeholder="UserType" value="<?=(($user_cookie_type==1)? '1':'2');?>" required/>
                            <input class="form-control" type="number" style="color:#7b68ee; border-color:#7b68ee;" name="totalamount" id="totalamount" value="<?=$_POST['total'];?>" readonly/>
                            <input id="fini" type="submit" name="submit" class="btn btn-warning" value="Finish"/>
                    </div>
                        </div>
                        
                        <div class=" text-center">
           
            
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

