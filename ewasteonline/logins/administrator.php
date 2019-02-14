<?php include 'includes/login.php';?>
<!DOCTYPE html>
<html>
    <head>
    <title> E-waste Online | Administrator</title>
    
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
            <h2> Administrator Sign In</h2>
        </div>
        
          <div class="container" id="loginform">
              <div class="form_header"><h3>Fill In Form</h3></div>
            <form class="form-group" method="POST" action="administrator.php">
            <input type="text" name="uname" placeholder="Enter Username" class="form-control"/>
            <input type="password" name="pass" placeholder="Enter Password" class="form-control"/>
            <input type="submit" name="adminsubmit" class="btn-primary form-control" value="Sign In"/>
            </form>
        <a class="back_arrow text-center" href="../index.php"><span class="glyphicon glyphicon-arrow-left"></span></a>

        </div>
             
         </div>
         <div class="div_form div_signUp div_adjust">
              <div class="header text-center">
            <h2> Administ<br/>rator</h2>
        </div>
       
         </div>
    </div>
        <?php include'includes/footer.php';?>
    </body>


</html>