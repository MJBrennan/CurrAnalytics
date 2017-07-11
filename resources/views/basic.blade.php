
@extends('layouts.app')


@section('content')

 <form>
 Amount:<br>
  <input type="text" name="amount" id="amount"><br>
  From:<br>
  <input type="text" name="to" id="to"><br>
  To:<br>
  <input type="text" name="from" id="from">
 </form>

<button id="clicked">Submit</button>

<h1>Result</h1>
<div id="currency"></div>

<canvas id="myChart"></canvas>







@endsection



@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"/>
</script>
<script>

$(window).ready(function()
{
  var ctx = document.getElementById('myChart').getContext('2d');
	$("#currency").hide();
	$("#clicked").click(function()
	{
		getData();
	});


function getData()
{
	 var amount = $("#amount").val();
	 var origin = $("#to").val();
	 var from = $("#from").val();
	
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

 $.ajax({
    method:"post",
    url:"lastfiveweeks",
    data:{from:origin,to:from},
    success: function(response){
    console.log(response);
   var response = $.parseJSON(response);

var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',


    // The data for our dataset
    data: {
        labels: ["January", "February", "March", "April", "May"],
        datasets: [{
            label: "My First dataset",
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [response[0], response[1], response[2], response[3], response[4], response[5]],
        }]
    },

    // Configuration options go here
    options: {}
});












   
    }
    });







 $("#currency").show();

}




});








</script>









@endsection