<!DOCTYPE html>
<html lang="en">
<head>
  <title>Feedback</title>
<?php include'modules/header.php';?>
</head>
<body>
    <?php include'modules/navigate.php';?>
    <div id="mainContent">
  <?php include'modules/sidebarnav.php';?>
        <?php
        $errors=array();
        $sql="select * from feedback order by FeedsKey desc";
        $query=$dbconnect->query($sql);
        if(isset($_POST['submit'])){
             $msg=mysqli_real_escape_string($dbconnect,$_POST['msg']);
             $token=mysqli_real_escape_string($dbconnect,$_POST['token']);
             $fid=mysqli_real_escape_string($dbconnect,$_POST['id']);
            $usertype=mysqli_real_escape_string($dbconnect,$_POST['type']);
            $userkey=mysqli_real_escape_string($dbconnect,$_POST['key']);
            $date=date('h:i');
            $isadmin=1;
            $replystate=1;
             $insertsql=$dbconnect->prepare("insert into feedback(userKey,usertype,token,isAdmin,messageTime,message)values(?,?,?,?,?,?)");
            $insertsql->bind_param("iisiss",$userkey,$usertype,$token,$isadmin,$date,$msg);
            
             $update=$dbconnect->prepare("update feedback set replystatus=? where FeedsKey=?");
              $update->bind_param("ii",$replystate,$fid);
            if(count($errors==0)){
               $insertsql->execute();
                $insertsql->close();
            if($insertsql){
               $update->execute();
                $update->close();
               if($update){
                  $_SESSION['messagedis']="Message Has Been Sent"; 
                   echo('<script> location.replace("feedback.php");</script>');
               }
                
            }else{
                array_push($errors,mysqli_error($dbconnect));
            } 
            }
            
        }
        
        if(isset($_GET['reply'])){
            $id=$_GET['reply'];
            $editid=$_GET['reply'];
            $getsql=$dbconnect->prepare("select * from feedback where FeedsKey=?");
            $getsql->bind_param("i",$id);
            $getsql->execute();
            $getqery=$getsql->get_result()->fetch_array();
          
        }
        
        ?>
        <div class="submain_content">
           <div id="messagedis"><p><?=$messagedis;?></p></div>
            <div class="container-fluid">
                <h2>Feedback</h2>
                <?php if(isset($_GET['reply'])):?>
                <div class="general_form">
                <h2>Fill In details</h2>
                <form class="form-group" method="post" action="feedback.php">
                     <input type="hidden" value="<?=((isset($_GET['reply']))?$getqery['userKey']:'');?>" name="key">
                     <input type="hidden" value="<?=((isset($_GET['reply']))?$getqery['FeedsKey']:'');?>" name="id">
                    <input type="hidden" value="<?=((isset($_GET['reply']))?$getqery['token']:'');?>" name="token">
                      <input type="hidden" value="<?=((isset($_GET['reply']))?$getqery['usertype']:'');?>" name="type">
                    <div class="col-md-4">
                        
                    <textarea class="form-control" type="text" name="messagerec" placeholder="Enter Message" required><?=((isset($_GET['reply']))?$getqery['message']:'');?></textarea>
                        
                    <textarea class="form-control" type="text" name="msg" placeholder="Enter Message" required></textarea>
                        
                    <input class="form-control btn btn-md btn-primary" type="submit" name="submit" value="Reply"/>
                        
                     <?php if(isset($_GET['reply'])):?><a href="feedback.php" class="btn form-control btn-md btn-success">Cancel</a><?php endif;?>
                    </div>
                </form>
                    <?php endif;?>
                <div>
                <div class="general_table">
                    <h3>Users FeedBack</h3>
                    <table class="table table-bordered table-responsive">
                        <tbody>
                            <th>No</th>
                            <th>userId</th>
                            <th>userType</th>
                            <th>token</th>
                            <th>isAdmin</th>
                            <th>messageTime</th>
                            <th>message</th>
                             <th>ReplyStatus</th>
                            <th>Action</th>
                        </tbody>
                        <tbody>
                            <?php while($res=mysqli_fetch_assoc($query)):?>
                            <tr>
                                <td><?=$res['FeedsKey'];?></td>
                                 <td><?=$res['userKey'];?></td>
                                 <td><?=$res['usertype'];?></td>
                                 <td><?=$res['token'];?></td>
                                 <td><?=$res['isAdmin'];?></td>
                                 <td><?=$res['messageTime'];?></td>
                                 <td><?=$res['message'];?></td>
                                <td><?=$res['replystatus'];?></td>
                                <td>
                                    <?php if($res['replystatus']==1):?>
                                    <a class="btn btn-xs btn-primary">Message Has Been Replied</a>
                                    <?php elseif($res['isAdmin']==1):?>
                                    <a class="btn btn-xs btn-success">Admin</a>
                                    <?php else:?>
                                    <a class="btn btn-xs btn-warning" href="feedback.php?reply=<?=$res['FeedsKey'];?>">Reply Message</a>
                                    <?php endif;?>
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