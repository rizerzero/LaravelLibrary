<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class copyHistoryController extends Controller
{
	public function copyHistoryFunction(Request $request){
		if($request->session()->has('userLoginSession')){
			$copyID=$request->showCopyHistory;
			$selected=DB::table("records")->where('copy_id','=',$copyID)->get();
			$selectedCount=DB::table("records")->where('copy_id','=',$copyID)->count();
    		$result = $selected->toArray();
    		$returningArray=array();
    		for ($i=0; $i < $selectedCount; $i++) {
    			$returningArray['0'][$i]=$result[$i]->{'id'};
    			$returningArray['1'][$i]=$result[$i]->{'membership_no'};
    			$returningArray['2'][$i]=$result[$i]->{'action'};
    			$returningArray['3'][$i]=$result[$i]->{'dateofaction'};
    		}
			return response()->json(array('rowsNo'=>$selectedCount,'jsonData'=>$returningArray));

        }
        else{
            return view('indexPage');
        }
    }
}
