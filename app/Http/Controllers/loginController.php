<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class loginController extends Controller
{
    public function loginFunction(Request $request){
    $arrived=$request->loginData; $un = $arrived[0]; $pw = $arrived[1];
	$count = DB::table('journey')->where('angel','=',$un)->where('devil','=',$pw)->count();
    if ($count!=0) {
      $request->session()->put('userLoginSession',$un);
    }
    return redirect('home');
   }
}
?>
