<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\BasicTranslator;


class StandardController extends Controller
{
    //
	public function convertor()
	{
		$basic = new BasicTranslator();
		$basic->process($_POST["from"],$_POST["to"],$_POST["amount"]);
	}
}
