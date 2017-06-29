@extends('layouts.app')


@section('content')

<div style="width:75%;">
    {!! $chartjs->render() !!}
</div>




@endsection



@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>





@endsection