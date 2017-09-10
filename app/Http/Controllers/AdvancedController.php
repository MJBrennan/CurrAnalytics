<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\curl;
use Illuminate\Support\Facades\Auth;
use App\Exec;

class AdvancedController extends Controller
{

public function advanced(Request $request)
{

	$advanced = new Curl($request->input("amount"),$request->input("from"),$request->input("to"));
	$array = json_decode(json_encode($advanced), true);
	$days = $array['returnedData'];
	$lowestAvg = number_format($days["HighestAverage"][0],2).", ". $days["HighestAverage"][1];
	
		if(Auth::check())
		{
			//Saving The Data
			$saveData = new Exec;
			$saveData->user_id = Auth::user()->id;
			$saveData->init_amount = $request->input("from");
			$saveData->converted_amount = $request->input("to");
			$saveData->monday = $days['Monday'];
			$saveData->tues = $days['Tuesday'];
			$saveData->wends = $days['Wednesday'];
			$saveData->thurs = $days['Thursday'];
			$saveData->fri = $days['Friday'];
			$saveData->highest = $days["LowestAverage"][0];
			$saveData->lowestaverage = $lowestAvg;
			$saveData->saving = $days['Saving'];
			$saveData->day = $request->input("amount");
			$saveData->save();
		}

		print_r(json_encode($days));
	}
}
