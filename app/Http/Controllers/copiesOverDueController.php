<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class copiesOverDueController extends Controller
{
	public function showOverDueFunction(Request $request){
		if($request->session()->has('userLoginSession')){
			$lendedEntries=DB::table("records")->where('action','=','lended')->get();
			$lendedEntriesCount=DB::table("records")->where('action','=','lended')->count();
    		$lendedArray = $lendedEntries->toArray();
			$overdueBooks=array();
    		$overdueBooksCount=0;
			for ($i=0; $i < $lendedEntriesCount; $i++) {
				$lendedCountForAcopy=DB::table("records")->where('copy_id','=',$lendedArray[$i]->{'copy_id'})->where('action','=','lended')->count();
				$returnedCountForAcopy=DB::table("records")->where('copy_id','=',$lendedArray[$i]->{'copy_id'})->where('action','=','returned')->count();
				if ($lendedCountForAcopy>$returnedCountForAcopy) {
					$summa=$lendedArray[$i]->{'copy_id'};
					$overDueCopies=DB::table("records")->where('copy_id','=',$lendedArray[$i]->{'copy_id'})->where('action','=','lended')->orderBy('dateofaction', 'DESC')->take(1)->get();
					$targetEntry = $overDueCopies->toArray();
					$overdueBooks['0'][$overdueBooksCount]=$targetEntry[$overdueBooksCount]->{'id'};
					$overdueBooks['1'][$overdueBooksCount]=$targetEntry[$overdueBooksCount]->{'copy_id'};
					$overdueBooks['2'][$overdueBooksCount]=$targetEntry[$overdueBooksCount]->{'membership_no'};
					$overdueBooks['3'][$overdueBooksCount]=$targetEntry[$overdueBooksCount]->{'dateofaction'};
					$overdueBooksCount++;
				}
    		}
			return response()->json(array('rowsNo'=>$overdueBooksCount,'jsonData'=>$overdueBooks));
        }
        else{
            return view('indexPage');
        }
    }
}
