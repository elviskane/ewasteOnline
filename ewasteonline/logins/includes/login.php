<?php
require_once '../core/connection.php';
if(isset($_POST['regcopsubmit'])){
    
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
                $_SESSION['message']="the file is not an acceptable format";
                echo('<script>location.replace("cooperate.php");</script>');
            }elseif($photosize>15360000){
                $_SESSION['message']="file size is too big";
                echo('<script>location.replace("cooperate.php");</script>');
            }else{
                 move_uploaded_file($photoloc,$dbphotopath);
            } 
       }else{
                $finimg=$_POST['vimg'];
            }
           
                $insertsql=$dbconnect->prepare("insert into cooperation(Names,companyEmail,phonenumber,companyAddress,location,password,image)values(?,?,?,?,?,?,?)");
                $insertsql->bind_param("sssssss",$n,$mail,$mob,$address,$loc,$pass,$finimg);
            
        
              $insertsql->execute();
                $insertsql->close();
            if($insertsql){
              
                  $_SESSION['message']='New Cooperation Has Been successfully registered. Please Login To Continue.';
                echo('<script>location.replace("cooperate.php");</script>');
                
            }else{
                $_SESSION['message']=mysqli_error($dbconnect);
            }          
            
        }
if(isset($_POST['regcustsubmit'])){
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
          
                $insertsql=$dbconnect->prepare("insert into customer(FirstName,LastName,UserName,Password,DateOfBirth,email,Phone,nationalid,Location,image)values(?,?,?,?,?,?,?,?,?,?)");
                 $insertsql->bind_param("ssssssssss",$fn,$ln,$un,$pass,$dob,$mail,$mob,$nat,$loc,$finimg);
            
            
          
               $insertsql->execute();
                $insertsql->close();
            if($insertsql){
                $_SESSION['messagedis']="Customer Has Been successfully registered. Please Login To Continue.";
               echo('<script> location.replace("customer.php");</script>');
                
            }else{
                $_SESSION['messagedis']=mysqli_error($dbconnect);
            } 
            
            
        }

if(isset($_POST['adminsubmit'])){
    $uname=mysqli_real_escape_string($dbconnect,$_POST['uname']);
    $pass=mysqli_real_escape_string($dbconnect,$_POST['pass']);
    $adsql=$dbconnect->prepare("SELECT userKey,UserName,Password FROM administrator WHERE UserName=?");
    if($adsql &&
      $adsql->bind_param("s",$uname) &&
       $adsql->execute() &&
       $adsql->store_result() &&
       $adsql->bind_result($ukey,$get_uname,$get_pass)
      ){
        if($adsql->num_rows==1){
        while($adsql->fetch()){
            if($get_pass==$pass){
                $adminid=$ukey;
            setcookie(ADMIN_COOKIE,$adminid,ADMIN_COOKIE_EXPIRE,'/',$dormain,false);
                $adsql->close();
            header('location:../administrator/index.php'); 
            }else{
                $_SESSION['messagedis']='incorrect password'; 
                echo('<script>location.replace("administrator.php");</script>');
            }
        }
        }else{
           $_SESSION['messagedis']='Account Doesnt exists';
            echo('<script>location.replace("administrator.php");</script>');
        }
        
     }else{
        $_SESSION['messagedis']='Prepared Statement Error';
    }
    
    
    }

