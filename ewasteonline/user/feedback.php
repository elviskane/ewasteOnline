<!DOCTYPE html>
<html>
    <head>
    <title>Feedback</title>
    <?php include'modules/header.php';?>
</head>
    <body>
       
        <?php include 'modules/navigate.php';?>
        <div id="client_mainContent">
        <?php include'modules/sidebarnav.php';?>
        <?php
        $errors=array();
            if($user_cookie_type==1){
                $user=$user_uname;
            }else{
                $user=$cop_uname;
            }
        $sql="select * from feedback where userKey='$user' and usertype='$user_cookie_type' order by FeedsKey desc";
        $query=$dbconnect->query($sql);
        if(isset($_POST['submit'])){
             $msg=mysqli_real_escape_string($dbconnect,$_POST['msg']);
             $token=$token_cookie;
             $fid=mysqli_real_escape_string($dbconnect,$_POST['id']);
            $date=date('h:i');
            $isadmin=0;
             $insertsql=$dbconnect->prepare("insert into feedback(userKey,usertype,token,isAdmin,messageTime,message)values(?,?,?,?,?,?)");
            $insertsql->bind_param("iisiss",$user,$user_cookie_type,$token,$isadmin,$date,$msg);
            $rstate=1;
             $update=$dbconnect->prepare("update feedback set replystatus=? where FeedsKey=?");
            $update->bind_param("ii",$rstate,$fid);
            
            if(count($errors)==0){
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
            if(isset($_POST['submit_message'])){
            $msg=mysqli_real_escape_string($dbconnect,$_POST['messagerec']);
             $token=$token_cookie;
                $date=date('h:i');
                 $isadmin=0;
             $insertsql=$dbconnect->prepare("insert into feedback(userKey,usertype,token,isAdmin,messageTime,message)values(?,?,?,?,?,?)");
                $insertsql->bind_param("iisiss",$user,$user_cookie_type,$token,$isadmin,$date,$msg);
            
            if(count($errors)==0){
               $_SESSION['messagedis']="Message Has Been Sent";
               $insertsql->execute();
                echo('<script> location.replace("feedback.php");</script>');
               
            if($insertsql){
                  
                
                
            }else{
                $_SESSION['messagedis']=mysqli_error($dbconnect);
            } 
            } 
            }
        
        if(isset($_GET['reply'])){
            $id=$_GET['reply'];
            $id=mysqli_real_escape_string($dbconnect,$id);
            $editid=$_GET['reply'];
            $getsql="select * from feedback where FeedsKey='$id'";
            $getqery=$dbconnect->query($getsql);
            $getres=mysqli_fetch_assoc($getqery);
          
        }
        
        ?>
        <div class="submain_content">
            <?php include'discart.php';?>
           <div id="messagedis"><p><?=$messagedis;?></p></div>
            <div class="container-fluid">
                <h2>Feedback</h2>
                <?php if(isset($_GET['reply'])):?>
                <div class="general_form">
                <h2>Fill In details</h2>
                <form class="form-group" method="post" action="feedback.php">
                     <input type="hidden" value="<?=((isset($_GET['reply']))?$getres['FeedsKey']:'');?>" name="id">
                    <input type="hidden" value="<?=((isset($_GET['reply']))?$getres['token']:'');?>" name="token">
                    <div class="col-md-4">
                        
                    <textarea class="form-control" type="text" name="messagerec" placeholder="Enter Message" required><?=((isset($_GET['reply']))?$getres['message']:'');?></textarea>
                        
                    <textarea class="form-control" type="text" name="msg" placeholder="Enter Message" required></textarea>
                        
                    <input class="form-control btn btn-md btn-primary" type="submit" name="submit" value="Reply"/>
                        
                     <?php if(isset($_GET['reply'])):?><a href="feedback.php" class="btn form-control btn-md btn-success">Cancel</a><?php endif;?>
                    </div>
                </form>
                    <?php endif;?>
                <div>
                <div class="general_table">
                    <h3>Users FeedBack</h3>
                    <table class="table table-bordered table-responsive" style="wr">
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
                                 <td><?=wordwrap($res['message'],55,"<br/>","/n");?></td>
                                <td><?=$res['replystatus'];?></td>
                                <td>
                                    <?php if($res['replystatus']==1):?>
                                    <a class="btn btn-xs btn-primary">Message Has Been Replied</a>
                                    <?php elseif($res['isAdmin']==0):?>
                                    <a class="btn btn-xs btn-success">user</a>
                                    <?php else:?>
                                    <a class="btn btn-xs btn-warning" href="feedback.php?reply=<?=$res['FeedsKey'];?>">Reply Message</a>
                                    <?php endif;?>
                                </td>
                            </tr>
                            <?php endwhile;?>
                        </tbody>
                    </table>
                    
                </div>
                    <?php if(isset($_GET['createmess'])):?>
                  
                    <div class="general_form">
                          <h2>Post Message Here</h2>
                        <form action="feedback.php" method="post" class="form-group col-md-6">
                            <textarea class="form-control" type="text" name="messagerec" placeholder="Enter Message" required><?=((isset($_GET['reply']))?$getres['message']:'');?></textarea>
                            <input type="submit" placeHolder="Enter Message" name="submit_message" class="btn btn-md btn-success form-control"/>
                            <a class="btn btn-md btn-warning form-control" href="feedback.php">Cancel</a>
                        </form>
                         
                    </div>
                    <?php else:?>
                     <a class="btn btn-md btn-primary" href="feedback.php?createmess">Create Feedback</a>
                    <?php endif;?>
            </div>
        </div>
    </div>
    </div>
    <?php include'modules/footer.php';?>
    </div>   
     
    </body>


</html>