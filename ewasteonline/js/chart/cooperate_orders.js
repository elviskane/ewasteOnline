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
         url: '/ewasteonline/chartjsons/cooperate_orders.php',
        method: 'GET',
                 success: function(data){
                     console.log(data);
                     var userid =[];
                     var orders =[];
                     for(var i in data){
                         userid.push(data[i].copName);
                         orders.push(data[i].ordersPlaced);
                     }
                     var chartdata={
                         labels : userid,
                         datasets : [
                             {
                                 label : 'cooperate orders',
                                 backgroundColor: addtoarray(data),
                                 fill : false,
                                 pointRadius : 5,
                                 data: orders
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
                                    text:'COOPERATE ORDERS',
                                    position:'top',
                                    fontSize:30,
                                    fontColor:'#7b68ee'
                                },
                       
                           maintainAspectRatio:true
                            };
                     var ctx1 =$("#coporders_canvas");
        
                     var chart = new Chart(ctx1,{
                         type: 'bar',
                         options:options,
                         data: chartdata
                     })
                 },
                     error: function(data){
                         console.log(data);
                     }
     });
 });