if(isset($_POST['copsubmit'])){
    $copemail=mysqli_real_escape_string($dbconnect,$_POST['email']);
    $coppass=mysqli_real_escape_string($dbconnect,$_POST['pass']);
    $copsql=$dbconnect->prepare("SELECT userKey,companyEmail,password FROM cooperation WHERE companyEmail=?");
    if($copsql &&
      $copsql->bind_param("s",$copemail) &&
       $copsql->execute() &&
       $copsql->store_result() &&
       $copsql->bind_result($ckey,$get_cname,$get_cpass)){
        //check
        
        if($copsql->num_rows==1){
        while($copsql->fetch()){
            if($get_cpass==$coppass){
                $copid=$ckey;
              $generated = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')) )), 0, 20);
             setcookie(TOKEN_COOKIE,$generated,COP_COOKIE_EXPIRE,'/',$dormain,false);
            setcookie(COP_COOKIE,$copid,COP_COOKIE_EXPIRE,'/',$dormain,false);
            setcookie(USERTYPE_COOKIE,2,COP_COOKIE_EXPIRE,'/',$dormain,false);
                $copsql->close();
            header('location:../user/index.php'); 
            }else{
                $_SESSION['messagedis']='incorrect password'; 
                echo('<script>location.replace("cooperate.php");</script>');
            }
        }
        }else{
           $_SESSION['messagedis']='Account Doesnt exists';
            echo('<script>location.replace("cooperate.php");</script>');
        }
        
        //end check
        
    }else{
        $_SESSION['messagedis']='Prepared Statement Error';
    }
}

if(isset($_POST['usersubmit'])){
    $cluname=mysqli_real_escape_string($dbconnect,$_POST['uname']);
    $clpass=mysqli_real_escape_string($dbconnect,$_POST['pass']);
    $clsql=$dbconnect->prepare("SELECT userKey,UserName,Password FROM customer WHERE UserName=?");
    
    if($clsql &&
      $clsql->bind_param("s",$cluname) &&
       $clsql->execute() &&
       $clsql->store_result() &&
       $clsql->bind_result($ukey,$get_uname,$get_upass)){
        //perform check
        
        if($clsql->num_rows==1){
        while($clsql->fetch()){
            if($get_upass==$clpass){
                 $userid=$ukey;
                    $generated = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')) )), 0, 20);
                    setcookie(TOKEN_COOKIE,$generated,COP_COOKIE_EXPIRE,'/',$dormain,false);
                    setcookie(USER_COOKIE,$userid,USER_COOKIE_EXPIRE,'/',$dormain,false);
                    setcookie(USERTYPE_COOKIE,1,USER_COOKIE_EXPIRE,'/',$dormain,false);
                    $clsql->close();
                    header('location:../user/index.php'); 
            }else{
                $_SESSION['messagedis']='incorrect password'; 
                echo('<script>location.replace("customer.php");</script>');
            }
        }
        }else{
           $_SESSION['messagedis']='Account Doesnt exists';
            echo('<script>location.replace("customer.php");</script>');
        }
        
        //endcheck
        
    }else{
        $_SESSION['messagedis']='Prepared Statement Error'; 
    }
 
}
if(isset($_POST['recyclersubmit'])){
    $ryemail=mysqli_real_escape_string($dbconnect,$_POST['email']);
    $rypass=mysqli_real_escape_string($dbconnect,$_POST['pass']);
    
    $rysql=$dbconnect->prepare("SELECT recyclerKey,recyclerEmail,recyclerPassword FROM recycler WHERE recyclerEmail=?");
    
    if($rysql &&
      $rysql->bind_param("s",$ryemail) &&
       $rysql->execute() &&
       $rysql->store_result() &&
       $rysql->bind_result($rkey,$get_rname,$get_rpass)){
        
        if($rysql->num_rows==1){
            while($rysql->fetch()){
                if($get_rpass==$rypass){
                    $recid=$rkey;
                    setcookie(RECYCLER_COOKIE,$recid,RECYCLER_COOKIE_EXPIRE,'/',$dormain,false);
                    $rysql->close();
                    header('location:../recyclers/index.php'); 
                }else{
                    $_SESSION['messagedis']='incorrect password';
                    echo('<script>location.replace("recycler.php");</script>');
                }
            }
        }else{
            $_SESSION['messagedis']="Email Doesn't Exist";
            echo('<script>location.replace("recycler.php");</script>');
        }
        
    }else{
       $_SESSION['messagedis']='Prepared Statement Error';  
    }
   
}

?>