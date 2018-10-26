<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/','sessionController@checkSessionFunction');
Route::post('login',array('uses'=>'loginController@loginFunction'));
Route::get('home','sessionController@checkSessionFunction');
Route::post('logout',array('uses'=>'logoutController@logoutFunction'));
Route::post('route',array('uses'=>'routeController@controllerFunction'));
Route::post('addThisBook',array('uses'=>'addBookController@addBookFunction'));
Route::post('addThisMember',array('uses'=>'addMemberController@addMemberFunction'));
Route::post('showBarCode', ['uses' =>'makeBarCode@makeBarCodeFunction']);
Route::post('lendBook',array('uses'=>'lendController@lendFunction'));
Route::post('returnBook',array('uses'=>'returnController@returnFunction'));
Route::get('search','searchController@searchFunction');
Route::post('profile',array('uses'=>'showBookOrMemberProfileController@deriveProfileFunction'));
Route::post('summary',array('uses'=>'summaryShowingController@showSummaryFunction'));
Route::post('showCopyHistory',array('uses'=>'copyHistoryController@copyHistoryFunction'));
Route::post('showMemberHistory',array('uses'=>'memberHistoryController@memberHistoryFunction'));
Route::post('showCopiesOverdue',array('uses'=>'copiesOverDueController@showOverDueFunction'));

