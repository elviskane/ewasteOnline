<?php include 'includes/login.php';?>

<!DOCTYPE html>
<html>
    <head>
    <title> E-waste Online | Client</title>
    
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../js/jquery-3.3.1.min.js"></script>
            <script src="../js/bootstrap.min.js"></script>

</head>
    <body>
       
        <?php include 'includes/navigate.php';?>
        <div id="mainContent">
        <?php include'includes/sidebar.php';?>
        <div class="submain_content">
            <div class="container-fluid">
            
            </div>
        </div>
            
    </div>   
     <div class="overflow_sheet">
         <div class="div_form div_login">
           <div id="success"><p><?=$messagedis;?></p></div>     
             
          <div class="header text-center">
            <h2> Client Sign In</h2>
        </div>
        
          <div class="container" id="loginform">
              <div class="form_header"><h3>Fill In Form</h3></div>
            <form class="form-group" method="POST" action="customer.php">
            <input type="text" name="uname" placeholder="Enter Username" class="form-control" required/>
            <input type="password" name="pass" placeholder="Enter Password" class="form-control" required/>
            <input type="submit" name="usersubmit" class="btn-primary form-control" value="Sign In"/>
            </form>
              <p class="text-center">
            Don't Have An Account ? <button class="btn btn-md btn-primary"> Sign Up</button>
            </p>
             <a class="back_arrow text-center" href="../index.php"><span class="glyphicon glyphicon-arrow-left"></span></a>

        </div>
             
         </div>
         <div class="div_form div_signUp div_adjust">
           
              <div class="header text-center">
            <h2> Sign Up</h2>
        </div>
       
         <div class="container" id="signupform">
            <div class="form_header"><h3>Fill In Registration Details</h3></div>
             <form class="form-group" method="post" action="customer.php" enctype="multipart/form-data">
                    <div class="col-md-4">
                    <input class="form-control" type="text" name="fn" placeholder="Enter Firstname" required/>
                    <input class="form-control" type="text" name="ln" placeholder="Enter lastname" required/>
                    <input class="form-control" id="uname" type="text" name="un" placeholder="Enter Username" oninput="check_customer_uname()" required/>
                    <input class="form-control" type="password" id="password" name="pass" placeholder="Enter Password" required/>
                    </div>
                     <div class="col-md-4">
                    <input class="form-control" type="password" id="cpassword" name="re-pass" placeholder="Re-Enter Password" required/>
                    <input class="form-control" type="email" id="email" name="email" onclick="verify()" placeholder="Enter Email" oninput="check_customer_email()" required/>
                    <input class="form-control" type="date" id="date" name="dob" placeholder="Enter Date Of Birth" required/>
                    <input class="form-control" type="text" minlength="10" onclick="verifyDob()" maxlength="10" value="07" id="mobile" name="mobile" placeholder="Enter PhoneNumber" oninput="check_customer_phone()" required/>
                    </div>
                     <div class="col-md-4">
                    <input class="form-control" type="text" minlength="8" maxlength="8" name="nat" id="natid" onclick="verifyPhone()" oninput="check_customer_nat()" maxlength=8 placeholder="Enter National Id" required/>
                  
                    <input class="form-control" onclick="verifyNat()" type="file" name="img" required/>
              
                    <input class="form-control" type="text" id="loc" name="loc" placeholder="Enter Home Location" required/>
                    <input class="form-control btn btn-md btn-warning" type="submit" name="regcustsubmit" value="Register Customer"/>
                         
                    </div>
                    
                </form>
             <p class="text-center">
            Already Have An Account ? <button class="btn btn-md btn-success"> Sign In</button>
            </p>
        </div>
         </div> 
    </div>
        <?php include'includes/footer.php';?>
        
    </body>


</html>