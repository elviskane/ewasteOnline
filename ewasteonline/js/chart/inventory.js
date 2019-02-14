 $(document).ready(function(){
      function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;   
    
   
}
     function addtoarray(data){
         var datalenth=data.length;
         var colorget=Array();
         for(var i=0;i<datalenth;i++){
             colorget.push(getRandomColor());
         }
         return colorget;
     }
     $.ajax({
         url: '/ewasteonline/chartjsons/inventory.php',
        method: 'GET',
                 success: function(data){
                     console.log(data);
                     var name =[];
                     var quantity =[];
                    
                     for(var i in data){
                         name.push(data[i].devicetype);
                         quantity.push(data[i].quantity);
                     }
                     console.log(addtoarray(data));
                     var chartdata={
                         labels : name,
                         datasets : [
                             {
                                 label : 'Number Of E-waste devices In Inventory',
                                 backgroundColor: addtoarray(data),
                                 fill : false,
                                 pointRadius : 5,
                                 data: quantity
                             }
                         ]
                     };
                       var options = {
                                legend: {
                                    display: true,
                                    labels:{
                                        fontColor:'#7b68ee',
                                        padding:40
                                    },
                                    position:'left',
                                    fullWidth:false
                                   
                                },
                                title:{
                                    display:true,
                                    text:'INVENTORY SUMMARY',
                                    position:'right',
                                    fontSize:30,
                                    fontColor:'#7b68ee'
                                },
                       
                           maintainAspectRatio:true
                            };

                     var ctx =$("#inventory_canvas");
        
                     var chart = new Chart(ctx,{
                         type: 'doughnut',
                         data: chartdata,
                         options:options
                     });
                 },
                     error: function(data){
                         console.log(data);
                     }
     });
 });