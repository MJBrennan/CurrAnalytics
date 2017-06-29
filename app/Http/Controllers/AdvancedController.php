<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\curl;
use Illuminate\Support\Facades\Auth;
use App\Exec;

class AdvancedController extends Controller
{

public function advanced()
{

	$advanced = new Curl("1","USD","EUR");
	
		if(Auth::check())
		{
			$saveData = new Exec;
			$saveData->user_id = Auth::user()->id;
			$saveData->init_amount = "10";
			$saveData->converted_amount = "12";
			$saveData->day = "Monday";
			$saveData->monday = "10";
			$saveData->tues = "Monday";
			$saveData->wends = "Monday";
			$saveData->thurs = "Monday";
			$saveData->fri = "Monday";
			$saveData->highest = "Monday";
			$saveData->lowestaverage = "Monday";
			$saveData->saving = "Monday";

			$saveData->save();
		}
	}

	public function database()
	{
		
	}
}
