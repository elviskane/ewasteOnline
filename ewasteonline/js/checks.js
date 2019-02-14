function check_customer_uname(){  
var uname=jQuery("#uname").val();
    var data={"custuname":uname};
    
  jQuery.ajax({
    url : '/ewasteonline/core/checks.php',
    method : 'GET',
      dataType : 'json',
      async : false,
    data : data,
    success : function(data){
     if(jQuery.trim(data)==''){
        console.log("no data");
        }else{
            jQuery("#uname").val("");
            jQuery("#uname").attr("placeholder","Enter Another UserName");
            alert("THIS USERNAME : '" + data[0].UserName + "' HAS ALREADY BEEN TAKEN. ENTER ANOTHER ONE");
            
        }
    },
    error : function(){alert("something went wrong");}
  });
}


function check_customer_email(){  
var email=jQuery("#email").val();
    var data={"custemail":email};
    
  jQuery.ajax({
    url : '/ewasteonline/core/checks.php',
    method : 'GET',
      dataType : 'json',
      async : false,
    data : data,
    success : function(data){
     if(jQuery.trim(data)==''){
        console.log("no data");
        }else{
            jQuery("#email").val("");
            jQuery("#email").attr("placeholder","Enter Another Email");
            alert("This Email Address : '" + data[0].email + "' Has Already Been Taken. Enter Another One");
            
        }
    },
    error : function(){alert("something went wrong");}
  });
}


function check_customer_phone(){  
var phone=jQuery("#mobile").val();
    var data={"custphone":phone};
    
  jQuery.ajax({
    url : '/ewasteonline/core/checks.php',
    method : 'GET',
      dataType : 'json',
      async : false,
    data : data,
    success : function(data){
     if(jQuery.trim(data)==''){
        console.log("no data");
        }else{
            jQuery("#mobile").val("");
            jQuery("#mobile").attr("placeholder","Enter Another Number");
            alert("This PhoneNumber : '" + data[0].Phone + "' Has Already Been Taken. Enter Another One");
            
        }
    },
    error : function(){alert("something went wrong");}
  });
}


function check_customer_nat(){  
var nat=jQuery("#natid").val();
    var data={"custnat":nat};
    
  jQuery.ajax({
    url : '/ewasteonline/core/checks.php',
    method : 'GET',
      dataType : 'json',
      async : false,
    data : data,
    success : function(data){
     if(jQuery.trim(data)==''){
        console.log("no data");
        }else{
            jQuery("#natid").val("");
            jQuery("#natid").attr("placeholder","Enter Another National Id");
            alert("This NationalId : '" + data[0].nationalid + "' Has Already Been Taken. Enter Another One");
            
        }
    },
    error : function(){alert("something went wrong");}
  });
}


function check_cop_name(){  
var names=jQuery("#copname").val();
    var data={"copname":names};
    
  jQuery.ajax({
    url : '/ewasteonline/core/checks.php',
    method : 'GET',
      dataType : 'json',
      async : false,
    data : data,
    success : function(data){
     if(jQuery.trim(data)==''){
        console.log("no data");
        }else{
            jQuery("#copname").val("");
            jQuery("#copname").attr("placeholder","Enter Company Name");
            alert("This Name : '" + data[0].Names + "' Has Already Been Taken. Enter Another One");
            
        }
    },
    error : function(){alert("something went wrong");}
  });
}


function check_cop_email(){  
var email=jQuery("#copemail").val();
    var data={"copemail":email};
    
  jQuery.ajax({
    url : '/ewasteonline/core/checks.php',
    method : 'GET',
      dataType : 'json',
      async : false,
    data : data,
    success : function(data){
     if(jQuery.trim(data)==''){
        console.log("no data");
        }else{
            jQuery("#copemail").val("");
            jQuery("#copemail").attr("placeholder","Enter Another CompanyEmail");
            alert("This Email : '" + data[0].companyEmail + "' Has Already Been Taken. Enter Another One");
            
        }
    },
    error : function(){alert("something went wrong");}
  });
}


