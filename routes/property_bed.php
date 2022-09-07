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

    Route::get('property_beds', 'PropertyBedController@index')->name('property_bed.index');
    Route::get("property_beds/create/",'PropertyBedController@create')->name('property_bed.create');
    Route::post("property_beds/store/",'PropertyBedController@store')->name('property_bed.store');
    Route::get("property_beds/edit/{id}",'PropertyBedController@edit')->name('property_bed.edit');
    Route::post("property_beds/update/{id}",'PropertyBedController@update')->name('property_bed.update');
    Route::get('property_beds/serach', 'PropertyBedController@search')->name('property_bed.search');
    // Route::post('property_beds/property_list', 'PropertyBedController@product_list')->name('property_bed.type_list');
    Route::get('property_beds/destroy/{id}', 'PropertyBedController@destroy')->name('property_bed.destroy');
    Route::post('property_beds/featured', 'PropertyBedController@updateFeatured')->name('property_bed.featured');
    
});