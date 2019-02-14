<!DOCTYPE html>
<html lang="en">
<head>
  <title>Search Inventory</title>
  <?php include'modules/header.php';?>
</head>
<body>
    <?php include'modules/navigate.php';?>
    <div id="mainContent">
  <?php include'modules/sidebarnav.php';?>
        <?php
        $errors=array();
        if(isset($_POST['search'])){
             $search=mysqli_real_escape_string($dbconnect,$_POST['searchtxt']);
                $search="%$search%";
                $picksql=$dbconnect->prepare("select deviceKey,manuKey,deviceName,price,image from device where deviceName like ?");      
            }
        ?>
        
        
       
        <div class="submain_content">
            <?php include'discart.php';?>
            <?php include'../core/errors.php'?>
            <div class="container-fluid">
                <h2>DEVICES</h2>
                            <?php if($picksql &&
                                     $picksql->bind_param("s",$search) &&
                                     $picksql->execute() &&
                                     $picksql->store_result() &&
                                     $picksql->bind_result($deviceKey,$manuKey,$deviceName,$price,$image)):
                            while($picksql->fetch()):
                            ?>
                <div class="display_items">
            <div class="text-center col-md-3 ">
             
                <h4><?=$deviceName;?></h4>
                <div class="col-md-12">
                   
                    <img class="display_img" src="<?=$image;?>"/>
                    <h4>price: Ksh.<?=$price;?></h4>
                    <button class="btn btn-md btn-primary" onclick='modalopen("<?=$deviceKey;?>")'><h5>AddToCart</h5></button>
                </div>
                
   
            </div>
                </div>
                <?php endwhile;?>
                <?php else:?>
                <p>failed</p>
                <?php endif; $picksql->close();?>
            </div>
        </div>
    </div>
    <?php include'modules/footer.php';?>
</body>
</html>