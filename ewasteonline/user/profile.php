<!DOCTYPE html>
<html>
    <head>
    <title>My Profile</title>
   <?php include'modules/header.php';?>
</head>
    <body>
       
        <?php include 'modules/navigate.php';?>
        <div id="client_mainContent">
        <?php include'modules/sidebarnav.php';?>
             <?php
        $errors=array();
              if($user_cookie_type==1){
                $sql="select * from customer where userKey='$user_uname'";
        $query=$dbconnect->query($sql);
        if(isset($_POST['submit'])){
          
             $fn=mysqli_real_escape_string($dbconnect,$_POST['fn']);
             $ln=mysqli_real_escape_string($dbconnect,$_POST['ln']);
             $un=mysqli_real_escape_string($dbconnect,$_POST['un']);
             $pass=mysqli_real_escape_string($dbconnect,$_POST['pass']);
             $dob=mysqli_real_escape_string($dbconnect,$_POST['dob']);
             $mail=mysqli_real_escape_string($dbconnect,$_POST['email']);
            $mob=mysqli_real_escape_string($dbconnect,$_POST['mobile']);
             $nat=mysqli_real_escape_string($dbconnect,$_POST['nat']);
            $loc=mysqli_real_escape_string($dbconnect,$_POST['loc']);
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
                $insertsql=$dbconnect->prepare("update customer set FirstName=?,LastName=?,UserName=?,Password=?,DateOfBirth=?,email=?,Phone=?,nationalid=?,Location=?,image=? where userKey=?");
                $insertsql->bind_param("ssssssssssi",$fn,$ln,$un,$pass,$dob,$mail,$mob,$nat,$loc,$finimg,$postid);
            }
            
            if(count($errors)==0){
               $insertsql->execute();
            if($insertsql){
                $_SESSION['messagedis']="Profile Has Been Updated";
               echo('<script> location.replace("profile.php");</script>');
                
            }else{
                array_push($errors,mysqli_error($dbconnect));
            } 
            }
            
        }
        
        if(isset($_GET['edit'])){
            $id=$_GET['edit'];
            $editid=$_GET['edit'];
            $getsql="select * from customer where userKey='$id'";
            $getqery=$dbconnect->query($getsql);
            $getres=mysqli_fetch_assoc($getqery);
              if(isset($_GET['delete_img'])){
                        $img_url=$_SERVER['DOCUMENT_ROOT'].$getres['image'];
                            unlink($img_url);
                
                        $dbconnect->query("update customer set image='' where userkey='$id'");
                  $_SESSION['messagedis']="Image Has Been Deleted.Insert New one.";
                       echo('<script> location.replace("profile.php?edit='.$editid.'");</script>');
                    }
            
        }
        
        if(isset($_GET['delete'])){
            $id=$_GET['delete'];
            $delsql="delete from customer where userKey='$id'";
            $delquery=$dbconnect->query($delsql);
           echo('<script> location.replace("profile.php");</script>');
        }
            }else{
                $sql="select * from cooperation where userKey='$cop_uname'";
        $query=$dbconnect->query($sql);
        if(isset($_POST['submit'])){
             $n=mysqli_real_escape_string($dbconnect,$_POST['names']);
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
            $photomime=explode('/',$photo['type']);
            $phototype=$photomime[0];
            $photoext=$photomime[1];
            $allowed_extensions = array("jpg","jpeg","png","gif");
            $uploadpath=BASEURL.'images/';
            $uploadname=$photoname;
            $dbphotopath=$uploadpath.$uploadname;
            $finimg='/ewasteonline/images/'.$photoname;
            if(!in_array($photoext,$allowed_extensions)){
                $_SESSION['messagedis']="the file is not an acceptable format";
            }elseif($photosize>15360000){
                $_SESSION['messagedis']="file size is too big";
            }else{
                 move_uploaded_file($photoloc,$dbphotopath);
            } 
       }else{
                $finimg=$_POST['vimg'];
            }
             if($_POST['id']!=null){
                $postid=$_POST['id'];
                $insertsql=$dbconnect->prepare("update cooperation set Names=?,companyEmail=?,phonenumber=?,companyAddress=?,location=?,password=?,image=? where userKey=?");
                $insertsql->bind_param("sssssssi",$n,$mail,$mob,$address,$loc,$pass,$finimg,$postid);
                  
            }
            
            if(count($errors)==0){
               $insertsql->execute();
            if($insertsql){
                $_SESSION['messagedis']="Profile Has Been Updated";
               echo('<script> location.replace("profile.php");</script>');
                
            }else{
               $_SESSION['messagedis']=mysqli_error($dbconnect);
            } 
            }
            
        }
        
        if(isset($_GET['edit'])){
            $id=$_GET['edit'];
            $editid=$_GET['edit'];
            $getsql="select * from cooperation where userKey='$id'";
            $getqery=$dbconnect->query($getsql);
            $getres=mysqli_fetch_assoc($getqery);
              if(isset($_GET['delete_img'])){
                        $img_url=$_SERVER['DOCUMENT_ROOT'].$getres['image'];
                            unlink($img_url);
                
                        $dbconnect->query("update cooperation set image='' where userkey='$id'");
                  $_SESSION['messagedis']="Image Has Been Deleted.Insert New one.";
                       echo('<script> location.replace("profile.php?edit='.$editid.'");</script>');
                    }
            
        }
        
        if(isset($_GET['delete'])){
            $id=$_GET['delete'];
            $delsql="delete from cooperation where userKey='$id'";
            $delquery=$dbconnect->query($delsql);
           echo('<script> location.replace("profile.php");</script>');
        }
            }
        
        
        ?>
        <div class="submain_content">
            <?php include'discart.php';?>
           <div id="messagedis"><p><?=$messagedis;?></p></div>
            <div class="container-fluid">
                <h2 style="margin-left:30px;"><?=(($user_cookie_type==1)?'Customer Profile':'Corporation profile');?></h2>
                <?php if($user_cookie_type==1):?>
                <?php if(isset($_GET['edit'])):?>
                <div class="general_form">
                <h2>Fill In details</h2>
                <form class="form-group" method="post" action="profile.php" enctype="multipart/form-data">
                     <input type="hidden" value="<?=((isset($_GET['edit']))?$getres['userKey']:'');?>" name="id">
                    <div class="col-md-4">
                    <input class="form-control" type="text" name="fn" placeholder="Enter Firstname" value="<?=((isset($_GET['edit']))?$getres['FirstName']:'');?>" required/>
                    <input class="form-control" type="text" name="ln" placeholder="Enter lastname" value="<?=((isset($_GET['edit']))?$getres['LastName']:'');?>" required/>
                    <input class="form-control" type="text" name="un" placeholder="Enter Username" value="<?=((isset($_GET['edit']))?$getres['UserName']:'');?>" required/>
                    <input class="form-control" type="password" id="password" name="pass" placeholder="Enter Password" value="<?=((isset($_GET['edit']))?$getres['Password']:'');?>" required/>
                    </div>
                     <div class="col-md-4">
                    <input class="form-control" type="password" id="cpassword" name="re-pass" placeholder="Re-Enter Password" value="<?=((isset($_GET['edit']))?$getres['Password']:'');?>" required/>
                    <input class="form-control" type="email" name="email" onclick="verify()" placeholder="Enter Email" value="<?=((isset($_GET['edit']))?$getres['email']:'');?>" required/>
                    <input class="form-control" type="date" id="date" name="dob" placeholder="Enter Date Of Birth" value="<?=((isset($_GET['edit']))?$getres['DateOfBirth']:'');?>" required/>
                    <input class="form-control" type="text" id="mobile" name="mobile" value="<?=((isset($_GET['edit']))?$getres['Phone']:'07');?>" required/>
                    </div>
                     <div class="col-md-4">
                    <input class="form-control" type="text" name="nat" onclick="verifyPhone()" maxlength=8 placeholder="Enter National Id" value="<?=((isset($_GET['edit']))?$getres['nationalid']:'');?>" required/>
                         <?php if(isset($_GET['edit']) && $getres['image']!=''):?>
                         <img class="img-thumbnail img-rounded" src="<?=$getres['image'];?>"/>
                         <input type="hidden" name="vimg" value="<?=$getres['image'];?>">
                         <a href="profile.php?delete_img=1&edit=<?=$getres['userKey'];?>" class="btn btn-danger"> delete</a>
                         <?php else:?>
                    <input class="form-control" onclick="verifyNat()" type="file" name="img" required/>
                         <?php endif;?>
                    <input class="form-control" type="text" id="loc" name="loc" placeholder="Enter Home Location" value="<?=((isset($_GET['edit']))?$getres['Location']:'');?>" required/>
                    <input class="form-control btn btn-md btn-primary" type="submit" name="submit" value="<?=((isset($_GET['edit']))?'Edit':'Add');?> Customer"/>
                         <?php if(isset($_GET['edit'])):?><a href="profile.php" class="btn form-control btn-md btn-success">Cancel</a><?php endif;?>
                    </div>
                    
                </form>
                </div>
                <?php endif;?>
                <?php else:?>
                 <?php if(isset($_GET['edit'])):?>
                     <div class="general_form">
                <h2>Fill In details</h2>
                <form class="form-group" method="post" action="profile.php" enctype="multipart/form-data">
                     <input type="hidden" value="<?=((isset($_GET['edit']))?$getres['userKey']:'');?>" name="id">
                    <div class="col-md-4">
                    <input class="form-control" type="text" name="names" placeholder="Enter Company Name" value="<?=((isset($_GET['edit']))?$getres['Names']:'');?>" required/>
                    <input class="form-control" type="email" name="email" placeholder="Enter Company Email" value="<?=((isset($_GET['edit']))?$getres['companyEmail']:'');?>" required/>
                    <input class="form-control" type="text" name="mob" id="copphone" placeholder="Enter Company phonenumber" value="<?=((isset($_GET['edit']))?$getres['phonenumber']:'');?>" required/>
                   
                    </div>
                     <div class="col-md-4">
                    <input class="form-control" type="text" onclick="verifycop()" name="address" placeholder="Enter Company Address" value="<?=((isset($_GET['edit']))?$getres['companyAddress']:'');?>" required/>
                    <input class="form-control" type="password" id="password" name="pass" placeholder="Enter Password" value="<?=((isset($_GET['edit']))?$getres['password']:'');?>" required/>
                    <input class="form-control" type="password" id="cpassword" name="re-pass" placeholder="Re-Enter Password" value="<?=((isset($_GET['edit']))?$getres['password']:'');?>" required/>
                   
                    </div>
                     <div class="col-md-4">
                     <input class="form-control" type="text" name="loc" onclick="verify()" placeholder="Enter Location" value="<?=((isset($_GET['edit']))?$getres['location']:'');?>" required/>
                         <?php if(isset($_GET['edit']) && $getres['image']!=''):?>
                         <img class="img-thumbnail img-rounded" src="<?=$getres['image'];?>"/>
                         <input type="hidden" name="vimg" value="<?=$getres['image'];?>">
                         <a href="profile.php?delete_img=1&edit=<?=$getres['userKey'];?>" class="btn btn-danger"> delete</a>
                         <?php else:?>
                    <input class="form-control" type="file" name="img" required/>
                         <?php endif;?>
                    <input class="form-control btn btn-md btn-primary" type="submit" name="submit" value="<?=((isset($_GET['edit']))?'Edit':'Add');?> Corporation"/>
                         <?php if(isset($_GET['edit'])):?><a href="profile.php" class="btn form-control btn-md btn-success">Cancel</a><?php endif;?>
                    </div>
                    
                </form>
                </div>
                <?php endif;?>
                <?php endif;?>
                <div class="general_table col-md-12">
                    <h3 style="margin-left:16px;">Your Current Profile Image</h3>
                    <div class="profile ">
                        <?php $res=mysqli_fetch_assoc($query);?>
                        <div class=" col-md-4">
                            <img class="profile_img img-thumbnail" src="<?=$res['image'];?>"/>
                        </div>
                        <div class="profile_info col-md-8">
                                <?php if($user_cookie_type==1):?>
                                <h3>FirstName: <?=$res['FirstName'];?></h3>
                                 <h3>LastName: <?=$res['LastName'];?></h3>
                                 <h3>UserName: <?=$res['UserName'];?></h3>
                                 <h3>Password: <?=$res['Password'];?></h3>
                                 <h3>Date Of Birth: <?=$res['DateOfBirth'];?></h3>
                                 <h3>Email: <?=$res['email'];?></h3>
                                 <h3>PhoneNumber: <?=$res['Phone'];?></h3>
                                 <h3>NationalId: <?=$res['nationalid'];?></h3>
                                 <h3>Location: <?=$res['Location'];?></h3>
                            <?php else:?>
                              <h3>CompanyName: <?=$res['Names'];?></h3>
                                 <h3>Email: <?=$res['companyEmail'];?></h3>
                                 <h3>PhoneNumber: <?=$res['phonenumber'];?></h3>
                                 <h3>Location Address: <?=$res['companyAddress'];?></h3>
                                 <h3>Location: <?=$res['location'];?></h3>
                                 <h3>Password: <?=$res['password'];?></h3>
                            <?php endif;?>
                            <a href="profile.php?edit=<?=$res['userKey'];?>" class="btn btn-md btn-primary">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>   
     <?php include'modules/footer.php';?>  
     
    </body>


</html>