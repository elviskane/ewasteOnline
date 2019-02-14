<!DOCTYPE html>
<html lang="en">
<head>
  <title>Visual Summaries</title>
  <?php include'modules/header.php';?>
</head>
<body>
    <?php include'modules/navigate.php';?>
    <div id="mainContent">
  <?php include'modules/sidebarnav.php';?>
        <div class="submain_content">
            <div class="container-fluid">
                <h2>Visual Summaries</h2>
            <div class="chart-container">
            <div class="div_custom">
                <canvas id="inventory_canvas"></canvas>       
            </div>
            <div class="div_custom">
             
            <canvas id="Inventory_line_canvas"></canvas>
            </div>
            <div class="div_custom">
          
              <canvas id="orders_canvas"></canvas>
            </div>
            <div class="div_custom">
            
              <canvas id="coporders_canvas"></canvas>
            </div>
            <div class="div_custom">
              
              <canvas id="custorders_canvas"></canvas>
            </div>
            <div class="div_custom">
              <canvas id="usertype_canvas"></canvas>
            </div>
            <div class="div_custom">
              <canvas id="payments_canvas"></canvas>
            </div>
          
            <script src="../js/Chart.min.js"></script>
            <script src="../js/chart/recycler_orders.js"></script>
            <script src="../js/chart/inventory.js"></script>
            <script src="../js/chart/inventory_line.js"></script>
           
            <script src="../js/chart/customer_orders.js"></script>
            <script src="../js/chart/cooperate_orders.js"></script>
            <script src="../js/chart/usertype.js"></script>
            <script src="../js/chart/payments.js"></script>
            </div>
            </div>
        </div>
    </div>
    <?php include'modules/footer.php';?>
</body>
</html>