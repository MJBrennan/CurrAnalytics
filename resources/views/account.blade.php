
@extends('layouts.app')

@section('style')

<style>

.list-group{
	
	width:80%;
}



</style>


@section('content')

<div class="page-header">
   
   <h4>
     Your Account
   </h4>
   
</div>
<div class="row">

<center><ul class="list-group">
@foreach ($name as $user)
<a href="record/{{$user->id}}"><li class="list-group-item list-group-item-info" id="item">
<p>Date of transcation: {{$user->created_at}}, Initial Amount: {{$user->init_amount}},Converted Amount: {{$user->converted_amount}}, From: USD, To: EUR</p></li></a>
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