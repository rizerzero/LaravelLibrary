<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class searchController extends Controller
{
    public function searchFunction(Request $request){
		if($request->session()->has('userLoginSession')){
            $arrived=$request->searchData;
            $searchString=$arrived[0]; $mode=$arrived[1]; $tableName=""; $pKey="";
if ($mode=="book") { $tableName="books"; $pKey="book_id";}
else{ $tableName="lenders"; $pKey="membership_no";}
$selected=DB::table($tableName)->where('name', 'LIKE', $searchString.'%')->get();
$selectedCount=DB::table($tableName)->where('name', 'LIKE', $searchString.'%')->count();
    $returningArray=array();
if ($selectedCount==0) {
    return response()->json(array('rowsNo'=>$selectedCount,'jsonData'=>"EMPTY"));
}
else{
    $result = $selected->toArray();
    for ($i=0; $i < $selectedCount; $i++) {
        $returningArray['0'][$i]=$result[$i]->$pKey;
        $returningArray['1'][$i]=$result[$i]->{'name'};
    }
    return response()->json(array('rowsNo'=>$selectedCount,'jsonData'=>$returningArray));
}
}
    else{
        return view('indexPage');
        }
    }
}
