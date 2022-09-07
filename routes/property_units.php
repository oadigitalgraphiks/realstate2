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

    Route::get('property_units', 'PropertyUnitController@index')->name('property_units.index');
    Route::get("property_units/create/",'PropertyUnitController@create')->name('property_units.create');
    Route::post("property_units/store/",'PropertyUnitController@store')->name('property_units.store');
    Route::get("property_units/edit/{id}",'PropertyUnitController@edit')->name('property_units.edit');
    Route::post("property_units/update/{id}",'PropertyUnitController@update')->name('property_units.update');
    Route::get('property_units/units/serach', 'PropertyUnitController@search')->name('property_units.search');
    Route::post('property_units/units/units_list', 'PropertyUnitController@product_list')->name('property_units.list');
    Route::get('property_units/destroy/{id}', 'PropertyUnitController@destroy')->name('property_units.destroy');
    Route::post('property_units/featured', 'PropertyUnitController@updateFeatured')->name('property_units.featured');
    
});