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
	$array = json_decode(json_encode($advanced), true);
	$days = $array['returnedData'];
	$lowestAvg = $days["LowestAverage"][0].", ".$days["LowestAverage"][1];
	
		if(Auth::check())
		{
			//Saving The Data
			$saveData = new Exec;
			$saveData->user_id = Auth::user()->id;
			$saveData->init_amount = "10";
			$saveData->converted_amount = "12";
			$saveData->day = "Monday";
			$saveData->monday = $days['Monday'];
			$saveData->tues = $days['Tuesday'];
			$saveData->wends = $days['Wednesday'];
			$saveData->thurs = $days['Thursday'];
			$saveData->fri = $days['Friday'];
			$saveData->highest = $days['Highest'];
			$saveData->lowestaverage = $lowestAvg;
			$saveData->saving = $days['Saving'];
			$saveData->save();
		}
	}
}
