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
         url: '/ewasteonline/chartjsons/payments.php',
        method: 'GET',
                 success: function(data){
                     console.log(data);
                     var recyclerid =[];
                     var pay =[];
                     for(var i in data){
                         recyclerid.push(data[i].recyclerName);
                         pay.push(data[i].ordersPaid);
                     }
                     var chartdata={
                         labels : recyclerid,
                         datasets : [
                             {
                                 label : 'OrdersPaid For',
                                 backgroundColor: addtoarray(data),
                                 fill : false,
                                 pointRadius : 5,
                                 data: pay
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
                                    text:'RECYCLER PAYMENTS SUMMARY',
                                    position:'right',
                                    fontSize:30,
                                    fontColor:'#7b68ee'
                                },
                       
                           maintainAspectRatio:true
                            };
                     var ctx3 =$("#payments_canvas");
        
                     var chart = new Chart(ctx3,{
                         type: 'doughnut',
                         options:options,
                         data: chartdata
                     })
                 },
                     error: function(data){
                         console.log(data);
                     }
     });
 });