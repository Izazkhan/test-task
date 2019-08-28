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


Route::get('/customers', [
	'uses' => 'CustomerController@getAllCustomers',
	'as' => 'customers'
]);

Route::get('/add-customer', function(){
	return view('add-customer');
});


Route::post('/add-customers', [
	'uses' => 'CustomerController@addCustomer',
	'as' => 'add-customer-submit'
]);

Route::post('/customers-ajax', [
	'uses' => 'CustomerController@getNextCustomers',
	'as' => 'customers-ajax'
]);

Route::get('/customer-orders', [
	'uses' => 'CustomerController@customerOrders',
	'as' => 'customer-orders'
]);

Route::get('/orders', [
	'uses' => 'OrderController@index',
	'as' => 'orders'
]);

Route::post('/orders-ajax', [
	'uses' => 'OrderController@getNextOrders',
	'as' => 'orders-ajax'
]);

Route::get('/order-details', [
	'uses' => 'OrderController@orderDetails',
	'as' => 'order-details'
]);