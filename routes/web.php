<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/standard','StandardController@convertor');

Route::get('/basic', function(){
	return view('basic');
});
Route::get('/procal', function(){
	return view('advanced');
});
Route::post('/advanced','AdvancedController@advanced');

Route::get('/datatest','AdvancedController@database');

Route::get('/datatest','AdvancedController@database');

Route::post('/lastfiveweeks','StandardController@fiveWeeks');

Route::get('/charts','StandardController@charts');

Route::get('/currentday','AdvancedController@currentDay');

Route::get('/allentries','AccountController@checkRecords');

Route::get('/record/{recordid}','AccountController@individualRecords');

Route::get('/account', function(){
	return view('account');
});

Route::get('/prefs', function(){
	return view('prefs');
});






Route::get('auth/google', 'Auth\RegisterController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\RegisterController@handleGoogleCallback');