function check_cop_phone(){  
var phone=jQuery("#copphone").val();
    var data={"copphone":phone};
    
  jQuery.ajax({
    url : '/ewasteonline/core/checks.php',
    method : 'GET',
      dataType : 'json',
      async : false,
    data : data,
    success : function(data){
     if(jQuery.trim(data)==''){
        console.log("no data");
        }else{
            jQuery("#copphone").val("");
            jQuery("#copphone").attr("placeholder","Enter Another CompanyNumber");
            alert("This PhoneNumber : '" + data[0].phonenumber + "' Has Already Been Taken. Enter Another One");
            
        }
    },
    error : function(){alert("something went wrong");}
  });
}

function check_rec_email(){  
var email=jQuery("#recemail").val();
    var data={"recemail":email};
    
  jQuery.ajax({
    url : '/ewasteonline/core/checks.php',
    method : 'GET',
      dataType : 'json',
      async : false,
    data : data,
    success : function(data){
     if(jQuery.trim(data)==''){
        console.log("no data");
        }else{
            jQuery("#recemail").val("");
            jQuery("#recemail").attr("placeholder","Enter Another Email");
            alert("This Email : '" + data[0].recyclerEmail + "' Has Already Been Taken. Enter Another One");
            
        }
    },
    error : function(){alert("something went wrong");}
  });
}

function check_rec_phone(){  
var phone=jQuery("#recphone").val();
    var data={"recphone":phone};
    
  jQuery.ajax({
    url : '/ewasteonline/core/checks.php',
    method : 'GET',
      dataType : 'json',
      async : false,
    data : data,
    success : function(data){
     if(jQuery.trim(data)==''){
        console.log("no data");
        }else{
            jQuery("#recphone").val("");
            jQuery("#recphone").attr("placeholder","Enter Another Number");
            alert("This PhoneNumber : '" + data[0].recyclerPhone + "' Has Already Been Taken. Enter Another One");
            
        }
    },
    error : function(){alert("something went wrong");}
  });
}

function check_admin_uname(){  
var unames=jQuery("#adminuname").val();
    var data={"adminuname":unames};
    
  jQuery.ajax({
    url : '/ewasteonline/core/checks.php',
    method : 'GET',
      dataType : 'json',
      async : false,
    data : data,
    success : function(data){
     if(jQuery.trim(data)==''){
        console.log("no data");
        }else{
            jQuery("#adminuname").val("");
            jQuery("#adminuname").attr("placeholder","Enter Another UserName");
            alert("This UserName : '" + data[0].UserName + "' Has Already Been Taken. Enter Another One");
            
        }
    },
    error : function(){alert("something went wrong");}
  });
}

function check_admin_email(){  
var email=jQuery("#adminemail").val();
    var data={"adminemail":email};
    
  jQuery.ajax({
    url : '/ewasteonline/core/checks.php',
    method : 'GET',
      dataType : 'json',
      async : false,
    data : data,
    success : function(data){
     if(jQuery.trim(data)==''){
        console.log("no data");
        }else{
            jQuery("#adminemail").val("");
            jQuery("#adminemail").attr("placeholder","Enter Another Email");
            alert("This Email : '" + data[0].email + "' Has Already Been Taken. Enter Another One");
            
        }
    },
    error : function(){alert("something went wrong");}
  });
}

function check_admin_nat(){  
var nat=jQuery("#adminnat").val();
    var data={"adminnat":nat};
    
  jQuery.ajax({
    url : '/ewasteonline/core/checks.php',
    method : 'GET',
      dataType : 'json',
      async : false,
    data : data,
    success : function(data){
     if(jQuery.trim(data)==''){
        console.log("no data");
        }else{
            jQuery("#adminnat").val("");
            jQuery("#adminnat").attr("placeholder","Enter Another National Id");
            alert("This NationalId : '" + data[0].nationalid + "' Has Already Been Taken. Enter Another One");
            
        }
    },
    error : function(){alert("something went wrong");}
  });
}


