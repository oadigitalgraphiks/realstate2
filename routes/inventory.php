<?php

/*
|--------------------------------------------------------------------------
| Inventory Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::resource('inventory', 'InventoryController');
    Route::get("inventory",'InventoryController@index')->name('inventory');
    Route::get("inventory/create/",'InventoryController@create')->name('inventory.create');
    Route::get("inventory/edit/{id}",'InventoryController@edit')->name('inventory.edit');
    Route::get('inventory/product/serach', 'InventoryController@search')->name('inventory.search');
    Route::post('inventory/product/product_list', 'InventoryController@product_list')->name('inventory.product_list');
    Route::get('inventory/product/product_all', 'InventoryController@product_all')->name('inventory.all_product');
    Route::post('inventory/product/transfer_product', 'InventoryController@transfer_products')->name('inventory.transfer_product');
    Route::get('inventory/product/receive/{id}', 'InventoryController@receive')->name('inventory.receive');
    Route::post('inventory/product/receive/update', 'InventoryController@receive_update')->name('inventory.receive.update');
    Route::get('inventory/history/receive/', 'InventoryController@history')->name('inventory.history');

});
