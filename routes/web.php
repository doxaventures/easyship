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


Route::get('/shop','ShopController@shop')->name('shop');
Route::get('/auth','ShopController@authenticate')->name('authenticate');
Route::get('/install','ShopController@index');
Route::get('/index',function(){
    return view('pages.index');
});
Route::middleware('cors')->group(function () {
    Route::get('/api','ApiController@index');
    Route::get('/api/draft_order','ApiController@create_draft_order');
    Route::get('/orders/{id}','OrderController@get_orders');
//    Route::get('/ship','OrderController@create_labels');
    Route::get('/','OrderController@get_all_orders')->name('get_all_orders');
    Route::get('/single_orders/{id}','OrderController@get_single_orders')->name('get_single_order');
//    Route::get('/check_shipment','OrderController@check_shipment');

    Route::get('/get_shipments','ShipmentController@get_shipment');
    Route::get('/delete_shipment{id}','ShipmentController@delete_shipment')->name('delete_shipment');
});
Route::get('/webhooks/get','WebhookController@getwebhook');
Route::get('/webhooks','WebhookController@webhook');
Route::POST('/webhooks/create/order','WebhookController@webhook_order_create')->name('create_orders_webhook');
Route::get('/upsales','WebhookController@upsales')->name('meta');
