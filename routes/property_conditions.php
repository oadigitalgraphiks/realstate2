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
    
    Route::get('property_conditions', 'PropertyConditionController@index')->name('property_conditions.index');
    Route::get("property_conditions/create/",'PropertyConditionController@create')->name('property_conditions.create');
    Route::get("property_conditions/store/",'PropertyConditionController@store')->name('property_conditions.store');
    Route::get("property_conditions/edit/{id}",'PropertyConditionController@edit')->name('property_conditions.edit');
    Route::any("property_conditions/update/{id}",'PropertyConditionController@update')->name('property_conditions.update');

    Route::get('property_conditions/conditions/serach', 'PropertyConditionController@search')->name('property_conditions.search');

    Route::post('property_conditions/conditions/list', 'PropertyConditionController@product_list')->name('property_conditions.list');

    Route::get('property_conditions/destroy/{id}', 'PropertyConditionController@destroy')->name('property_conditions.destroy');

    Route::post('property_conditions/featured', 'PropertyConditionController@updateFeatured')->name('property_conditions.featured');
    
});