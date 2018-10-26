<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class showBookOrMemberProfileController extends Controller
{
        public function deriveProfileFunction(Request $request){
		if($request->session()->has('userLoginSession')){
			$arrived=$request->viewProfile; $pKey=$arrived[1]; $pKeyColumn=""; $tableName="";
			if ($arrived[0]=="book") {
				$tableName="books"; $pKeyColumn="book_id"; 
				$selected=DB::table($tableName)->where($pKeyColumn,'=',$pKey)->get();
				$copyIDs=DB::table("copies")->where("book_id",'=',$pKey)->get();
				$copyIdString="";
				foreach ($copyIDs as $toArray){
					$copyIdString=$copyIdString."~".$toArray->{'copy_id'};
				}
				foreach ($selected as $toView){
					return response()->json(array('bookName'=>$toView->{'name'},'book_id'=>$toView->{'book_id'},'author'=>$toView->{'author'},'bookLanguage'=>$toView->{'lang'},'donor'=>$toView->{'donor'},'donated_date'=>$toView->{'donated_date'},'noOfCopies'=>$toView->{'noOfCopies'},'copyIDs'=>$copyIdString), 200);
				}
			}
			else{
				$tableName="lenders"; $pKeyColumn="membership_no";
				$selected=DB::table($tableName)->where($pKeyColumn,'=',$pKey)->get();
				foreach ($selected as $toView){
    				return response()->json(array('memName'=>$toView->{'name'},'memID'=>$toView->{'membership_no'},'address'=>$toView->{'address'},'phone'=>$toView->{'phone'}), 200);
    			}
			}
        }
        else{
            return view('indexPage');
        }
    }
}
