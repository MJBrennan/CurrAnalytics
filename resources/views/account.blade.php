
@extends('layouts.app')


@section('content')
<h1>Account Page!</h1>

<ul>
@foreach ($name as $user)
<a href="record/{{$user->id}}"><li id="item">
<p>Date of transcation: {{$user->created_at}}, Initial Amount: {{$user->init_amount}},Converted Amount: {{$user->converted_amount}}, From: USD, To: EUR</p></li>
@endforeach
</ul></a>


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