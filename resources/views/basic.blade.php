
@extends('layouts.app')


@section('content')



 <form>
 Amount:<br>
  <input class="form-control" style="width:20%;" placeholder="Amount" type="text" name="amount" id="amount"><br>
  <div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    Select From:
    <span class="caret"></span>
  </button>
  <ul id="list" class="dropdown-menu" aria-labelledby="dropdownMenu1">
    <li><span>&euro;</span></li>
    <li><span>&#36;</span></li>
    <li><span>&pound;</span></li>
  </ul>
</div>
  <input class="form-control" type="text" name="to" id="to" ><br>
    <div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    Select To:
    <span class="caret"></span>
  </button>
  <ul id="list2" class="dropdown-menu" aria-labelledby="dropdownMenu1">
    <li><span>&euro;</span></li>
    <li><span>&#36;</span></li>
    <li><span>&pound;</span></li>
  </ul>
</div>
  <input class="form-control" type="text" name="from" id="from">
 </form>

<button style="margin-top:10px;" class="btn btn-primary" id="clicked">Submit</button>

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


var currdata = {"€":"EUR","£":"GBP"};





$('#list li').click(function(e) 
{ 
 var curr = $(this).find("span").text();
 $("#to").val(curr);
 //console.log(curr);
});

$('#list2 li').click(function(e) 
{ 
 var curr = $(this).find("span").text();
 $("#from").val(curr);
 //console.log(curr);
});



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