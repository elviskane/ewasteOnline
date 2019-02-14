<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cooperations</title>
<?php include'modules/header.php';?>
</head>
<body>
    <?php include'modules/navigate.php';?>
    <div id="mainContent">
  <?php include'modules/sidebarnav.php';?>
<?php
        $sql="select * from cooperation";
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
                echo('<script> location.replace("cooperation.php");</script>');
            }elseif($photosize>15360000){
                $_SESSION['messagedis']="file size is too big";
                echo('<script> location.replace("cooperation.php");</script>');
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
                $_SESSION['messagedis']='Corporation Has Been Updated';
            }else{
                $insertsql=$dbconnect->prepare("insert into cooperation(Names,companyEmail,phonenumber,companyAddress,location,password,image)values(?,?,?,?,?,?,?)");
                $insertsql->bind_param("sssssss",$n,$mail,$mob,$address,$loc,$pass,$finimg);
                $_SESSION['messagedis']='New Corporation Has Been Added';
            }
            
        
              $insertsql->execute();
                $insertsql->close();
            if($insertsql){
              echo('<script> location.replace("cooperation.php");</script>');
                
                
            }else{
                $_SESSION['messagedis']=mysqli_error($dbconnect);
            } 
                      
            
        }
        
        if(isset($_GET['edit'])){
            $id=$_GET['edit'];
            $editid=$_GET['edit'];
            $getsql=$dbconnect->prepare("select * from cooperation where userKey=?");
            $getsql->bind_param("i",$id);
            $getsql->execute();
            $getqery=$getsql->get_result()->fetch_array();
          
              if(isset($_GET['delete_img'])){
                        $img_url=$_SERVER['DOCUMENT_ROOT'].$getqery['image'];
                  echo $img_url;
                            unlink($img_url);
                
                        $update=$dbconnect->prepare("update cooperation set image='' where userkey=?");
                        $update->bind_param("i",$id);
                        $update->execute();
                  $update->close();
                 
                       echo('<script> location.replace("cooperation.php?edit='.$editid.'");</script>');
                    }
            
        }
        
        if(isset($_GET['delete'])){
            $id=$_GET['delete'];
            $delsql=$dbconnect->prepare("delete from cooperation where userKey=?");
            $delsql->bind_param("i",$id);
            $delsql->execute();
            $delsql->close();
             $_SESSION['messagedis']="Corporation Has Been Deleted";
           echo('<script> location.replace("cooperation.php");</script>');
        }
        
        ?>
        <div class="submain_content">
            <div id="messagedis"><p><?=$messagedis;?></p></div>
            <div class="container-fluid">
                <h2>Corporations</h2>
                <?php if(isset($_GET['add']) || isset($_GET['edit'])):?>
                <div class="general_form">
                <h2>Fill In details</h2>
                <form class="form-group" method="post" action="cooperation.php" enctype="multipart/form-data">
                     <input type="hidden" value="<?=((isset($_GET['edit']))?$getqery['userKey']:'');?>" name="id">
                    <div class="col-md-4">
                    <input class="form-control" type="text" id="copname" name="names" placeholder="Enter Company Name" oninput="check_cop_name()" value="<?=((isset($_GET['edit']))?$getqery['Names']:'');?>" required/>
                    <input class="form-control" type="email" id="copemail" name="email" oninput="check_cop_email()" placeholder="Enter Company Email" value="<?=((isset($_GET['edit']))?$getqery['companyEmail']:'');?>" required/>
                    <input class="form-control" minlength="10" maxlength="10" type="text" id="copphone" name="mob" oninput="check_cop_phone()" placeholder="Enter Company phonenumber" value="<?=((isset($_GET['edit']))?$getqery['phonenumber']:'');?>" required/>
                   
                    </div>
                     <div class="col-md-4">
                    <input class="form-control" type="text" name="address" onclick="verifycop()" placeholder="Enter Company Address" value="<?=((isset($_GET['edit']))?$getqery['companyAddress']:'');?>" required/>
                    <input class="form-control" type="password" id="password" name="pass" placeholder="Enter Password" value="<?=((isset($_GET['edit']))?$getqery['password']:'');?>" required/>
                    <input class="form-control" type="password" id="cpassword" name="re-pass" placeholder="Re-Enter Password" value="<?=((isset($_GET['edit']))?$getqery['password']:'');?>" required/>
                   
                    </div>
                     <div class="col-md-4">
                     <input class="form-control" type="text" name="loc" onclick="verify()" placeholder="Enter Location" value="<?=((isset($_GET['edit']))?$getqery['location']:'');?>" required/>
                         <?php if(isset($_GET['edit']) && $getqery['image']!=''):?>
                         <img class="img-thumbnail img-rounded" src="<?=$getqery['image'];?>"/>
                         <input type="hidden" name="vimg" value="<?=$getqery['image'];?>">
                         <a href="cooperation.php?delete_img=1&edit=<?=$getqery['userKey'];?>" class="btn btn-danger"> delete</a>
                         <?php else:?>
                    <input class="form-control" type="file" name="img" required/>
                         <?php endif;?>
                    <input class="form-control btn btn-md btn-primary" type="submit" name="submit" value="<?=((isset($_GET['edit']))?'Edit':'Add');?> Corporation"/>
                         <?php if(isset($_GET['edit'])):?><a href="cooperation.php" class="btn form-control btn-md btn-success">Cancel</a><?php endif;?>
                    </div>
                    
                </form>
                    </div>
                <?php else:?>
                    <a href="cooperation.php?add" class="a_custom btn btn-md btn-primary">Add New Corporation</a>
                    <?php endif;?>
                
                <div class="general_table">
                    <h3>Current Existing Corporation</h3>
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
                            <th>Action</th>
                        </tbody>
                        <tbody>
                            <?php while($res=mysqli_fetch_assoc($query)):?>
                            <tr>
                                <td><?=$res['userKey'];?></td>
                                 <td><?=$res['Names'];?></td>
                                 <td><?=$res['companyEmail'];?></td>
                                 <td><?=$res['phonenumber'];?></td>
                                 <td><?=$res['companyAddress'];?></td>
                                 <td><?=$res['location'];?></td>
                                 <td><?=$res['password'];?></td>
                                 <td><?=$res['image'];?></td>
                                <td>
                                    <a class="btn btn-xs btn-warning" href="cooperation.php?edit=<?=$res['userKey'];?>">Edit</a>
                                    <a class="btn btn-xs btn-danger" href="cooperation.php?delete=<?=$res['userKey'];?>">Delete</a>
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