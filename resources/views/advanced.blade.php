
@extends('layouts.app')


@section('content')
<div id="inputdiv">
 <form>
 Amount:<br>
  <input type="text" name="amount" id="amount"><br>
  From:<br>
  <input type="text" name="to" id="to"><br>
  To:<br>
  <input type="text" name="from" id="from">
 </form>

<button id="clicked">Submit</button>
</div>

<div id="result">

<div class="row">
  <div id="mon" class="col-md-2">Monday<br></div>
  <div id="tues" class="col-md-2">Tuesday<br></div>
  <div id="wends" class="col-md-2">Wendnesday<br></div>
  <div id="thurs" class="col-md-2">Thursday<br></div>
  <div id="fri" class="col-md-2">Friday<br></div>
</div>


<div class="row">
  <div id="highest" class="col-md-2">Highest<br></div>
  <div id="lowest" class="col-md-2">Lowest<br></div>
</div>

<div class="row">
  <div id="lowest-one" class="col-md-2">Best<br></div>
</div>
  
</div>



@endsection



@section('scripts')

<script>

$(window).ready(function()
{
	$("#currency").hide();
  $("#result").hide();

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

   /***

   *  Still Need To Sort Out Lowest and Saving
   *
   *

   */

 $.ajax({
    method:"post",
    url:"advanced",
    data:{from:origin,to:from,amount:amount},
    success: function(response){
    var response = $.parseJSON(response);
    $("#mon").append("<p>"+response.Monday +"</p>");
    $("#tues").append("<p>"+response.Tuesday +"</p>");
    $("#wends").append("<p>"+response.Wednesday +"</p>");
    $("#thurs").append("<p>"+response.Thursday +"</p>");
    $("#fri").append("<p>"+response.Friday +"</p>");
    $("#highest").append("<p>"+response.Highest +"</p>");
    $("#lowest").append("<p>"+response.Highest +"</p>");
     $("#lowest-one").append("<p>"+response.Highest +"</p>");
    $("#inputdiv").hide();
    $("#result").show();
		}
    });




 $("#currency").show();

}


});





</script>









@endsection