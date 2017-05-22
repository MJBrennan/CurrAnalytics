<?php

	namespace App\Classes;



	class BasicTranslator extends Translator{
		
		public function process($origin,$destination,$amount)
		{
			$returnedData = [];
			$request = $this->makeRequest("http://api.fixer.io/latest?base=" . $origin);
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
}


