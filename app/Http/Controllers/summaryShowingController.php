<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class summaryShowingController extends Controller
{
	public function showSummaryFunction(Request $request){
		if($request->session()->has('userLoginSession')){
			$requiredDate=$request->showSummaryOnThis;
			$selected=DB::table("records")->where('dateofaction','=',$requiredDate)->get();
			$selectedCount=DB::table("records")->where('dateofaction','=',$requiredDate)->count();
    		$result = $selected->toArray();
    		$returningArray=array();
    		for ($i=0; $i < $selectedCount; $i++) {
    			$returningArray['0'][$i]=$result[$i]->{'id'};
    			$returningArray['1'][$i]=$result[$i]->{'copy_id'};
    			$returningArray['2'][$i]=$result[$i]->{'membership_no'};
    			$returningArray['3'][$i]=$result[$i]->{'action'};
    		}
			return response()->json(array('rowsNo'=>$selectedCount,'jsonData'=>$returningArray));
	}
    else{
        return view('indexPage');
        }
    }
}
