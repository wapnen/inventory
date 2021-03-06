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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
	Route::resource('/employee', 'EmployeeController');
	Route::get('/home', 'HomeController@index')->name('home');

  Route::get('/cart/update/{rowId}/{qty}', 'CartController@update_qty');
  Route::get('/checkout', 'CartController@checkout');
	Route::resource('/product', 'ProductController');
	Route::resource('/customer', 'CustomerController');
  Route::resource('/cart', 'CartController');
  Route::post('/sales/report', 'TransactionController@generate_report');
  Route::get('/transaction/confirm/{id}', 'TransactionController@confirm_sale');
  Route::post('/transaction/customer', 'TransactionController@checkout_customer');
  Route::post('/transaction/guest', 'TransactionController@checkout_guest');
  Route::get('/transaction/invoice/{id}', 'TransactionController@invoice');
  Route::get('/complaint/status/update/{id}', 'ComplaintController@update_status');
  Route::get('/productrequest/status/update/{id}', 'ProductRequestController@update_status');
  Route::resource('/complaint', 'ComplaintController');
  Route::resource('/productrequest', 'ProductRequestController');
});

//get all lgas for selected state
Route::get('/lgas/{state}', function($state){
	$state = DB::table('states')->where('name', $state)->first();
	$lgas = DB::table('lgas')->where('state_id', $state->id)->get();
	return json_encode($lgas);
});
