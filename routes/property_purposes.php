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
    Route::resource('property_purposes', 'PropertyPurposeController');
    Route::get("property_purposes/create/",'PropertyPurposeController@create')->name('property_purposes.create');
    Route::get("property_purposes/edit/{id}",'PropertyPurposeController@edit')->name('property_purposes.edit');
    Route::get('property_purposes/product/serach', 'PropertyPurposeController@search')->name('property_purposes.search');
    Route::post('property_purposes/product/product_list', 'PropertyPurposeController@product_list')->name('property_purposes.type_list');
    Route::get('property_purposes', 'PropertyPurposeController@index')->name('property_purposes.index');
    Route::get('property_purposes/destroy/{id}', 'PropertyPurposeController@destroy')->name('property_purposes.destroy');
    Route::post('/property_purposes/featured', 'PropertyPurposeController@updateFeatured')->name('property_purposes.featured');
});