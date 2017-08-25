@extends('layouts.app')

@section('style')
<style>
.col-md-2{
  margin-bottom: 100px;
}

.row{
    margin: 0 auto;
    width:80%;
    color:#fff;
}


.row :nth-child(even){
  background-color: #5cb85c;
}
.row :nth-child(odd){
  background-color: #5bc0de;
}
</style>
@endsection

@section('content')




<div id="result">
<div class="row">
<center>
@foreach ($data as $object)
   
  <div id="mon" class="col-md-2">Monday  <br>{{ $object->monday }}</div>
  <div id="tues" class="col-md-2">Monday <br>{{ $object->tues }}</div>
  <div id="wends" class="col-md-2">Wendnesday<br> {{ $object->wends }} </div>
  <div id="thurs" class="col-md-2">Thursday<br> {{ $object->thurs }}</div>
  <div id="fri" class="col-md-2">Friday <br> {{ $object->fri }} </div>
</center>
</div>


<div class="row">
<center>
  <div id="highest" class="col-md-2">Highest<br> {{ $object->highest }}</div>
  <div id="lowest" class="col-md-2">Lowest<br> {{ $object->lowestaverage }}</div>
  </center>
</div>

<div class="row">
<center>
  <div id="lowest-one" class="col-md-2">Best<br> {{ $object->saving }}</div>
<center>
</div>

  
  @endforeach
</div>

@endsection