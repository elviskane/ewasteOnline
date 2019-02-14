<!DOCTYPE html>
<html>
    <head>
    <title><?=((isset($_GET['bulk']))?'Bulk e-Waste':'Single e-Waste');?></title>
   <?php include'modules/header.php';?>
</head>
    <body>
       <?php
        $getst="select * from device";
        $getquery=$dbconnect->query($getst);
        $date=date('Y-m-d');
        if(isset($_POST["Import"]) && isset($_FILES['filecvs'])){
		
            
            $checkfile=$_FILES['filecvs'];
            $checkmime=explode('.',$checkfile['name']);
            $checkext=$checkmime[1];
            $allowed_extensions = array("csv");
            if(!in_array($checkext,$allowed_extensions)){
               $_SESSION['messagedis']="Not a valid file Select .csv file"; 
                  echo('<script> location.replace("ewaste.php?bulk");</script>');
                 
            }else{
		$filename=$_FILES["filecvs"]["tmp_name"];		
 
 
		 if($_FILES["filecvs"]["size"] > 0)
		 {
		  	$file = fopen($filename, "r");
	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
                    $name=$getData[0];
                    $serial=$getData[1];
                    $age=$getData[2];
                    $price=$getData[3];
                    $quantity=$getData[4];
                     $itemz=array();
                    $itemz[]=array(
                      'deviceKey' => 0,
                      'deviceName'  => $name,
                        'serialnumber' =>$serial,
                        'age' => $age,
                        'price'   => $price,
                        'quantity'=> $quantity
                    );

                    $dormain=(($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false);

                    if($user_cart_id != ""){
                      $cartqst="select * from cart where cartKey='{$user_cart_id}'";
                      $cartq=$dbconnect->query($cartqst);
                      $cartres=mysqli_fetch_assoc($cartq);
                      $prevous_items=json_decode($cartres['cartItems'],true);
                      $itemz_match=0;
                      $new_items=array();
                      foreach ($prevous_items as $pitems) {

                        $new_items[] = $pitems;
                      }
                      if($itemz_match != 1){
                        $new_items=array_merge($itemz,$prevous_items);
                      }else{
                          echo("<script>alert('E-waste has already Been Added');</script>");
                      }
                      $items_json=json_encode($new_items);
                      $cart_expire=date("Y-m-d H:i:s",strtotime("+30 days"));
                      $cartupst="update cart set cartItems='{$items_json}' where cartKey='{$user_cart_id}'";
                      $dbconnect->query($cartupst);
                      setcookie(USER_CART_COOKIE,'',1,'/',$dormain,false);
                      setcookie(USER_CART_COOKIE,$user_cart_id,CART_COOKIE_EXPIRE,'/',$dormain,false);
                    }else{
                      $itemz_json = json_encode($itemz);
                      $cartst="insert into cart(cartItems)values('{$itemz_json}')";
                      $dbconnect->query($cartst);
                      $user_cart_id=$dbconnect->insert_id;
                      setcookie(USER_CART_COOKIE,$user_cart_id,CART_COOKIE_EXPIRE,'/',$dormain,false);
                    }
                   $result=$dbconnect->query("insert into inventory(cartKey,deviceName,serialNumber,quantity,price,age,selldate)values('$user_cart_id','$name','$serial','$quantity','$price','$age','$date')");
                $_SESSION['messagedis']="Ewaste Has Been Added To Cart"; 
	          
				if(!isset($result))
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"ewaste.php?bulk\"
						  </script>";		
				}
				else {
					  echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"ewaste.php?bulk\"
					</script>";
				}
	         }
			
	         fclose($file);	
		 }
            }
	}	 
        
        ?>
        <?php include 'modules/navigate.php';?>
        <div id="client_mainContent">
        <?php include'modules/sidebarnav.php';?>
        <div class="submain_content">
              <div id="messagedis"><p><?=$messagedis;?></p></div>
            <?php include'discart.php';?>
            <div class="container-fluid col-md-12">
                <?php if(isset($_GET['bulk'])):?>
                <h2>Bulk Waste</h2>
                <div class="csv">
                    <h2>Upload .CSV file Below</h2>
                    <form method="post" action="ewaste.php" enctype="multipart/form-data">
                     <input type="file" name="filecvs" id="file" class="input-large">
                    <input type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading..." value="import"/>
                        
                    </form>
                </div>
                <?php else:?>
            <?php while($display=mysqli_fetch_assoc($getquery)):?>
                <div class="display_items">
            <div class="text-center col-md-3 ">
             
                <h4><?=$display['deviceName'];?></h4>
                <div class="col-md-12">
                   
                    <img class="display_img" src="<?=$display['image'];?>"/>
                    <h4>price: Ksh.<?=$display['price'];?></h4>
                    <button class="btn btn-md btn-primary" onclick='modalopen("<?=$display['deviceKey'];?>")'><h5>AddToCart</h5></button>
                </div>
                
   
            </div>
                </div>
                <?php endwhile;?>
                <?php endif?>
            </div>
        </div>
            <?php include'modules/footer.php';?>
    </div>   
     
    </body>


</html>