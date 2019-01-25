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

Route::get('admin/routes', 'HomeController@admin')->middleware('admin');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/add_customer','HomeController@add_customer');

Route::post('/save_customer','HomeController@save_customer');
Route::get('/edit_customer/{id}','HomeController@edit_customer');
Route::any('/update_customer/{id}','HomeController@update_customer');
//Route::get('/update_customer/{id}','HomeController@edit_customer');
Route::get('/delete_customer/{id}','HomeController@delete_customer');

Route::get('/mycustomers','HomeController@mycustomers');
Route::any('/search','HomeController@mycustomer_search');
Route::put('/set_status','HomeController@set_status');
Route::get('/get_images','HomeController@get_images');

Route::get('/customers','HomeController@customers');
Route::get('customers/search', ['as'=>'customers.search','uses'=>'HomeController@customer_search']);

Route::post('/checkEmail','HomeController@save_customer');

Route::get('datatable', 'DataTableController@datatable');
// Get Data

Route::get('datatable', ['uses'=>'DataTableController@datatable']);
Route::get('datatable/getposts', ['as'=>'datatable.getposts','uses'=>'DataTableController@getPosts']);

Route::get('cities', ['uses'=>'DataTableController@datatCiti']);
Route::get('cities/getcities', ['as'=>'datatable.getcities','uses'=>'DataTableController@getcities']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
