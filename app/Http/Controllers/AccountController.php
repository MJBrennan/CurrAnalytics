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
			$data = DB::table('exec')->orderBy('created_at', 'desc')->where('user_id',$auth)->paginate(10);
			return view('account')->with('name', $data);
		}
		else{
			return redirect('/');
		}

	}


	public function individualRecords($recordid)
		{
			$data = DB::table('exec')->where('id','=',$recordid)->get();
			//return view('account')->with('name', $data);
			return view('recordview')->with('data',$data);
		}
}


