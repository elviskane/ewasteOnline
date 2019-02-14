<?php
require_once '../../core/connection.php';
$id=$_POST['id'];
$id=(int)$id;
$modalst="select * from device where deviceKey='$id'";
$modalquery=$dbconnect->query($modalst);
$modalresult=mysqli_fetch_assoc($modalquery);
?>


<?php ob_start();?>
<style>
    #modals_error{
        color:red;
        font-size: 15px;
    }
</style>
<div class="modal fade details-1 text-center" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <button class="close" type="button" onclick="closemodal()" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title text-center">E-WASTE DEVICE DETAILS</h4>
        </div>
        
        <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <span id="modals_error" class="bg-danger"></span>
                <div class="col-md-5">
                    <div class="center-block">
                        <h4><?=$modalresult['deviceName'];?> </h4>
                    <img class="profile_img" src="<?=$modalresult['image'];?>" alt="<?=$modalresult['deviceName'];?>"/>
                        
                    </div>
                <h4><div id="modals_error"></div></h4>
                </div>
                <div class="col-md-7">
                    <h3>Fill In device Details For submission</h3>
                    <form class="form-group text-left" action="" method="post" id="add_product_form">
                        <input type="hidden" name="id" id="product_id" value="<?=$id;?>">
                        <input type="hidden" name="price" value="<?=$modalresult['price'];?>">
                        <label for="quantity">Device Name</label>
                        <input class="form-control" type="text" class="form-control" placeholder="Enter Device Name" id="name" name="name" onkeyup="this.value = this.value.toUpperCase()" required/>
                        <label for="quantity">Serial Number</label>
                        <input class="form-control" type="text" class="form-control" placeholder="Enter Serial Number" id="serial" name="serial" onkeyup="this.value = this.value.toUpperCase()" required/>
                        <label for="quantity">Age</label>
                        <input class="form-control" type="text" class="form-control" placeholder="Enter Age of device Since Aquisition" id="Age" name="age" onkeyup="this.value = this.value.toUpperCase()" required/>
                        <label for="quantity">Quantity</label>
                        <input class="form-control" type="text" class="form-control" placeholder="Enter Number of E-waste Items" id="quantity" name="quantity" onkeyup="this.value = this.value.toUpperCase()" required/>
                        <input class="form-control" type="date" name="date_in" value="<?php echo date('Y-m-d'); ?>" required/>
                            
                    </form>
                </div>
            </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-warning" onclick="add_to_cart();return false;"><span class="glyphicon glyphicon-shopping-cart"></span>add to cart</button>
        </div>
        </div>
    </div>
</div>
<script src="../../js/modals.js"></script>
<?php echo ob_get_clean();?>