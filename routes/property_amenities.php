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
  
    Route::resource('property_amenities', 'PropertyAmenityController');
    Route::get("property_amenities/create/",'PropertyAmenityController@create')->name('property_amenities.create');
    Route::get("property_amenities/edit/{id}",'PropertyAmenityController@edit')->name('property_amenities.edit');
    Route::get('property_amenities/product/serach', 'PropertyAmenityController@search')->name('property_amenities.search');
    Route::post('property_amenities/product/product_list', 'PropertyAmenityController@product_list')->name('property_amenities.type_list');
    Route::get('property_amenities', 'PropertyAmenityController@index')->name('property_amenities.index');
    Route::get('property_amenities/destroy/{id}', 'PropertyAmenityController@destroy')->name('property_amenities.destroy');
    Route::post('/property_amenities/featured', 'PropertyAmenityController@updateFeatured')->name('property_amenities.featured');
});