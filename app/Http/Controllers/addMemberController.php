<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class addMemberController extends Controller
{
    public function addMemberFunction(Request $request){
       	if($request->session()->has('userLoginSession')){
       		$arrivedMemberData=$request->addmember;
$memberName = $arrivedMemberData[0];
$gender = $arrivedMemberData[1];
$emailID = $arrivedMemberData[2];
$birthdate = $arrivedMemberData[3];
$address = $arrivedMemberData[4];
$phone = $arrivedMemberData[5];
$gettime = date('gis');
$getdate = date('Ymd');
$mem_no = 'L'.$gettime.''.$getdate;
DB::insert('insert into lenders (membership_no, name, gender, emailID, birthdate, address, phone, status) values(?,?,?,?,?,?,?,?)',[$mem_no,$memberName,$gender,$emailID,$birthdate,$address,$phone,"ACTIVE"]);
return response()->json(array('memID'=>$mem_no,'memName'=> $memberName,'address'=> $address,'phone'=> $phone), 200);
        }
        else{
            return view('indexPage');
        }
	}
}
