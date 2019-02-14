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
         url: '/ewasteonline/chartjsons/inventory_line.php',
        method: 'GET',
                 success: function(data){
                     console.log(data);
                     var name =[];
                     var sales =[];
                     for(var i in data){
                         name.push(data[i].selldate);
                         sales.push(data[i].sales);
                     }
                     var chartdata={
                         labels : name,
                         datasets : [
                             {
                                 label : 'Orders Placed',
                                 backgroundColor: '#7b68ee',
                                 fill : false,
                                 pointRadius : 5,
                                 data: sales
                             }
                         ]
                     };
                        var options = {
                                legend: {
                                    display: false,
                                    labels:{
                                        fontColor:'#7b68ee',
                                        padding:40
                                    },
                                    position:'right',
                                    fullWidth:false
                                   
                                },
                                title:{
                                    display:true,
                                    text:'E-WASTE AQUISITION ACCORDING TO DATES',
                                    position:'top',
                                    fontSize:30,
                                    fontColor:'#7b68ee'
                                },
                       
                           maintainAspectRatio:true
                            };
                     var ctx2 =$("#Inventory_line_canvas");
        
                     var chart = new Chart(ctx2,{
                         type: 'line',
                         options:options,
                         data: chartdata
                     })
                 },
                     error: function(data){
                         console.log(data);
                     }
     });
 });