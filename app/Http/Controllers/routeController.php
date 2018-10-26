<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class routeController extends Controller
{
    public function controllerFunction(Request $request){
    	$pageID=$request->routeID;
       	if($request->session()->has('userLoginSession')){
	    	$ses=$request->session()->get('userLoginSession');
			$result=DB::table('journey')->where('angel',$ses)->first();
			$un = $result->angel; $pw = $result->devil;
			$viewName="";
			switch ($pageID) {
				case 'addBook': $viewName="addBook"; break;
				case 'addMember': $viewName="addMember"; break;
				case 'lendBook': $viewName="lendBook"; break;
				case 'returnBook': $viewName="returnBook"; break;
				case 'searchPage': $viewName="searchPage"; break;
				case 'infoPage': $viewName="infoPage"; break;
				case 'toHome': $viewName="homePage"; break;
				default: $viewName="homePage"; break;
			}
			return view($viewName,['un'=>$un]);
        }
        else{
            return view('indexPage');
        }
	}
}
?>