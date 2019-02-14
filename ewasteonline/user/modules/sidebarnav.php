<?php
 if($user_cookie_type==1){
                $user=$user_uname;
            }else{
                $user=$cop_uname;
            }
$count=mysqli_num_rows($dbconnect->query("select * from feedback where userKey='$user' and usertype='$user_cookie_type' and replystatus=0 and isAdmin=1"));
?>      
<div id="client_nav" class="user_custom">
        <div class="sidebar-nav">
    <nav class="navbar navbar-default">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <div class="navbar-brand">E-waste Online <img class="header_img"src="../images/path1.png"/></div>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
         <li><a href="index.php"><span class="client_indicators"></span>Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="client_indicators"></span>Sell E-waste <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="ewaste.php?bulk"><span class="client_indicators"></span>Bulk E-waste</a></li>
        <li><a href="ewaste.php"><span class="client_indicators"></span>Small E-waste</a></li>
          </ul>
        </li>
        
          <li><a href="about.php"><span class="client_indicators"></span>About Us</a></li>
          <li><a href="profile.php"><span class="client_indicators"></span>Profile</a></li>
          <li><button href="#" id="btngetcart"><span class="client_indicators"></span>Cart</button></li>
          <li><a href="orderhistory.php"><span class="client_indicators"></span>Pickup History</a></li>
          <li><a href="feedback.php"><span class="client_indicators"></span>FeedBack<span class="badge"><?=$count;?></span></a></li>
      </ul>
    </div>
</nav>
        </div>
    </div>