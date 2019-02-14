<?php include 'includes/login.php';?>
<!DOCTYPE html>
<html>
    <head>
    <title> E-waste Online | Cooperation</title>
    
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
            <h2> Cooperate Sign In</h2>
        </div>
        
          <div class="container" id="loginform">
              <div class="form_header"><h3>Fill In Form</h3></div>
            <form class="form-group" method="POST" action="cooperate.php">
            <input type="text" name="email" placeholder="Enter Company Email" class="form-control"/>
            <input type="password" name="pass" placeholder="Enter Password" class="form-control"/>
            <input type="submit" name="copsubmit" class="btn-primary form-control" value="Sign In"/>
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
        <form class="form-group" method="post" action="cooperate.php" enctype="multipart/form-data">
                    <div class="col-md-4">
                    <input class="form-control" type="text" id="copname" name="names" placeholder="Enter Company Name" oninput="check_cop_name()" required/>
                    <input class="form-control" type="email" id="copemail" name="email" oninput="check_cop_email()" placeholder="Enter Company Email" required/>
                    <input class="form-control" type="text" minlength="10" maxlength="10" id="copphone" name="mob" oninput="check_cop_phone()" value="07" placeholder="Enter Company phonenumber" required/>
                    </div>
            
                     <div class="col-md-4">
                    <input class="form-control" type="text" onclick="verifycop()" name="address" placeholder="Enter Company Address" required/>
                    <input class="form-control" type="password" id="password" name="pass" placeholder="Enter Password" required/>
                    <input class="form-control" type="password" id="cpassword" name="re-pass" placeholder="Re-Enter Password" required/>
                    </div>
            
                     <div class="col-md-4">
                     <input class="form-control" type="text" name="loc" onclick="verify()" placeholder="Enter Location" required/>          
                    <input class="form-control" type="file" name="img" required/>
                   
                    <input class="form-control btn btn-md btn-warning" type="submit" name="regcopsubmit" value="Register Cooperation"/>
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