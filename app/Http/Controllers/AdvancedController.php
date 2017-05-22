<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\curl;
use Illuminate\Support\Facades\Auth;

class AdvancedController extends Controller
{

	public function advanced()
	{
	$advanced = new Curl("1","USD","EUR");
	
		if(Auth::check())
		{
			
			$saveData = new Exec;









		}
	}


	public function database()
	{
		
	}
}
