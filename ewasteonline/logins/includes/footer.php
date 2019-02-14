<script>
    jQuery(document).ready(function($){
    
      $(".div_login button").click(function(){
        $(".div_login").addClass('div_adjust');
          $(".div_signUp").removeClass('div_adjust');
     });
         $(".div_signUp button").click(function(){
        $(".div_signUp").addClass('div_adjust');
          $(".div_login").removeClass('div_adjust');
     });
    }
);
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
    function verifyDob(){
        var dob=$("#date").val();
        dob=new Date(dob);
        var today=new Date();
        var age=Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
        if(age < 18){
        $("#date").css('border-color','red');
        $("#date").val("");
        alert("Age Below 18yrs Has been Detected");
           }
    }
</script>
<script src="../js/checks.js"></script>