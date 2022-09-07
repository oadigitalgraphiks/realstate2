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
    Route::resource('property_baths', 'PropertyBathController');
    Route::get("property_baths/create/",'PropertyBathController@create')->name('property_baths.create');
    Route::get("property_baths/edit/{id}",'PropertyBathController@edit')->name('property_baths.edit');
    Route::get('property_baths/product/serach', 'PropertyBathController@search')->name('property_baths.search');
    Route::post('property_baths/product/product_list', 'PropertyBathController@product_list')->name('property_baths.type_list');
    Route::get('property_baths', 'PropertyBathController@index')->name('property_baths.index');
    Route::get('property_baths/destroy/{id}', 'PropertyBathController@destroy')->name('property_baths.destroy');
    Route::post('/property_baths/featured', 'PropertyBathController@updateFeatured')->name('property_baths.featured');
});