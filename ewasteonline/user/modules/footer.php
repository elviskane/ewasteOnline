<script>

jQuery(document).ready(function($){
    
     $("#client_nav .sidebar-nav li a").filter(function(){
        return this.href == location.href.replace(/#.*/,"");
     }).addClass("client_custom_active");
    
        
    }

);
function modalopen(id){
    var data={"id" : id};
    jQuery.ajax({
        url:'/ewasteonline/user/modules/modal.php',
        method:"post",
        data:data,
        success:function(data){
            jQuery('body').append(data);
            jQuery("#details-modal").modal('toggle');
        },
        fail:function(){}
    });
}

function add_to_cart() {
    
  jQuery('#modals_error').html("");
  var quantity = jQuery("#quantity").val();
  var age = parseInt(jQuery("#Age").val());
  var error = "";
  var data=jQuery("#add_product_form").serialize();
  if(quantity === '' || quantity === 0) {
    error='<p>must enter quantity</p>';
      jQuery('#modals_error').html(error);
      return;
  }else if(!$.isNumeric(quantity)) {
    error='<p>character entered is not a number plaese enter a number</p>';
      jQuery('#modals_error').html(error);
      return;
  }else if(!$.isNumeric(age)){
    error='<p>Device Age Must Be Numeric </p>';
      jQuery('#modals_error').html(error);
      return;
  }else{
    jQuery.ajax({
      url : '/ewasteonline/user/modules/cart.php',
      method : 'post',
      data : data,
      success : function(){location.reload();},
      error : function(){alert("something went wrong");}
    });
  }


}
    
$(document).ready(function(){
     $("#btngetcart").click(function(){
  $(".cartcontainer").toggleClass("show_me");
    });
});
    
        function checkoutbtn(total){
            var data={"total" : total};
    jQuery.ajax({
        url:'/ewasteonline/user/checkout.php',
        method:"post",
        data:data,
        success:function(data){
            jQuery('body').append(data);
           
            $(".cartcontainer").toggleClass("show_me");
             jQuery("#checkoutmodal").modal('toggle');
        },
        fail:function(){}
    });
}
function verify(){
    var pass=$("#password").val();
    var cpass=$("#cpassword").val();
    if(cpass!=pass){
        $("#cpassword").css('border-color','red');
        $("#cpassword").val("");
        $("#password").val("");
        $("#cpassword").attr("placeholder","password mismatch");
    }
}
    
    function verifyNat(){
    var nat=$("#natid").val();
     if(!jQuery.isNumeric(nat)){
       $("#natid").css('border-color','red');
        $("#natid").val("");
        $("#natid").attr("placeholder","Invalid Format");
       }
}
    
function verifyPhone(){

    var phone=$("#mobile").val();
    if(!jQuery.isNumeric(phone)){
       $("#mobile").css('border-color','red');
        $("#mobile").val("07");
        $("#mobile").attr("placeholder","Invalid Format");
       }
}
    function verifycop(){

    var phone=$("#copphone").val();
    if(!jQuery.isNumeric(phone)){
       $("#copphone").css('border-color','red');
        $("#copphone").val("07");
        $("#copphone").attr("placeholder","Invalid Format");
       }
}
    function verifyrec(){

    var phone=$("#recphone").val();
    if(!jQuery.isNumeric(phone)){
       $("#recphone").css('border-color','red');
        $("#recphone").val("07");
        $("#recphone").attr("placeholder","Invalid Format");
       }
        
   
}
         function closemodal(){
        jQuery('#details-modal').modal('hide');
        setTimeout(function(){
            jQuery('#details-modal').remove();
            jQuery('.modal-backdrop').remove();
        },500);
}
    
    function closecheckoutmodal(){
        jQuery('#checkoutmodal').modal('hide');
        setTimeout(function(){
            jQuery('#checkoutmodal').remove();
            jQuery('.modal-backdrop').remove();
        },500);
}
</script>
