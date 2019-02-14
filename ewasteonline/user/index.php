<!DOCTYPE html>
<html>
    <head>
    <title>Home</title>
    <?php include'modules/header.php';?>
</head>
    <body>
       <?php 
        if($user_cookie_type==1){
            $sql="select * from customer where userKey='$user_uname'";
        }else{
            $sql="select * from cooperation where userKey='$cop_uname'";
        }
        $result=mysqli_fetch_assoc($dbconnect->query($sql));
        ?>
        <?php include 'modules/navigate.php';?>
        <div id="client_mainContent">
        <?php include'modules/sidebarnav.php';?>
        <div class="submain_content">
            <?php include'discart.php';?>
            
            <div class="container-fluid">
                <h2>Welcome <?=(($user_cookie_type==1)?$result['UserName'] :$result['Names'] );?></h2>
                <?php include'modules/slider.php';?>
                 <h4>Cart shows Items placed that you wish to sell for a buyback value.<br/><br/>

Pickup Order History displays orders you have placed to our company and E-waste items that you sold
to Us.<br/><br/>

Profile Tab displays your information submitted during registration that conatins relevant information
for order tracking and payment roll outs. information can be modified if any updates are to be made.<br/><br/>

thank you select any Tab to continue and for any inquires please send us a feedback Through 
FEEDBACK tab.<br/><br/></h4>
               <div class="display_items col-md-12 text-center">
                    <div class="col-md-3">
                        <h3>Our Services</h3>
                        <h4>Offer PickUp Services</h4>
                        <h4>Data Destruction</h4>
                        <h4>E-waste Sorting</h4>
                        <h4>E-waste Standards Compliance</h4>
                        <h4>E-waste Disposal</h4>
                    </div>
                 <div class="col-md-3">
                     <h3>Our Prices</h3>
                     <h4>Our prices can be found at the device section.this contains offers we make irreguardless of device state.Same applies to bulk e-waste</h4>
                    </div>
                 <div class="col-md-3">
                     <h3>Vision</h3>
                      <h4>Reduces Toxic Waste</h4>
                      <h4>Protect Human Health</h4>
                      <h4>Reduce Strain On Natural resource By Recycling</h4>
                      <h4>Maintain life support conditions</h4>
                     
                    </div>
                 <div class="col-md-3">
                     <h3>Benefits</h3>
                    <h4>Reduces Toxic Waste</h4>
                      <h4>Protect Human Health</h4>
                      <h4>Offer Buyback Value</h4>
                      <h4>Maintain life support conditions</h4>
                   </div>
            </div>
                
        </div>
            <?php include'modules/footer.php';?>
    </div>   
        </div>
    </body>


</html>