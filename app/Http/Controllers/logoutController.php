<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class logoutController extends Controller
{
    public function logoutFunction(Request $request){
	    if($request->session()->has('userLoginSession')){
			$request->session()->forget('userLoginSession');
        }
		return redirect('home');
	}
}

?>