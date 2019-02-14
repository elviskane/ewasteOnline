<script>

jQuery(document).ready(function($){
    
     $("#client_nav .sidebar-nav li a").filter(function(){
        return this.href == location.href.replace(/#.*/,"");
     }).addClass("client_custom_active");
    
        
    }

);
$(document).ready(function(){
     $("#btngetcart").click(function(){
  $(".cartcontainer").toggleClass("show_me");
    });
   
});
    
function add_to_cart() {
  var data=jQuery("#formserialize").serialize();
    jQuery.ajax({
      url : '/ewasteonline/recyclers/modules/cart.php',
      method : 'post',
      data : data,
      success : function(){location.reload();},
      error : function(){alert("something went wrong");}
    });
}
        function checkoutbtn(total){
            var data={"total" : total};
    jQuery.ajax({
        url:'/ewasteonline/recyclers/checkout.php',
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
    function closecheckoutmodal(){
        jQuery('#checkoutmodal').modal('hide');
        setTimeout(function(){
            jQuery('#checkoutmodal').remove();
            jQuery('.modal-backdrop').remove();
        },500);
}
</script>