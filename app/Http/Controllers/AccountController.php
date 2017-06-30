<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class AccountController extends Controller
{
    //
	public function checkRecords()
	{

		if(Auth::check())
		{
			$auth = Auth::user()->id;
			$data = DB::table('exec')->where('user_id',$auth)->get();
			var_dump($data);
		}
		else{
			echo "Need to be logged in";
		}

	}


	public function individualRecords()
		{
			$data = DB::table('exec')->where('id','=','2')->get();
			var_dump($data);
		}



}


