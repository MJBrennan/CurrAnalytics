
@extends('layouts.app')

@section('style')

<style>

#panel-width{
width:50%;
margin-left:auto;
margin-right:auto;
}

#myChart{
width:50%;
margin-left:auto;
margin-right:auto;
}

button{

  margin-bottom:30px;

}

</style>


@section('content')

<div class="page-header">
   
   <h4>
     Basic Converter 
   </h4>
   
</div>

<div class = "panel panel-primary" id="panel-width">
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
  <ul id="list" class="dropdown-menu" aria-labelledby="dropdownMenu1">
    <li><span>&euro;</span></li>
    <li><span>&#36;</span></li>
    <li><span>&pound;</span></li>
  </ul>
</div>
  <input class="form-control" style="width:200px;" type="text" name="to" id="to" disabled><br>
    <div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="margin-bottom:5px;">
    Select To:
    <span class="caret"></span>
  </button>
  <ul id="list2" class="dropdown-menu" aria-labelledby="dropdownMenu1">
    <li><span>&euro;</span></li>
    <li><span>&#36;</span></li>
    <li><span>&pound;</span></li>
  </ul>
</div>
  <input style="width:200px;" class="form-control" type="text" name="from" id="from" disabled>
 </form>

<button style="margin-top:10px;" class="btn btn-primary" id="clicked">Submit</button>
</div>
</div>
<div id="result-panel">

<div class = "panel panel-primary" id="panel-width">
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
	$("#result-panel").hide();
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
    var invert = _.invert(currdata);
    console.log(response);
    console.log(invert);
    $("#panel-width").hide();
    console.log(invert[response[0]]);
    $("#currency").append("<center><h4>"+ amount +" " + invert[response[0]]+ " in "+ invert[response[1]] +" is " + response[3] + " <br>Date: " + response[2] + "</h4></center>");
		}
    });

 $.ajax({
    method:"post",
    url:"lastfiveweeks",
    data:{from:origin,to:from},
    success: function(response){
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







 $("#result-panel").show();

 

}




});








</script>









@endsection