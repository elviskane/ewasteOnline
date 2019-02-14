<!DOCTYPE html>
<html lang="en">
<head>
  <title>Recycler</title>
<?php include'modules/header.php';?>
    </head>
<body>
    <?php include'modules/navigate.php';?>
    <div id="mainContent">
  <?php include'modules/sidebarnav.php';?>
        <?php
        $sql="select * from recycler";
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
                $insertsql=$dbconnect->prepare("update recycler set recyclerEmail=?,recyclerAddress=?,recyclerPhone=?,recyclerLocation=?,recyclerPassword=?,image=? where recyclerKey=?");
                $insertsql->bind_param("ssssssi",$mail,$address,$mob,$loc,$pass,$finimg,$postid);
                $_SESSION['messagedis']="Recycler Details have Been Updated";
            }else{
                $insertsql=$dbconnect->prepare("insert into recycler(recyclerEmail,recyclerAddress,recyclerPhone,recyclerLocation,recyclerPassword,image)values(?,?,?,?,?,?)");
                $insertsql->bind_param("ssssss",$mail,$address,$mob,$loc,$pass,$finimg);
                $_SESSION['messagedis']="Recycler Details Has Been Added";
            }
            
            if(count($errors==0)){
               $insertsql->execute();
            if($insertsql){
               echo('<script> location.replace("recycler.php");</script>');
                
            }else{
                $_SESSION['messagedis']=mysqli_error($dbconnect);
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
                       echo('<script> location.replace("recycler.php?edit='.$editid.'");</script>');
                    }
            
        }
        
        if(isset($_GET['delete'])){
            $id=$_GET['delete'];
             $delsql=$dbconnect->prepare("delete from recycler where recyclerKey=?");
             $delsql->bind_param("i",$id);
            $delsql->execute();
             $delsql->close();
             $_SESSION['messagedis']="Recycler Has Been Deleted";
           echo('<script> location.replace("recycler.php");</script>');
        }
        
        ?>
        <div class="submain_content">
         <div id="messagedis"><p><?=$messagedis;?></p></div>
            <div class="container-fluid">
                <h2>Recycler</h2>
                <?php if(isset($_GET['add']) || isset($_GET['edit'])):?>
                <div class="general_form">
                <h2>Fill In details</h2>
                <form class="form-group" method="post" action="recycler.php" enctype="multipart/form-data">
                     <input type="hidden" value="<?=((isset($_GET['edit']))?$getqery['recyclerKey']:'');?>" name="id">
                    <div class="col-md-4">
                    <input class="form-control" type="email" id="recemail" oninput="check_rec_email()" name="email" placeholder="Enter Recycler Email" value="<?=((isset($_GET['edit']))?$getqery['recyclerEmail']:'');?>" required/>
                    <input class="form-control" type="text" name="address" placeholder="Enter Recycler Address" value="<?=((isset($_GET['edit']))?$getqery['recyclerAddress']:'');?>" required/>
                    <input class="form-control" type="text" minlength="10" maxlength="10" id="recphone" oninput="check_rec_phone()" name="mob" placeholder="Enter Recycler Mobile" value="<?=((isset($_GET['edit']))?$getqery['recyclerPhone']:'');?>" required/>
                    </div>
                     <div class="col-md-4">
                    <input class="form-control" type="password" id="password" onclick="verifyrec()" name="pass" placeholder="Enter Password" value="<?=((isset($_GET['edit']))?$getqery['recyclerPassword']:'');?>" required/>
                    <input class="form-control" type="password" id="cpassword" name="re-pass" placeholder="Re-Enter Password" value="<?=((isset($_GET['edit']))?$getqery['recyclerPassword']:'');?>" required/>
                    <input class="form-control" type="text" name="loc" onclick="verify()" placeholder="Enter Recycler Location" value="<?=((isset($_GET['edit']))?$getqery['recyclerLocation']:'');?>" required/>
                    </div>
                     <div class="col-md-4">
                         <?php if(isset($_GET['edit']) && $getqery['image']!=''):?>
                         <img class="img-thumbnail img-rounded" src="<?=$getqery['image'];?>"/>
                         <input type="hidden" name="vimg" value="<?=$getqery['image'];?>">
                         <a href="recycler.php?delete_img=1&edit=<?=$getqery['recyclerKey'];?>" class="btn btn-danger"> delete</a>
                         <?php else:?>
                    <input class="form-control" type="file" name="img" required/>
                         <?php endif;?>
                    <input class="form-control btn btn-md btn-primary" type="submit" name="submit" value="<?=((isset($_GET['edit']))?'Edit':'Add');?> Recycler"/>
                         <?php if(isset($_GET['edit'])):?><a href="recycler.php" class="btn form-control btn-md btn-success">Cancel</a><?php endif;?>
                    </div>
                    
                </form>
                <?php else:?>
                    <a href="recycler.php?add" class="a_custom btn btn-md btn-primary">Add New Recycler</a>
                    <?php endif;?>
                <div>
                <div class="general_table">
                    <h3>Current Existing Recyclers</h3>
                    <table class="table table-bordered table-responsive">
                        <tbody>
                            <th>No</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Mobile</th>
                            <th>Location</th>
                            <th>Password</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tbody>
                        <tbody>
                            <?php while($res=mysqli_fetch_assoc($query)):?>
                            <tr>
                                <td><?=$res['recyclerKey'];?></td>
                                 <td><?=$res['recyclerEmail'];?></td>
                                 <td><?=$res['recyclerAddress'];?></td>
                                 <td><?=$res['recyclerPhone'];?></td>
                                 <td><?=$res['recyclerLocation'];?></td>
                                <td><?=$res['recyclerPassword'];?></td>
                                 <td><?=$res['image'];?></td>
                                <td>
                                    <a class="btn btn-xs btn-warning" href="recycler.php?edit=<?=$res['recyclerKey'];?>">Edit</a>
                                    <a class="btn btn-xs btn-danger" href="recycler.php?delete=<?=$res['recyclerKey'];?>">Delete</a>
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