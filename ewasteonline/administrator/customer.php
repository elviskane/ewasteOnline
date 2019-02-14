<!DOCTYPE html>
<html lang="en">
<head>
  <title>Customers</title>
  <?php include'modules/header.php';?>
</head>
<body>
    <?php include'modules/navigate.php';?>
    <div id="mainContent">
  <?php include'modules/sidebarnav.php';?>
        <?php
        $sql="select * from customer";
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
                echo('<script> location.replace("customer.php");</script>');
            }elseif($photosize>15360000){
                $_SESSION['messagedis']="file size is too big";
                echo('<script> location.replace("customer.php");</script>');
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
                $_SESSION['messagedis']="Customer Has Been Updated";
            
            }else{
                $insertsql=$dbconnect->prepare("insert into customer(FirstName,LastName,UserName,Password,DateOfBirth,email,Phone,nationalid,Location,image)values(?,?,?,?,?,?,?,?,?,?)");
                 $insertsql->bind_param("ssssssssss",$fn,$ln,$un,$pass,$dob,$mail,$mob,$nat,$loc,$finimg);
                $_SESSION['messagedis']="Customer Has Been Added";
            }
            
            if(count($errors==0)){
               $insertsql->execute();
                $insertsql->close();
            if($insertsql){
               echo('<script> location.replace("customer.php");</script>');
                
            }else{
               $_SESSION['messagedis']=mysqli_error($dbconnect);
            } 
            }
            
        }
        
        if(isset($_GET['edit'])){
            $id=$_GET['edit'];
            $editid=$_GET['edit'];
            $getsql=$dbconnect->prepare("select * from customer where userKey=?");
            $getsql->bind_param("i",$id);
            $getsql->execute();
            $getqery=$getsql->get_result()->fetch_array();
              if(isset($_GET['delete_img'])){
                        $img_url=$_SERVER['DOCUMENT_ROOT'].$getqery['image'];
                  echo $img_url;
                            unlink($img_url);
                
                        $update=$dbconnect->prepare("update customer set image='' where userkey=?");
                        $update->bind_param("i",$id);
                  $update->execute();
                  $update->close();
                       echo('<script> location.replace("customer.php?edit='.$editid.'");</script>');
                    }
            
        }
        
        if(isset($_GET['delete'])){
            $id=$_GET['delete'];
            $delsql=$dbconnect->prepare("delete from customer where userKey=?");
            $delsql->bind_param("i",$id);
                  $delsql->execute();
                  $delsql->close();
             $_SESSION['messagedis']="Customer Has Been Deleted";
           echo('<script> location.replace("customer.php");</script>');
        }
        
        ?>
        <div class="submain_content">
           <div id="messagedis"><p><?=$messagedis;?></p></div>
            <div class="container-fluid">
                <h2>Customers</h2>
                <?php if(isset($_GET['add']) || isset($_GET['edit'])):?>
                <div class="general_form">
                <h2>Fill In details</h2>
                <form class="form-group" method="post" action="customer.php" enctype="multipart/form-data">
                     <input type="hidden" value="<?=((isset($_GET['edit']))?$getqery['userKey']:'');?>" name="id">
                    <div class="col-md-4">
                    <input class="form-control" type="text" name="fn" placeholder="Enter Firstname" value="<?=((isset($_GET['edit']))?$getqery['FirstName']:'');?>" required/>
                    <input class="form-control" type="text" name="ln" placeholder="Enter lastname" value="<?=((isset($_GET['edit']))?$getqery['LastName']:'');?>" required/>
                    <input class="form-control" type="text" id="uname" type="text" name="un" placeholder="Enter Username" oninput="check_customer_uname()" value="<?=((isset($_GET['edit']))?$getqery['UserName']:'');?>" required/>
                    <input class="form-control" type="password" id="password" name="pass" placeholder="Enter Password" value="<?=((isset($_GET['edit']))?$getqery['Password']:'');?>" required/>
                    </div>
                     <div class="col-md-4">
                    <input class="form-control" type="password" id="cpassword" name="re-pass" placeholder="Re-Enter Password" value="<?=((isset($_GET['edit']))?$getqery['Password']:'');?>" required/>
                    <input class="form-control" type="email" id="email" name="email" onclick="verify()" placeholder="Enter Email" oninput="check_customer_email()" value="<?=((isset($_GET['edit']))?$getqery['email']:'');?>" required/>
                    <input class="form-control" type="date" id="date" name="dob" placeholder="Enter Date Of Birth" value="<?=((isset($_GET['edit']))?$getqery['DateOfBirth']:'');?>" required/>
                    <input class="form-control" type="text" id="mobile" name="mobile" minlength="10" maxlength="10" placeholder="Enter PhoneNumber" oninput="check_customer_phone()" value="<?=((isset($_GET['edit']))?$getqery['Phone']:'07');?>" required/>
                    </div>
                     <div class="col-md-4">
                    <input class="form-control" type="text" minlength="8" maxlength="8" onclick="verifyPhone()" name="nat" id="natid" oninput="check_customer_nat()" maxlength=8 placeholder="Enter National Id" value="<?=((isset($_GET['edit']))?$getqery['nationalid']:'');?>" required/>
                         <?php if(isset($_GET['edit']) && $getqery['image']!=''):?>
                         <img class="img-thumbnail img-rounded" src="<?=$getqery['image'];?>"/>
                         <input type="hidden" name="vimg" value="<?=$getqery['image'];?>">
                         <a href="customer.php?delete_img=1&edit=<?=$getqery['userKey'];?>" class="btn btn-danger"> delete</a>
                         <?php else:?>
                    <input class="form-control" onclick="verifyNat()" type="file" name="img" required/>
                         <?php endif;?>
                    <input class="form-control" type="text" id="loc" name="loc" placeholder="Enter Home Location" value="<?=((isset($_GET['edit']))?$getqery['Location']:'');?>" required/>
                    <input class="form-control btn btn-md btn-primary" type="submit" name="submit" value="<?=((isset($_GET['edit']))?'Edit':'Add');?> Customer"/>
                         <?php if(isset($_GET['edit'])):?><a href="customer.php" class="btn form-control btn-md btn-success">Cancel</a><?php endif;?>
                    </div>
                    
                </form>
                <?php else:?>
                    <a href="customer.php?add" class="a_custom btn btn-md btn-primary">Add New Customer</a>
                    <?php endif;?>
                <div>
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
                            <th>Action</th>
                        </tbody>
                        <tbody>
                            <?php while($res=mysqli_fetch_assoc($query)):?>
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
                                <td>
                                    <a class="btn btn-xs btn-warning" href="customer.php?edit=<?=$res['userKey'];?>">Edit</a>
                                    <a class="btn btn-xs btn-danger" href="customer.php?delete=<?=$res['userKey'];?>">Delete</a>
                                </td>
                            </tr>
                            <?php endwhile;?>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
    <?php include'modules/footer.php';?>
</body>
</html>