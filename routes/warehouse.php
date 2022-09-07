<?php

/*
|--------------------------------------------------------------------------
| Warehouse Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Admin
Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){
   // WareHouses
   Route::get('/warehouse-setting', 'WarehouseController@index')->name('warehouse.index');
Route::get('/warehouse-setting/create', 'WarehouseController@create')->name('warehouse.create');
   Route::post('/warehouse-setting/store', 'WarehouseController@store')->name('warehouse.store');
   Route::get('/warehouse-setting/edit/{id}', 'WarehouseController@edit')->name('warehouse.edit');
   Route::patch('/warehouse-setting/update/{id}', 'WarehouseController@update')->name('warehouse.update');
   Route::get('/warehouse-setting/duplicate/{id}', 'WarehouseController@duplicate')->name('warehouse.duplicate');
   Route::get('/warehouse-setting/destroy/{id}', 'WarehouseController@destroy')->name('warehouse.destroy');
   Route::post('/warehouse-setting/status', 'WarehouseController@status')->name('warehouse.status');
   Route::post('/warehouse/bulk-warehouse-delete', 'WarehouseController@bulk_warehouse_delete')->name('bulk-warehouse-delete');
   Route::post('/warehouse/bulk-warehouse-edit', 'WarehouseController@bulk_warehouse_edit')->name('bulk-warehouse-edit');
   // End WareHouses
});
