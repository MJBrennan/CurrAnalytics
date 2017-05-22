<?php

	namespace App\Classes;

	class Translator{
		public function makeRequest($request)
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $request);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			$output = curl_exec($ch);
			curl_close($ch);
			$decoded = json_decode($output);
			return $decoded;
		}
	}


