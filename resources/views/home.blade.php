@extends('layouts.app')




@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Overview</div>

                <div class="panel-body">
                 What is CurrAnalytics? A new product conceptualized, designed and programmed by me MJBrennan. I've always had an interest in financial markets and wanted to contribute. There are three main parts to this product so far. Advanced Convertor, Basic Convertor and Account Managment. Over 20 major currencies are supported with support for crypto currencies coming later onn<br>
                <br>

    <center><p><img src="http://i.imgur.com/iis0gj9.jpg" style="width:80%;"></img></p></center>
            

                 <b><p>Advanced Convertor</p></b>
                 <p>
                 <p> First there is the Advanced Translator. This is a tool that will allow you to better plan out your currency conversions. Using an algorithm developed by me I get the average of each day of the week and give you the best day of the week to buy your currency. A wide range of international currencies is supported with support for crypto currencies coming later</p>

                  <b><p>Basic Convertor</p></b>
                 <p>
                 <p>Also included is a simple currency convertor. You can view the performance of a currency via charts as well</p>

                 <b><p>Account</p></b>
                 <p>
                 <p>Its possible to track your past searches in the account section. </p>

                 <b><p>Future</p></b>
                 <p>
                 <p>I'm planning on adding support for cryptocurrencys like Bitcoin very shortly. In addition I'm always researching new ways to improve calculations. In addition the next version will see the ability to set currency prefrences in the account section</p>

                   <b><p>Tech</p></b>
                 <p>
                 <p>What tech is behind this application?. PHP 7.1 with Laravel with plenty of usual Javascript, HTML and CSS. A special thanks for Fixer.io for providing a robust api for currency data.</p>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
