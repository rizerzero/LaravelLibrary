<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class lendController extends Controller
{
    public function lendFunction(Request $request){
		if($request->session()->has('userLoginSession')){
			$arrivedLend=$request->submit_lend;
$date_lend = date('Y/m/d');
$mem_id = $arrivedLend[0];
$copiesArray=array_slice($arrivedLend, 1);
$var=0;
foreach($copiesArray as $copy){
if($copy!=""){
DB::insert('insert into records (copy_id, membership_no, action, dateofaction) values(?,?,?,?)',[$copy,$mem_id,'lended',$date_lend]);
DB::table('copies')->where('copy_id',$copy)->update(['existing' => $mem_id]);
$var++;
}
}
$result="";
if($var!=0){
	$result="Lended Successfully..!";
}
else{
	$result="An ERROR in Lending..!";
}
return response()->json(array('result'=> $result), 200);
}
        else{
            return view('indexPage');
        }
    }
}
