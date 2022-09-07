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

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function(){

    Route::resource('property_tour_types', 'PropertyTourTypeController');
    Route::get("property_tour_types/create/",'PropertyTourTypeController@create')->name('property_tour_types.create');
    Route::get("property_tour_types/edit/{id}",'PropertyTourTypeController@edit')->name('property_tour_types.edit');
    Route::get('property_tour_types/product/serach', 'PropertyTourTypeController@search')->name('property_tour_types.search');
    Route::post('property_tour_types/product/product_list', 'PropertyTourTypeController@product_list')->name('property_tour_types.type_list');
    Route::get('property_tour_types', 'PropertyTourTypeController@index')->name('property_tour_types.index');
    Route::get('property_tour_types/destroy/{id}', 'PropertyTourTypeController@destroy')->name('property_tour_types.destroy');
    Route::post('/property_tour_types/featured', 'PropertyTourTypeController@updateFeatured')->name('property_tour_types.featured');
});