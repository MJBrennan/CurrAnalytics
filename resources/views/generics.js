function ajaxLoader()
{
 $.ajaxSetup({
     headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
     });

 $.ajax({
    method:"post",
    url:"standard",
    data:{from:origin,to:from,amount:amount},
    success: function(response){
    var response = $.parseJSON(response);
    $("#currency").append("<h4>"+ amount +" " +response[0]+ " in "+ response[1] +" is " + response[3] + " on " + response[2] + "</h4>");
		}
    });
}