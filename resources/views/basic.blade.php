
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


@endsection



@section('scripts')

<script>

$(window).ready(function()
{
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




 $("#currency").show();

}


});





</script>









@endsection