
@extends('layouts.app')


@section('style')

<style>

.col-md-2{
  margin-bottom: 100px;
}

.row{
    margin: 0 auto;
    width:80%;
}





</style>


@endsection



@section('content')

<div class="page-header">
   
   <h4>
      Advanced Converter 
   </h4>
   
</div>

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
<center>
  <div id="mon" class="col-md-2">Monday<br></div>
  <div id="tues" class="col-md-2">Tuesday<br></div>
  <div id="wends" class="col-md-2">Wendnesday<br></div>
  <div id="thurs" class="col-md-2">Thursday<br></div>
  <div id="fri" class="col-md-2">Friday<br></div>
</center>
</div>


<div class="row">
<center>
  <div id="highest" class="col-md-2">Highest<br></div>
  <div id="lowest" class="col-md-2">Lowest<br></div>
  </center>
</div>

<div class="row">
<center>
  <div id="lowest-one" class="col-md-2">Best<br></div>
<center>
</div>

<div  class="row">
<center>
<div id="todaysday" class="col-md-2">Todays Day:<br></div>
</center>
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
    var monday = response.Monday;
    $("#mon").append("<p>"+ origin +response.Monday.toFixed(2) +"</p>");
    $("#tues").append("<p>"+ origin +response.Tuesday.toFixed(2) +"</p>");
    $("#wends").append("<p>"+ origin +response.Wednesday.toFixed(2) +"</p>");
    $("#thurs").append("<p>"+ origin +response.Thursday.toFixed(2) +"</p>");
    $("#fri").append("<p>"+ origin +response.Friday.toFixed(2) +"</p>");
    $("#highest").append("<p>"+ origin +response.Highest.toFixed(2) +"</p>");
    $("#lowest").append("<p>"+ origin +response.LowestAverage[0] +"</p>");
    $("#lowest-one").append("<p>" + response.LowestAverage[1]+"</p>");
    $("#todaysday").append("<p>" + response.CurrentDay +"</p>");
    $("#inputdiv").hide();
    $("#result").show();

    if(response.CurrentDay == response.Highest)
    {
      $('#todaysday').css( "color", "green" );

    }else{

       $('#todaysday').css( "color", "red" );
    }




		}
    });






 $("#currency").show();

}


});





</script>









@endsection