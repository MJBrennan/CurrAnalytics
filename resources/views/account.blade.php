
@extends('layouts.app')


@section('content')
<h1>Account Page!</h1>

<ul>
@foreach ($name as $user)
<li id="item">
<p>Date of transcation: {{$user->created_at}}</p>
<p>Initial Amount: {{$user->init_amount}}</p>
<p>Converted Amount: {{$user->converted_amount}}</p>
<p>From: USD</p>
<p>To: EUR</p>
</li>
@endforeach
</ul>


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