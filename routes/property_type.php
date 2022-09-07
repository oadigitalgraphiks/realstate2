<?php

/*
|--------------------------------------------------------------------------
| Product Types Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::resource('property_type', 'PropertyTypeController');
    Route::get("property_type/create/",'PropertyTypeController@create')->name('property_type.create');
    Route::get("property_type/edit/{id}",'PropertyTypeController@edit')->name('property_type.edit');
    Route::get('property_type/property/serach', 'PropertyTypeController@search')->name('property_type.search');
    Route::post('property_type/property/property_list', 'PropertyTypeController@product_list')->name('property_type.type_list');
    Route::get('property_types', 'PropertyTypeController@index')->name('product.property_type');
    Route::get('property_type/destroy/{id}', 'PropertyTypeController@destroy')->name('property_type.destroy');
    Route::post('/property_type/featured', 'PropertyTypeController@updateFeatured')->name('property_type.featured');
  


});