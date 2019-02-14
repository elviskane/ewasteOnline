<!DOCTYPE html>
<html>
    <head>
    <title>Profile</title>
    <?php include'modules/header.php';?>
</head>
    <body>
       
        <?php include 'modules/navigate.php';?>
        <div id="client_mainContent">
        <?php include'modules/sidebarnav.php';?>
            <?php
        $errors=array();
        $sql="select * from recycler where recyclerKey='$recycler_uname'";
        $query=$dbconnect->query($sql);
        if(isset($_POST['submit'])){
              $mail=mysqli_real_escape_string($dbconnect,$_POST['email']);
             $mob=mysqli_real_escape_string($dbconnect,$_POST['mob']);
             $address=mysqli_real_escape_string($dbconnect,$_POST['address']);
            $loc=mysqli_real_escape_string($dbconnect,$_POST['loc']);
             $pass=mysqli_real_escape_string($dbconnect,$_POST['pass']);
              if(isset($_FILES['img'])){
            $photo=$_FILES['img'];
            $photoname=$photo['name'];
            $photoloc=$photo['tmp_name'];
            $photosize=$photo['size'];
            $photomime=explode('/',$photo['name']);
            $phototype=$photomime[0];
            $photoext=$photomime[1];
            $allowed_extensions = array("jpg","jpeg","png","gif");
            $uploadpath=BASEURL.'images/';
            $uploadname=$photoname;
            $dbphotopath=$uploadpath.$uploadname;
            $finimg='/ewasteonline/images/'.$photoname;
            if(!in_array($photoext,$allowed_extensions)){
               $_SESSION['messagedis']="the file is not an acceptable format";
                echo('<script> location.replace("profile.php");</script>');
            }elseif($photosize>15360000){
                $_SESSION['messagedis']="file size is too big";
                echo('<script> location.replace("profile.php");</script>');
            }else{
                 move_uploaded_file($photoloc,$dbphotopath);
            } 
       }else{
                $finimg=$_POST['vimg'];
            }
            if($_POST['id']!=null){
                $postid=$_POST['id'];
                $insertsql=$dbconnect->prepare("update recycler set recyclerEmail=?,recyclerAddress=?,recyclerPhone=?,recyclerLocation=?,recyclerPassword=?,image=? where recyclerKey=?");
                $insertsql->bind_param("ssssssi",$mail,$address,$mob,$loc,$pass,$finimg,$postid);
            }else{
               $insertsql=$dbconnect->prepare("insert into recycler(recyclerEmail,recyclerAddress,recyclerPhone,recyclerLocation,recyclerPassword,image)values(?,?,?,?,?,?)");
                $insertsql->bind_param("ssssss",$mail,$address,$mob,$loc,$pass,$finimg);
            }
            
            if(count($errors==0)){
             $insertsql->execute();
            if($insertsql){
                $_SESSION['messagedis']="Profile Have Been Updated";
               echo('<script> location.replace("profile.php");</script>');
                
            }else{
                array_push($errors,mysqli_error($dbconnect));
            } 
            }
            
        }
        
        if(isset($_GET['edit'])){
            $id=$_GET['edit'];
            $editid=$_GET['edit'];
            $getsql=$dbconnect->prepare("select * from recycler where recyclerKey=?");
            $getsql->bind_param("i",$id);
            $getsql->execute();
            $getqery=$getsql->get_result()->fetch_array();
              if(isset($_GET['delete_img'])){
                        $img_url=$_SERVER['DOCUMENT_ROOT'].$getqery['image'];
                  echo $img_url;
                            unlink($img_url);
                
                      $update=$dbconnect->prepare("update recycler set image='' where recyclerKey=?");
                        $update->bind_param("i",$id);
                        $update->execute();
                        $update->close();
                  $_SESSION['messagedis']="Image Has Been Deleted. Please Insert New One.";
                       echo('<script> location.replace("profile.php?edit='.$editid.'");</script>');
                    }
            
        }        
        ?>
        <div class="submain_content">
               <div id="messagedis"><p><?=$messagedis;?></p></div>
                 <?php include'discart.php'?>
            <div class="container-fluid">
                 
            <h2 style="margin-left:30px;">Recycler</h2>
                <?php if(isset($_GET['edit'])):?>
                <div class="general_form">
                <h2>Fill In details</h2>
                <form class="form-group" method="post" action="profile.php" enctype="multipart/form-data">
                     <input type="hidden" value="<?=((isset($_GET['edit']))?$getqery['recyclerKey']:'');?>" name="id">
                    <div class="col-md-4">
                    <input class="form-control" type="email" name="email" placeholder="Enter Recycler Email" value="<?=((isset($_GET['edit']))?$getqery['recyclerEmail']:'');?>" required/>
                    <input class="form-control" type="text" name="address" placeholder="Enter Recycler Address" value="<?=((isset($_GET['edit']))?$getqery['recyclerAddress']:'');?>" required/>
                    <input class="form-control" type="text" name="mob" placeholder="Enter Recycler Mobile" value="<?=((isset($_GET['edit']))?$getqery['recyclerPhone']:'');?>" required/>
                    </div>
                     <div class="col-md-4">
                    <input class="form-control" type="password" id="password" name="pass" placeholder="Enter Password" value="<?=((isset($_GET['edit']))?$getqery['recyclerPassword']:'');?>" required/>
                    <input class="form-control" type="password" id="cpassword" name="re-pass" placeholder="Re-Enter Password" value="<?=((isset($_GET['edit']))?$getqery['recyclerPassword']:'');?>" required/>
                    <input class="form-control" type="text" name="loc" onclick="verify()" placeholder="Enter Recycler Location" value="<?=((isset($_GET['edit']))?$getqery['recyclerLocation']:'');?>" required/>
                    </div>
                     <div class="col-md-4">
                         <?php if(isset($_GET['edit']) && $getqery['image']!=''):?>
                         <img class="img-thumbnail img-rounded" src="<?=$getqery['image'];?>"/>
                         <input type="hidden" name="vimg" value="<?=$getqery['image'];?>">
                         <a href="profile.php?delete_img=1&edit=<?=$getqery['recyclerKey'];?>" class="btn btn-danger"> delete</a>
                         <?php else:?>
                    <input class="form-control" type="file" name="img" required/>
                         <?php endif;?>
                    <input class="form-control btn btn-md btn-primary" type="submit" name="submit" value="<?=((isset($_GET['edit']))?'Edit':'Add');?> Recycler"/>
                         <?php if(isset($_GET['edit'])):?><a href="profile.php" class="btn form-control btn-md btn-success">Cancel</a><?php endif;?>
                    </div>
                    
                </form>
                </div>
                 <?php endif;?>
                <div class="general_table col-md-12">
                    <h3 style="margin-left:15px;">Your Current Profile</h3>
                    <div class="profile ">
                        <?php $res=mysqli_fetch_assoc($query);?>
                        <div class=" col-md-4">
                            <img class="profile_img img-thumbnail" src="<?=$res['image'];?>"/>
                        </div>
                        <div class="profile_info col-md-8">
                            
                                 <h3>Email: <?=$res['recyclerEmail'];?></h3>
                                 <h3>Address: <?=$res['recyclerAddress'];?></h3>
                                 <h3>Mobile: <?=$res['recyclerPhone'];?></h3>
                                 <h3>Location: <?=$res['recyclerLocation'];?></h3>
                                 <h3>Password: <?=$res['recyclerPassword'];?></h3>
                            <a href="profile.php?edit=<?=$res['recyclerKey'];?>" class="btn btn-md btn-primary">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>   
     <?php include'modules/footer.php';?>
    </body>


</html>