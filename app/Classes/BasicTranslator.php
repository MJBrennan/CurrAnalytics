<?php

	namespace App\Classes;



	class BasicTranslator extends Translator{

		//Basic Translator
		
		public function process($origin,$destination,$amount)
		{
			$returnedData = [];
			$request = $this->makeRequest("http://api.fixer.io/latest?base=".$origin);
			$array = json_decode(json_encode($request), true);
			$base = $array["base"];
			$to = $destination;
			$date = $array["date"];
			$rates = $array["rates"][$destination];
			$rates = $rates * $amount;
			array_push($returnedData,$base,$to,$date,$rates);
			$data = json_encode($returnedData,JSON_FORCE_OBJECT);
			print_r($data);
	}

	//Last 5 Weeks

	public function lastFiveWeeks($origin,$destination)
	{
		$days= [];
		$finalValues = [];
		$output = [];

		$day1 = date("Y-m-d",strtotime("-1"."days"));
		$day2 = date("Y-m-d",strtotime("-8"."days"));
		$day3 = date("Y-m-d",strtotime("-15"."days"));
		$day4 = date("Y-m-d",strtotime("-22"."days"));
		$day5 = date("Y-m-d",strtotime("-29"."days"));
		$days[] = $day1;
		$days[] = $day2;
		$days[] = $day3;
		$days[] = $day4;
		$days[] = $day5;
		
		$base = $origin;
		$against = $destination;
		foreach ($days as $value) {
			$request = $this->makeRequest("http://api.fixer.io/".$value."?base=".$base);
			$finalValues[] = $request;
		}

		for ($i=0;$i<=count($finalValues)-1;$i++) { 

			$array = json_decode(json_encode($finalValues), True);
			$vals = $array[$i]['rates'];
			$output[] = $vals[$against];
		}

		$data = json_encode($output,JSON_FORCE_OBJECT);
		print_r($data);

		

	}
}


