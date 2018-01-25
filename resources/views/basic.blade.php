
@extends('layouts.app')

@section('style')

<style>


button{

  margin-bottom:30px;

}

.footer{

  display:none;

}

.scrollable-menu {
    height: auto;
    max-height: 100px;
    overflow-x: hidden;
}

</style>


@section('content')



<div class="page-header">
   <h4>
     Basic Converter 
   </h4>
</div>

<div class="col-md-8 col-md-offset-2">
<div class = "panel" id="panel-width">
<div class = "panel-heading">
      <h3 class = "panel-title">Enter Details</h3>
   </div>
  <div class = "panel-body">
 <form>
 Amount:<br>
  <input class="form-control" style="width:100px;" placeholder="Amount" type="text" name="amount" id="amount"><br>
  <div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="margin-bottom:5px;">
    Select From:
    <span class="caret"></span>
  </button>
  <ul id="list" class="dropdown-menu scrollable-menu" role="menu">
  
  </ul>
</div>
  <input class="form-control" style="width:200px;" type="text" name="to" id="to" disabled><br>
    <div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="margin-bottom:5px;">
    Select To:
    <span class="caret"></span>
  </button>
  <ul id="list2" class="dropdown-menu scrollable-menu" aria-labelledby="dropdownMenu1">
  
  </ul>
</div>
  <input style="width:200px;" class="form-control" type="text" name="from" id="from"  disabled>
 </form>

<button style="margin-top:10px;" class="btn btn-primary" id="clicked">Submit</button>
</div>
</div>
<div id="result-panel" style="display:none;">
<div class = "panel" id="panel-width">
<div class = "panel-heading">
      <h3 class = "panel-title">Result</h3>
   </div>
  <div class = "panel-body">

  <div id="currency"><h1></h1></div>
  <center><p>Last Five Months:</p></center>
  <canvas id="myChart"></canvas>

  </div>

  <center><button  onclick="window.location.reload()" id="start-over" class="btb btn-primary" style="margin:20px;">Start Over</button></center>

</div>
</div>
</div>

<div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Error</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Please Review Errors
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>












@endsection



@section('scripts')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js">
</script>
<script>

//$("#error-modal").modal("show")


$(window).ready(function()
{





var len = symbolsarr.length;

  for(i=0;i<=len-1;i++)
  {

     $("#list").append("<li><span>"+ symbolsarr[i] +"</span></li>");

  }

   for(i=0;i<=len-1;i++)
  {

     $("#list2").append("<li><span>"+ symbolsarr[i] +"</span></li>");

  }




$('#list li').click(function(e) 
{ 
 var curr = $(this).find("span").text();
 $("#to").val(curr);
});

$('#list2 li').click(function(e) 
{ 
 var curr = $(this).find("span").text();
 $("#from").val(curr);
});



  var ctx = document.getElementById('myChart').getContext('2d');
	$("#clicked").click(function()
	{

   var amt = $("#amount").val();
   var or = $("#to").val();
   var fr = $("#from").val();


if(amt == '' || or == '' || fr == ''|| fr == or )
{
 $("#error-modal").modal("show");

  return;
}else{



try{

  getData();
  setTimeout(function(){
  $("#result-panel").show();
  $.LoadingOverlay("hide");
  }, 2000); 

}catch(error)
{
  $("#panel-width").show();
   alert(error)
}



}
	});


function getData()
{
  $.LoadingOverlay("show");
	 var amount = $("#amount").val();
	 var origin = $("#to").val();
	 var from = $("#from").val();
   origin = currdata[origin];
   from = currdata[from];

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
    var invert = _.invert(currdata);
    $("#panel-width").hide();
    $("#currency").append("<center><h4>"+ amount +" " + invert[response[0]]+ " in "+ invert[response[1]] +" is " + response[3].toFixed(2) + " <br>Date: " + response[2] + "</h4></center>");
		}
    });

 $.ajax({
    method:"post",
    url:"lastfiveweeks",
    data:{from:origin,to:from},
    success: function(response){
   var response = $.parseJSON(response);

   var monthArr = [];

   for (var i = 0; i <= 4; i++) 
   {
     
   var prevMonthName  = moment().subtract(i, "month").format('MMMM');
   monthArr.push(prevMonthName);
   
   }

   console.log(monthArr);

//Contrived way of getting the last 5 months for the chart

   months = [];
   dt = new Date;
   month = dt.getMonth();
  var monthNames = [ "January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December" ];

  var time = month - 4;

  for($i=month;$i>=time;$i--)
  {
    months.push(monthNames[$i]);
  }
  







var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: [monthArr[4], monthArr[3], monthArr[2], monthArr[1], monthArr[0]],
        datasets: [{
            label: origin + " in "+from,
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [response[4], response[3], response[2], response[1], response[0]],
        }]
    },

    // Configuration options go here
    options: {}
});










   
 }
    });





 

}




});








</script>









@endsection