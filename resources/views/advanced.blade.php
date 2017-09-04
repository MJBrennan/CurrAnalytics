
@extends('layouts.app')


@section('style')

<style>



.row{
    margin: 0 auto;
    width:80%;
}

.row{
  font-size:20px;
}

.centered-row
{ 
  margin: auto; max-width: 300px;

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

<div id="result-info" style="display:none">
<div class="panel panel-default">
  <div class="panel-body">
    <div style="font-size:20px;" id="currdata-init"></div>
    <p>Using a crafted 
    algorithm, we give you the best day of the week to buy your currency</p>
  </div>
</div>
</div>


<div class = "panel" id="inputdiv">
<div class = "panel-heading">
      <h3 class = "panel-title">Enter Details</h3>
   </div>
  <div class = "panel-body">
 <form>
 Amount:<br>
  <input style="width:100px;"  class="form-control" placeholder="Amount" type="text" name="amount" id="amount"><br>
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
  <input style="width:200px;"  class="form-control" type="text" name="to" id="to" disabled><br>
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

<div id="result" style="display:none;">

<div class="col-md-offset-1">
<div class="row">
  <div id="mon" class="col-md-2">Monday<br></div>
  <div id="tues" class="col-md-2">Tuesday<br></div>
  <div id="wends" class="col-md-2">Wendnesday<br></div>
  <div id="thurs" class="col-md-2">Thursday<br></div>
  <div id="fri" class="col-md-2">Friday<br></div>
</div>
</div>


<div class="col-md-offset-1">
<div class="row">
  <div id="highest" class="col-md-2">Highest<br></div>
  <div id="lowest" class="col-md-2">Lowest<br></div>
</div>
</div>

<div class="col-md-offset-1">
<div  class="row">
<div id="gains" class="col-md-2">Potential Gains:<br></div><br>

</div>
</div>
 
<div class="col-md-offset-1">
<div class="row">
 <b><div id="lowest-one" class="col-md-2" style="font-size:20px;">Best<br></div></b>
</div>
</div>

<div class="col-md-offset-1">
<div  class="row">
<div id="todaysday" class="col-md-2">Todays Day:<br></div><br>

</div>
</div>

<div class="col-md-offset-1">
<div  class="row">
<button  onclick="window.location.reload()" id="start-over" class="btb btn-primary" style="margin:20px;">Start Over</button>

</div>
</div>  
</div>




@endsection



@section('scripts')

<script>

$("#result").hide();

var currdata = {"€":"EUR","£":"GBP","$":"USD"};


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

  var amt = $("#amount").val();
   var or = $("#to").val();
   var fr = $("#from").val();


if(amt == '' || or == '' || fr == ''|| fr == or )
{
  $("#error-modal").modal("show");
  return;
}else{

    getData();
  }

  });





function getData()
{
   $.LoadingOverlay("show");
	 var amount = $("#amount").val();
	 var origin = $("#to").val();
	 var from = $("#from").val();
   $("#currdata-init").append("<p>"+from+ " in " + origin + " in recent months"+"</p>");
   var origin1 = currdata[origin];
   var from1 = currdata[from];

	
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
    data:{from:origin1,to:from1,amount:amount},
    success: function(response){
    console.log(response);
    var response = $.parseJSON(response);
    var monday = response.Monday;
    $("#mon").append("<p>"+ origin +response.Monday.toFixed(2) +"</p>");
    $("#tues").append("<p>"+ origin +response.Tuesday.toFixed(2) +"</p>");
    $("#wends").append("<p>"+ origin +response.Wednesday.toFixed(2) +"</p>");
    $("#thurs").append("<p>"+ origin +response.Thursday.toFixed(2) +"</p>");
    $("#fri").append("<p>"+ origin +response.Friday.toFixed(2) +"</p>");
    $("#highest").append("<p>"+ origin +response.HighestAverage[0].toFixed(2) + "," + response.HighestAverage[1] +"</p>");
    $("#lowest").append("<p>"+ origin +response.LowestAverage[0].toFixed(2) + "," + response.LowestAverage[1] +"</p>");
    $("#gains").append("<p>"+ origin +response.Saving.toFixed(2) +"</p>");
    $("#lowest-one").append("<p>" + response.HighestAverage[1]+"</p>");
    $("#todaysday").append("<p>" + response.CurrentDay +"</p>");
    $("#inputdiv").hide();
    $.LoadingOverlay("hide");
    $("#result").show();
    $("#result-info").show();

    console.log(response);


    if(response.CurrentDay == response.HighestAverage[1])
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