 $(document).ready(function(){
     $.ajax({
         url: '/ewasteonline/chartjsons/usertype.php',
        method: 'GET',
                 success: function(data){
                     console.log(data);
                     var usertype =[];
                     var orders =[];
                     for(var i in data){
                         if(data[i].usertype==1){
                             usertype.push("Customers");
                            }else if(data[i].usertype==2){
                             usertype.push("Cooperations");
                            }else{
                                usertype.push("Recyclers");
                            }
                        
                         orders.push(data[i].ordersPlaced);
                     }
                     var chartdata={
                         labels : usertype,
                         datasets : [
                             {
                                 label : 'User Types Summary',
                                 backgroundColor: ["#7b68ee","#2E8B57"],
                                 fill : false,
                                 pointRadius : 5,
                                 data: orders
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
                                    text:'EXISTING TYPES OF USERS',
                                    position:'right',
                                    fontSize:30,
                                    fontColor:'#7b68ee'
                                },
                       
                           maintainAspectRatio:true
                            };
                     var ctx1 =$("#usertype_canvas");
        
                     var chart = new Chart(ctx1,{
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