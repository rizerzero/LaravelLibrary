<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class memberHistoryController extends Controller
{
	public function memberHistoryFunction(Request $request){
		if($request->session()->has('userLoginSession')){
			$memID=$request->showMemberHistory;
			$selected=DB::table("records")->where('membership_no','=',$memID)->get();
			$selectedCount=DB::table("records")->where('membership_no','=',$memID)->count();
    		$result = $selected->toArray();
    		$returningArray=array();
    		for ($i=0; $i < $selectedCount; $i++) {
    			$returningArray['0'][$i]=$result[$i]->{'id'};
    			$returningArray['1'][$i]=$result[$i]->{'copy_id'};
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
