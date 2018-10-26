<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class returnController extends Controller
{
    public function returnFunction(Request $request){
		if($request->session()->has('userLoginSession')){
			$arrivedReturn=$request->submit_return;
			$date_returned = date('Y/m/d');
			$reference_no = $arrivedReturn[0];
			$copiesArray=array_slice($arrivedReturn, 1);
			$var=0;
			foreach($copiesArray as $copy){
			if($copy!=""){
				DB::insert('insert into records (copy_id, membership_no, action, dateofaction) values(?,?,?,?)',[$copy,$reference_no,'returned',$date_returned]);
				DB::table('copies')->where('copy_id',$copy)->update(['existing' => 'YES']);
				$var++;
				}
			}
			$result="";
			if($var!=0){
				$result="Returned Successfully..!";
			}
			else{
				$result="An ERROR in Returning..!";
			}
		return response()->json(array('result'=> $result), 200);
		}
    else{
        return view('indexPage');
    	}
    }
}
