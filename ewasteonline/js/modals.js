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


function update_cart(mode,edit_id){
  var data={"mode" : mode, "edit_id" : edit_id};
    
  jQuery.ajax({
    url : '/wapendwabookshop/updatecart.php',
    method : 'post',
    data : data,
    success : function(data){
       if(data>0){
            $("#quan").text(data);
        }else{
            location.reload();
        }
    },
    error : function(){alert("something went wrong");}
  });
}



function closecheckout(){
        jQuery('#checkout').hide();
      jQuery('#checkout').remove();
      location.reload();
}
