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
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
	Route::resource('/employee', 'EmployeeController');
	Route::get('/home', 'HomeController@index')->name('home');


	Route::resource('/product', 'ProductController');
	Route::resource('/customer', 'CustomerController');
  Route::resource('/cart', 'CartController');
});

//get all lgas for selected state
Route::get('/lgas/{state}', function($state){
	$state = DB::table('states')->where('name', $state)->first();
	$lgas = DB::table('lgas')->where('state_id', $state->id)->get();
	return json_encode($lgas);
});
