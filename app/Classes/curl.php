<?php

namespace App\Classes;

	class Curl extends Translator{

		public $currencyData;
		public $finalFigures;
		public $returnedData;
		public $input;
		public $from;
		public $to;

		public function __construct($input,$from,$to)
		{
			$this->input = $input;
			$this->from = $from;
			$this->to = $to;
			$this->getDate();
			$this->addData();
		}

		public function dayOfWeek($dateNeeded)
		{
			$day=strftime("%A",strtotime($dateNeeded));
			return $day;
		}

		public function getDate()
		{
			
			$userInput = $this->input;
			for($i=-1;$i >= -90 ;$i--)
			{
			$yesterday = date("Y-m-d",strtotime($i."days"));
			$dayofweek = $this->dayOfWeek($yesterday);
			$request = $this->makeRequest("http://api.fixer.io/".$yesterday."?base=".$this->from);
			$array = json_decode(json_encode($request), true);
			$base = $array["base"];
			$rates = $array["rates"][$this->to];
			$amount = $rates * $userInput;
			$this->currencyData[$dayofweek][] = $amount;
			$count = count($this->currencyData[$dayofweek]);
		
			if($count === 12)
			{
				array_pop($this->currencyData[$dayofweek]);
			}
		
		
		}

		return $this->currencyData;

		}

		public function addData()
		{
			$addition = $this->currencyData;
			unset($addition['Sunday']);
			unset($addition['Saturday']);
			//Add all for Each Day
			$averagemon = array_sum($addition['Monday']);
			$averagemon = $averagemon / 12;
			$this->returnedData['Monday'] = $averagemon;
			$averagetues = array_sum($addition['Tuesday']);
			$averagetues = $averagetues / 12;
			$this->returnedData['Tuesday'] = $averagetues;
			$averagewes = array_sum($addition['Wednesday']);
			$averagewes = 	$averagewes / 12;
			$this->returnedData['Wednesday'] = $averagewes;
			$averagethurs = array_sum($addition['Thursday']);
			$averagethurs = $averagethurs/ 12;
			$this->returnedData['Thursday'] = $averagethurs;
			$averagefri = array_sum($addition['Friday']);
			$averagefri = $averagefri / 12;
			$this->returnedData['Friday'] = $averagefri;
			$h = max($this->returnedData);
			$minVal = min($this->returnedData);
			$this->returnedData['Highest'] = $h;
			$saving = $h - $minVal;
			$this->returnedData['Saving'] = $saving;
			$search = array_search($minVal,$this->returnedData);
			$this->returnedData['LowestAverage'][] = $minVal;
			$this->returnedData['LowestAverage'][] = $search;
			//Current Day of The Wekk
			$date = date("l");
			$this->returnedData['CurrentDay'][] = $date;
			

			return $this->returnedData;
		}
	}
