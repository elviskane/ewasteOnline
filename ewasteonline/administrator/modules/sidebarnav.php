<?php

$count=mysqli_num_rows($dbconnect->query("select * from feedback where replystatus=0 and isAdmin=0"));
?>      
<div id="admin_nav">
        <div class="sidebar-nav">
    <nav class="navbar navbar-default" style="background: white;">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <div class="navbar-brand">E-waste Online <img class="header_img"src="../images/path2.png" style="margin-top:0px;"/></div>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
         <li><a href="index.php"><span class="indicators_purple"></span>Administrator</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="indicators_purple"></span>Users <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="customer.php"><span class="indicators_purple"></span>Customers</a></li>
        <li><a href="cooperation.php"><span class="indicators_purple"></span>Cooperations</a></li>
          <li><a href="recycler.php"><span class="indicators_purple"></span>Reyclers</a></li>
          </ul>
        </li>
        
          <li><a href="orders.php"><span class="indicators_purple"></span>Pickup Orders</a></li>
          <li><a href="inventory.php"><span class="indicators_purple"></span>Inventory</a></li>
          <li><a href="device.php"><span class="indicators_purple"></span>Devices</a></li>
          <li><a href="manu.php"><span class="indicators_purple"></span>Manufactures</a></li>
          <li><a href="payment.php"><span class="indicators_purple"></span>Recycler Payment</a></li>
          <li><a href="feedback.php"><span class="indicators_purple"></span>FeedBack<span class="badge"><?=$count;?></span></a></li>
          <li><a href="reports.php"><span class="indicators_purple"></span>Reports</a></li>
          <li><a href="charts.php"><span class="indicators_purple"></span>Charts</a></li>
      </ul>
    </div>
</nav>
        </div>
    </div>