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
			$data = DB::table('exec')->where('user_id',$auth)->paginate(5);
			return view('account')->with('name', $data);
		}
		else{
			echo "Need to be logged in";
		}

	}


	public function individualRecords($recordid)
		{
			$data = DB::table('exec')->where('id','=',$recordid)->get();
			//return view('account')->with('name', $data);
			return view('recordview')->with('data',$data);
		}
}


