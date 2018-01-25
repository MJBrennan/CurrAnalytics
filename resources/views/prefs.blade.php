@extends('layouts.app')

@section('style')

<style>

.scrollable-menu {
    height: auto;
    max-height: 100px;
    overflow-x: hidden;
}

</style>


@endsection

@section('content')





<div class="page-header">
   <h4>
     Prefrences 
   </h4>
</div>

<div class="col-md-8 col-md-offset-2">
<div class = "panel" id="panel-width">
<div class = "panel-heading">
      <h3 class = "panel-title">Set Prefrences</h3>
   </div>
  <div class = "panel-body">
 <form>
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

<button style="margin-top:10px;" class="btn btn-primary" id="clicked">Save</button>
</div>
</div>
</div>

@endsection



@section('scripts')

<script>
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




$("#clicked").click(function()
{

  var origin = $("#to").val();
  var from = $("#from").val();

   $.ajaxSetup({
     headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
     });

    $.ajax({
    method:"post",
    url:"changeprefs",
    data:{from:origin,to:from},

    success: function(response){
      alert("Prefrences Saved");
    }
    });





});



  </script>



@endsection