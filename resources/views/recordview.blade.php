@extends('layouts.app')

@section('style')
<style>
.row{
    margin: 0 auto;
    width:80%;
}


body{

  background-color: #ffffff;

}


#result-info p{

  margin:0;
}

.col-md-offset-2{

  background-color: #ffffff;
}

#result{

background-color: #ffffff;


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



@foreach ($data as $object)

<div class="col-md-8 col-md-offset-2">
<div id="result-info" >
<div class="panel panel-default">
  <div class="panel-body" style="font-size:20px;">
   Date: {{ $object-> created_at}}<br>
    Initial Currency: {{ $object-> init_amount}}<br>
    Converted Currency: {{ $object-> converted_amount}}<br>
    Amount: {{ $object->day}}<br>
  </div>
  @php
  $user_cur = $object->converted_amount
  @endphp
</div>
</div>
</div>

<div id="result" >
   
<div class="col-md-offset-1">
<div class="row">
  <div id="mon" class="col-md-2">Monday<br>{{$user_cur}}{{number_format($object->monday,2)}}</div>
  <div id="tues" class="col-md-2">Tuesday<br>{{$user_cur}}{{ number_format($object->tues,2) }}</div>
  <div id="wends" class="col-md-2">Wendnesday<br>{{$user_cur}}{{ number_format($object->wends,2)  }}</div>
  <div id="thurs" class="col-md-2">Thursday<br>{{$user_cur}}{{ number_format($object->thurs,2)  }}</div>
  <div id="fri" class="col-md-2">Friday<br>{{$user_cur}}{{$user_cur}}{{ number_format($object->fri,2)  }}</div>
</div>
</div>

</div>


<div class="col-md-offset-1">
<div class="row">
  <div id="highest" class="col-md-2">Highest<br>{{$user_cur}}{{number_format( $object->highest,2)}}</div>
  <div id="lowest" class="col-md-2">Lowest<br>{{$user_cur}}{{$object->lowestaverage}}</div>
</div>
</div>

<div class="col-md-offset-1">
<div class="row">
 <b><div id="lowest-one" class="col-md-2" style="font-size:20px;">Best<br>{{$user_cur}}{{$object->lowestaverage}}</div></b>
</div>
</div>

  
</div>


  
  @endforeach

<div class="col-md-offset-2"
 <a href="allentries"><button  id="start-over" class="btb btn-primary" style="margin:20px;">Return to List</button></a>
</div>


@endsection

@section('scripts')

<script>



$("#start-over").click(function(){
window.location.href = '/allentries';
});

</script>


@endsection









 