<!DOCTYPE html>
<html lang="en">
<head>
  <title>Administrator</title>
    <?php include'modules/header.php';?>
</head>
<body>

    <?php include'modules/navigate.php';?>
    <div id="mainContent">
  <?php include'modules/sidebarnav.php';?>
        <?php
        $errors=array();
        $sql="select * from administrator";
        $query=$dbconnect->query($sql);
        if(isset($_POST['submit'])){
             $fn=mysqli_real_escape_string($dbconnect,$_POST['fn']);
             $ln=mysqli_real_escape_string($dbconnect,$_POST['ln']);
             $un=mysqli_real_escape_string($dbconnect,$_POST['un']);
             $pass=mysqli_real_escape_string($dbconnect,$_POST['pass']);
             $mail=mysqli_real_escape_string($dbconnect,$_POST['email']);
             $nat=mysqli_real_escape_string($dbconnect,$_POST['nat']);
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
                array_push($errors,mysqli_error("the file is not an acceptable format"));
            }elseif($photosize>15360000){
                array_push($errors,mysqli_error("file size is too big"));
            }else{
                 move_uploaded_file($photoloc,$dbphotopath);
            }
       }else{
                $finimg=$_POST['vimg'];
            }
            if($_POST['id']!=null){
                $postid=$_POST['id'];
                $insertsql=$dbconnect->prepare("update administrator set FirstName=?,LastName=?,UserName=?,Password=?,email=?,nationalid=?,image=? where userKey=?");
                $insertsql->bind_param("sssssssi",$fn,$ln,$un,$pass,$mail,$nat,$finimg,$postid);
                $_SESSION['messagedis']="Administrator Has Been Updated";


            }else{
                $insertsql=$dbconnect->prepare("insert into administrator(FirstName,LastName,UserName,Password,email,nationalid,image)values(?,?,?,?,?,?,?)");
                $insertsql->bind_param("sssssss",$fn,$ln,$un,$pass,$mail,$nat,$finimg);
                $_SESSION['messagedis']="Administrator Has Been Added";
            }

               $insertsql->execute();
               $insertsql->close();
            if($insertsql){
               echo('<script> location.replace("index.php");</script>');

            }else{
                $_SESSION['messagedis']=mysqli_error($dbconnect);
            }
            

        }

        if(isset($_GET['edit'])){
            $id=$_GET['edit'];
            $editid=$_GET['edit'];
            $getsql=$dbconnect->prepare("select * from administrator where userKey=?");
            $getsql->bind_param("i",$id);
            $getsql->execute();
            $getqery=$getsql->get_result()->fetch_array();
              if(isset($_GET['delete_img'])){
                        $img_url=$_SERVER['DOCUMENT_ROOT'].$getqery['image'];
                  echo $img_url;
                            unlink($img_url);
                            $update=$dbconnect->prepare("update administrator set image='' where userkey=?");
                              $update->bind_param("i",$id);
                            $update->execute();
                            $update->close();
                  $_SESSION['messagedis']="Image Has Been Deleted.Insert New";
                       echo('<script> location.replace("index.php?edit='.$editid.'");</script>');
                    }

        }

        if(isset($_GET['delete'])){
            $id=$_GET['delete'];
            $delsql=$dbconnect->prepare("delete from administrator where userKey=?");
            $delsql->bind_param("i",$id);
                  $delsql->execute();
                  $delsql->close();
           echo('<script> location.replace("index.php");</script>');
        }

        ?>
        <div class="submain_content">
            <div id="messagedis"><p><?=$messagedis;?></p></div>
            <div class="container-fluid">
                <h2>Administrator</h2>
                <?php if(isset($_GET['add']) || isset($_GET['edit'])):?>
                <div class="general_form">
                <h2>Fill In details</h2>
                <form class="form-group" method="post" action="index.php" enctype="multipart/form-data">
                     <input type="hidden" value="<?=((isset($_GET['edit']))?$getqery['userKey']:'');?>" name="id">
                    <div class="col-md-4">
                    <input class="form-control" type="text" name="fn" placeholder="Enter Firstname" value="<?=((isset($_GET['edit']))?$getqery['FirstName']:'');?>" required/>
                    <input class="form-control" type="text" name="ln" placeholder="Enter lastname" value="<?=((isset($_GET['edit']))?$getqery['LastName']:'');?>" required/>
                    <input class="form-control" type="text" id="adminuname" oninput="check_admin_uname()" name="un" placeholder="Enter Username" value="<?=((isset($_GET['edit']))?$getqery['UserName']:'');?>" required/>
                    </div>
                     <div class="col-md-4">
                    <input class="form-control" type="password" id="password" name="pass" placeholder="Enter Password" value="<?=((isset($_GET['edit']))?$getqery['Password']:'');?>" required/>
                    <input class="form-control" type="password" id="cpassword" name="re-pass" placeholder="Re-Enter Password" value="<?=((isset($_GET['edit']))?$getqery['Password']:'');?>" required/>
                    <input class="form-control" type="email" id="adminemail" oninput="check_admin_email()" name="email" onclick="verify()" placeholder="Enter Email" value="<?=((isset($_GET['edit']))?$getqery['email']:'');?>" required/>
                    </div>
                     <div class="col-md-4">
                    <input class="form-control" type="text" minlength="8" maxlength="8" id="adminnat" oninput="check_admin_nat()" name="nat" maxlength=8 placeholder="Enter National Id" value="<?=((isset($_GET['edit']))?$getqery['nationalid']:'');?>" required/>
                         <?php if(isset($_GET['edit']) && $getqery['image']!=''):?>
                         <img class="img-thumbnail img-rounded" src="<?=$getqery['image'];?>"/>
                         <input type="hidden" name="vimg" value="<?=$getqery['image'];?>">
                         <a href="index.php?delete_img=1&edit=<?=$getqery['userKey'];?>" class="btn btn-danger"> delete</a>
                         <?php else:?>
                    <input class="form-control" type="file" name="img" required/>
                         <?php endif;?>
                    <input class="form-control btn btn-md btn-primary" type="submit" name="submit" value="Add Administrator"/>
                         <?php if(isset($_GET['edit'])):?><a href="index.php" class="btn form-control btn-md btn-success">Cancel</a><?php endif;?>
                    </div>

                </form>
                <?php else:?>
                    <a href="index.php?add" class="a_custom btn btn-md btn-primary">Add New Administrator</a>
                    <?php endif;?>
                <div>
                <div class="general_table">
                    <h3>Current Existing Administrators</h3>
                    <table class="table table-bordered table-responsive">
                        <tbody>
                            <th>No</th>
                            <th>FistName</th>
                            <th>LastName</th>
                            <th>UserName</th>
                            <th>Password</th>
                            <th>Email</th>
                            <th>NationalId</th>
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
                                 <td><?=$res['email'];?></td>
                                 <td><?=$res['nationalid'];?></td>
                                 <td><?=$res['image'];?></td>
                                <td>
                                    <a class="btn btn-xs btn-warning" href="index.php?edit=<?=$res['userKey'];?>">Edit</a>
                                    <a class="btn btn-xs btn-danger" href="index.php?delete=<?=$res['userKey'];?>">Delete</a>
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
