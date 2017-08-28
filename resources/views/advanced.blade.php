
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

<div class="col-md-8 col-md-offset-2">
<div class = "panel panel-primary" id="inputdiv">
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
</div>

<div id="result" style="margin-left:10%;">
<center>
<div class="row" style="width:100%;">
  <div id="mon" class="col-md-2">Monday<br></div>
  <div id="tues" class="col-md-2">Tuesday<br></div>
  <div id="wends" class="col-md-2">Wendnesday<br></div>
  <div id="thurs" class="col-md-2">Thursday<br></div>
  <div id="fri" class="col-md-2">Friday<br></div>
</div>
</center>

<center>
<div class="row" style="margin-left:25%;">
  <div id="highest" class="col-md-2">Highest<br></div>
  <div id="lowest" class="col-md-2">Lowest<br></div>
</div>
  </center>
<center>
<div class="row" style="margin-left:30%;">
  <div id="lowest-one" class="col-md-2" style="font-size:20px;">Best<br></div>
</div>
</center>

<div  class="row" style="margin-left:30%;">
<center>
<div id="todaysday" class="col-md-2">Todays Day:<br></div>
</center>
</div>
  
</div>




@endsection



@section('scripts')

<script>

$("#result").hide();

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

$(window).ready(function()
{
	$("#currency").hide();

});

$("#clicked").click(function()
  {
    getData();

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
    console.log(response);
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
    $.LoadingOverlay("hide");
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








</script>









@endsection