<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class sessionController extends Controller
{
        public function checkSessionFunction(Request $request){
	    if($request->session()->has('userLoginSession')){
	    	$ses=$request->session()->get('userLoginSession');
			$result=DB::table('journey')->where('angel',$ses)->first();
			$un = $result->angel; $pw = $result->devil;
			//return view('homePage',['un'=>$un,'pw'=>$pw]);
			return view('homePage',['un'=>$un]);
        }
        else{
            return view('indexPage');
        }
	}
}
