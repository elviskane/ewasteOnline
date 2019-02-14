<!DOCTYPE html>
<html>
    <head>
    <title> E-waste Online | UserAccounts</title>
    
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/jquery-3.3.1.min.js"></script>
            <script src="js/bootstrap.min.js"></script>

</head>
    <body>
       
        <?php include 'logins/includes/navigate.php';
        $errors=array();
        ?>
        <div id="mainContent">
        <?php include'logins/includes/sidebar.php';?>
        <div class="submain_content">
            <div class="container-fluid">
            
            </div>
        </div>
            
    </div>   
     <div class="overflow_sheet">
           <?php include 'core/errors.php';?>
         <div class="div_form div_login">
             
             
          <div class="header text-center">
            <h2> Choose Account</h2>
        </div>
             
          <div class="container text-center" id="loginform">
              <a class="form-control btn btn-lg btn-primary" style="height:auto; padding:16px 16px;" href="logins/administrator.php">Administrator</a>
             <a class="form-control btn btn-lg btn-primary" style="height:auto; padding:16px 16px;" href="logins/cooperate.php">Cooperations</a>
             <a class="form-control btn btn-lg btn-primary" style="height:auto; padding:16px 16px;" href="logins/customer.php">Customers</a>
             <a class="form-control btn btn-lg btn-primary" style="height:auto; padding:16px 16px;" href="logins/recycler.php">Recyclers</a>
        </div>
             
         </div>
         <div class="div_form div_signUp div_adjust">
           
              <div class="header text-center">
            <h2>CHOOSE ACCOUNT TYPE</h2>
        </div>
         </div> 
    </div>
        <?php include'logins/includes/footer.php';?>
    </body>


</html>