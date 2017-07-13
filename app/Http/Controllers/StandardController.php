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
		$basic->lastFiveWeeks($_POST["from"],$_POST["to"]);
	}

}
