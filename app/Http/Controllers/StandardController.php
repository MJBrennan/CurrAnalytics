<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\BasicTranslator;


class StandardController extends Controller
{


    public function __construct()
    {

        


    }

	public function convertor()
	{
		$basic = new BasicTranslator();
		$basic->process($_POST["from"],$_POST["to"],$_POST["amount"]);
	}

	public function fiveWeeks()
	{
		$basic = new BasicTranslator();
		$basic->lastFiveWeeks();
	}

	public function charts()
	{
		$chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 600, 'height' => 400])
        ->labels(['January', 'February', 'March', 'April', 'May'])
        ->datasets([
            [
                "label" => "My Second dataset",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [89.09, 90.03, 87.01, 86.01, 88.11],
            ]
        ])
        ->options([]);

return view('charts', compact('chartjs'));
	}
}
