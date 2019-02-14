<!DOCTYPE html>
<html lang="en">
<head>
  <title>Devices</title>
  <?php include'modules/header.php';?>
</head>
<body>
    <?php include'modules/navigate.php';?>
    <div id="mainContent">
  <?php include'modules/sidebarnav.php';?>
        <?php
        $sql="select * from device";
        $query=$dbconnect->query($sql);
        if(isset($_POST['submit'])){
             $manu=mysqli_real_escape_string($dbconnect,$_POST['manu']);
             $names=mysqli_real_escape_string($dbconnect,$_POST['names']);
            $price=mysqli_real_escape_string($dbconnect,$_POST['price']);
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
                echo('<script> location.replace("device.php");</script>');
            }elseif($photosize>15360000){
                $_SESSION['messagedis']="file size is too big";
                echo('<script> location.replace("device.php");</script>');
            }else{
                 move_uploaded_file($photoloc,$dbphotopath);
            } 
       }else{
                $finimg=$_POST['vimg'];
            }
            if($_POST['id']!=null){
                $postid=$_POST['id'];
                $insertsql=$dbconnect->prepare("update device set manuKey=?,deviceName=?,price=?,image=? where deviceKey=?");
                $insertsql->bind_param("isdsi",$manu,$names,$price,$finimg,$postid);
                $_SESSION['messagedis']="Device Details Have Been Updated";
              
            }else{
                $insertsql=$dbconnect->prepare("insert into device(manuKey,deviceName,price,image)values(?,?,?,?)");
                $insertsql->bind_param("isds",$manu,$names,$price,$finimg);
                $_SESSION['messagedis']="Device Details Have Been Added";
            }
            
            if(count($errors==0)){
                $insertsql->execute();
                $insertsql->close();
            if($insertsql){
              echo('<script> location.replace("device.php");</script>');
            }else{
                $_SESSION['messagedis']=mysqli_error($dbconnect);
            } 
            }
            
        }
        
        if(isset($_GET['edit'])){
            $id=$_GET['edit'];
            $editid=$_GET['edit'];
           $getsql=$dbconnect->prepare("select * from device where deviceKey=?");
            $getsql->bind_param("i",$id);
            $getsql->execute();
            $getqery=$getsql->get_result()->fetch_array();
              if(isset($_GET['delete_img'])){
                        $img_url=$_SERVER['DOCUMENT_ROOT'].$getres['image'];
                  echo $img_url;
                            unlink($img_url);
                
                  $update=$dbconnect->prepare("update device set image='' where deviceKey=?");
                    $update->bind_param("i",$id);
                  $update->execute();
                  $update->close();
                  $_SESSION['messagedis']="Image Has Been Deleted.Insert New One";
                       echo('<script> location.replace("device.php?edit='.$editid.'");</script>');
                    }
            
        }
        
        if(isset($_GET['delete'])){
            $id=$_GET['delete'];
            $delsql="delete from device where deviceKey='$id'";
            $delquery=$dbconnect->query($delsql);
             $_SESSION['messagedis']="Device Has Been Deleted";
           echo('<script> location.replace("device.php");</script>');
        }
        $manuquery=$dbconnect->query("select * from manufacturer");
        ?>
        <div class="submain_content">
          <div id="messagedis"><p><?=$messagedis;?></p></div>
            <div class="container-fluid">
                <h2>Devices</h2>
                <?php if(isset($_GET['add']) || isset($_GET['edit'])):?>
                <div class="general_form">
                <h2>Fill In details</h2>
                <form class="form-group" method="post" action="device.php" enctype="multipart/form-data">
                     <input type="hidden" value="<?=((isset($_GET['edit']))?$getqery['deviceKey']:'');?>" name="id">
                    <div class="col-md-6">
                        <select class="form-control" name="manu">
                            <option value="">Select Manufacturer</option>
                            <?php while($res=mysqli_fetch_assoc($manuquery)):?>
                            
                            <option value="<?=$res['manuKey'];?>"<?php if(isset($_GET['edit'])):?><?=(($getqery['manuKey']==$res['manuKey'])?'selected="selected"':'');?><?php endif;?>><?=$res['manufacturerNames'];?></option>

                            <?php endwhile;?>
                        </select>
                    <input class="form-control" type="text" name="names" placeholder="Enter Device Name" value="<?=((isset($_GET['edit']))?$getqery['deviceName']:'');?>" required/>
                    <input class="form-control" type="number" name="price" placeholder="Enter e-waste Price" value="<?=((isset($_GET['edit']))?$getqery['price']:'');?>" required/>
                    </div>
                     <div class="col-md-6">
                         <?php if(isset($_GET['edit']) && $getqery['image']!=''):?>
                         <img class="img-thumbnail img-rounded" src="<?=$getqery['image'];?>"/>
                         <input type="hidden" name="vimg" value="<?=$getqery['image'];?>">
                         <a href="device.php?delete_img=1&edit=<?=$getqery['deviceKey'];?>" class="btn btn-danger"> delete</a>
                         <?php else:?>
                    <input class="form-control" type="file" name="img" required/>
                         <?php endif;?>
                    <input class="form-control btn btn-md btn-primary" type="submit" name="submit" value="<?=((isset($_GET['edit']))?'Edit':'Add');?> Device"/>
                         <?php if(isset($_GET['edit'])):?><a href="device.php" class="btn form-control btn-md btn-success">Cancel</a><?php endif;?>
                    </div>
                    
                </form>
                </div>
                <?php else:?>
                    <a href="device.php?add" class="a_custom btn btn-md btn-primary">Add New Device</a>
                    <?php endif;?>
                <div class="general_table">
                    <h3>Current Existing Devices</h3>
                    <table class="table table-bordered table-responsive">
                        <tbody>
                            <th>No</th>
                            <th>Manufaturer Id</th>
                            <th>Device Name</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tbody>
                        <tbody>
                            <?php while($res=mysqli_fetch_assoc($query)):?>
                            <tr>
                                <td><?=$res['deviceKey'];?></td>
                                 <td><?=$res['manuKey'];?></td>
                                 <td><?=$res['deviceName'];?></td>
                                 <td><?=$res['price'];?></td>
                                <td><?=$res['image'];?></td>
                                <td>
                                    <a class="btn btn-xs btn-warning" href="device.php?edit=<?=$res['deviceKey'];?>">Edit</a>
                                    <a class="btn btn-xs btn-danger" href="device.php?delete=<?=$res['deviceKey'];?>">Delete</a>
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