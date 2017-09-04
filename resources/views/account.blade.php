
@extends('layouts.app')

@section('style')

<style>

.list-group{
	
	width:80%;
}

body{

	background-color:#ffffff;
}



</style>


@section('content')

<div class="page-header">
   <h4>
     Your Account<br>
<br>
     Past Searches:
   </h4>
</div>
<div class="row">

@if($name->isEmpty())

<center><h4>None Yet!</h4></center>

@endif


<center><ul class="list-group">
@foreach ($name as $user)
<a href="record/{{$user->id}}"><li class="list-group-item list-group-item-info" id="item">
<p>Date of transcation: {{$user->created_at}}, Initial Currency: {{$user->init_amount}},Converted Currency: {{$user->converted_amount}}, Amount {{$user->day}}</p></li></a>
@endforeach
</ul></center>



<div class="row">

<center>{{$name->links()}}</center>

</div>

</div>


@endsection



@section('scripts')
<script>

$(document).ready(function(){

	$("#item").click(function(){

		$.ajax({
				get:"get",
				url:"record",
				success:function(data)
				{
					console.log(data);
				}
		});


	});







});




</script>









@endsection