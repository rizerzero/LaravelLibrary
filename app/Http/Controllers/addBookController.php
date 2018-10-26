<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class addBookController extends Controller
{
    public function addBookFunction(Request $request){
		if($request->session()->has('userLoginSession')){
       		$arrivedBookData=$request->submit_book;
			$book_name=$arrivedBookData[0];
			$author=$arrivedBookData[1];
			$book_price=$arrivedBookData[2];
			$donor=$arrivedBookData[3];
			$donated_date=$arrivedBookData[4];
			$book_Language=$arrivedBookData[5];
			$book_category=$arrivedBookData[6];
			$noOfCopies=$arrivedBookData[7];
			$gettime = date('gis'); $getdate = date('Ymd'); $book_id = "B".$getdate.''.$gettime;
			DB::insert('insert into books (book_id, name, author, price, lang, category, donor, noOfCopies, donated_date) values(?,?,?,?,?,?,?,?,?)',[$book_id,$book_name,$author,$book_price,$book_Language,$book_category,$donor,$noOfCopies,$donated_date]);
			$copyIdString = "";
			for ($i=1; $i <=$noOfCopies; $i++) {
				$copyID='C'.$i.'_'.$book_id;
				DB::insert('insert into copies (book_id, copy_id, existing) values(?,?,?)',[$book_id,$copyID,'YES']);
				$copyIdString=$copyIdString."~".$copyID;
			}
			return response()->json(array('bookName'=> $book_name,'author'=> $author,'bookLanguage'=> $book_Language,'copyIDs'=>$copyIdString), 200);
			//return view('indexPage');
        }
        else{
            return view('indexPage');
        }
    }
}