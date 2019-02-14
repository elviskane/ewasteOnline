<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manufacturers</title>
  <?php include'modules/header.php';?>
</head>
<body>
    <?php include'modules/navigate.php';?>
    <div id="mainContent">
  <?php include'modules/sidebarnav.php';?>
        <?php
        $errors=array();
        $sql="select * from manufacturer";
        $query=$dbconnect->query($sql);
        if(isset($_POST['submit'])){
             $names=mysqli_real_escape_string($dbconnect,$_POST['names']);
            if($_POST['id']!=null){
                $postid=$_POST['id'];
                $insertsql=$dbconnect->prepare("update manufacturer set manufacturerNames=? where manuKey=?");
                $insertsql->bind_param("si",$names,$postid);
                $_SESSION['messagedis']="Manufacturer information Has Been Updated";
            }else{
                $insertsql=$dbconnect->prepare("insert into manufacturer(manufacturerNames)values(?)");
                $insertsql->bind_param("s",$names);
                $_SESSION['messagedis']="Manufacturer informmation Has Been Added";
            }

            if(count($errors==0)){
               $insertsql->execute();
            if($insertsql){
               echo('<script> location.replace("manu.php");</script>');

            }else{
                array_push($errors,mysqli_error($dbconnect));
            }
            }

        }

        if(isset($_GET['edit'])){
            $id=$_GET['edit'];
            $editid=$_GET['edit'];
            $getsql=$dbconnect->prepare("select * from manufacturer where manuKey=?");
            $getsql->bind_param("i",$id);
            $getsql->execute();
            $getqery=$getsql->get_result()->fetch_array();
        }

        if(isset($_GET['delete'])){
            $id=$_GET['delete'];
            $$delsql=$dbconnect->prepare("delete from manufacturer where manuKey=?");
            $delsql->bind_param("i",$id);
            $delsql->execute();
            $delsql->close();
            $_SESSION['messagedis']="ManuFacturer Has Been Deleted";
           echo('<script> location.replace("manu.php");</script>');
        }
        ?>
        <div class="submain_content">
           <div id="messagedis"><p><?=$messagedis;?></p></div>
            <div class="container-fluid">
                <h2>manufacturers</h2>
                <?php if(isset($_GET['add']) || isset($_GET['edit'])):?>
                <div class="general_form">
                <h2>Fill In details</h2>
                <form class="form-group" method="post" action="manu.php">
                     <input type="hidden" value="<?=((isset($_GET['edit']))?$getqery['manuKey']:'');?>" name="id">
                    <div class="col-md-6">
                    <input class="form-control" type="text" name="names" placeholder="Enter Manufaturer Name" value="<?=((isset($_GET['edit']))?$getqery['manufacturerNames']:'');?>" required/>
                    </div>
                     <div class="col-md-6">
                    <input class="form-control btn btn-md btn-primary" type="submit" name="submit" value="<?=((isset($_GET['edit']))?'Edit':'Add');?> Device"/>
                         <?php if(isset($_GET['edit'])):?><a href="manu.php" class="btn form-control btn-md btn-success">Cancel</a><?php endif;?>
                    </div>

                </form>
                <?php else:?>
                    <a href="manu.php?add" class="a_custom btn btn-md btn-primary">Add New manufacturer</a>
                    <?php endif;?>
                <div>
                <div class="general_table">
                    <h3>Current Existing manufacturers</h3>
                    <table class="table table-bordered table-responsive">
                        <tbody>
                            <th>No</th>
                            <th>Manufaturer Name</th>
                            <th>Action</th>
                        </tbody>
                        <tbody>
                            <?php while($res=mysqli_fetch_assoc($query)):?>
                            <tr>
                                 <td><?=$res['manuKey'];?></td>
                                 <td><?=$res['manufacturerNames'];?></td>
                                <td>
                                    <a class="btn btn-xs btn-warning" href="manu.php?edit=<?=$res['manuKey'];?>">Edit</a>
                                    <a class="btn btn-xs btn-danger" href="manu.php?delete=<?=$res['manuKey'];?>">Delete</a>
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
