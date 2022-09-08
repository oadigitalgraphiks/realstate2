<?php

/*
|--------------------------------------------------------------------------
| Product Reports Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::resource('property_reports', 'PropertyReportController');
    Route::get("property_reports/create/",'PropertyReportController@create')->name('property_reports.create');
    Route::get("property_reports/edit/{id}",'PropertyReportController@edit')->name('property_reports.edit');
    Route::get('property_reports/product/serach', 'PropertyReportController@search')->name('property_reports.search');
    Route::post('property_reports/product/product_list', 'PropertyReportController@product_list')->name('property_reports.type_list');
    Route::get('property_reports', 'PropertyReportController@index')->name('property_reports.index');
    Route::get('property_reports/destroy/{id}', 'PropertyReportController@destroy')->name('property_reports.destroy');
    Route::post('/property_reports/featured', 'PropertyReportController@updateFeatured')->name('property_reports.featured');
});