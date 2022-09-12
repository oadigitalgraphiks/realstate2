<?php

/*
|--------------------------------------------------------------------------
| Product Inquiries Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::resource('property_inquiries', 'PropertyInquiryController');
    Route::get("property_inquiries/create/",'PropertyInquiryController@create')->name('property_inquiries.create');
    Route::get("property_inquiries/edit/{id}",'PropertyInquiryController@edit')->name('property_inquiries.edit');
    Route::get('property_inquiries/product/serach', 'PropertyInquiryController@search')->name('property_inquiries.search');
    Route::post('property_inquiries/product/product_list', 'PropertyInquiryController@product_list')->name('property_inquiries.type_list');
    Route::get('property_inquiries', 'PropertyInquiryController@index')->name('property_inquiries.index');
    Route::get('property_inquiries/destroy/{id}', 'PropertyInquiryController@destroy')->name('property_inquiries.destroy');
    Route::post('/property_inquiries/featured', 'PropertyInquiryController@updateFeatured')->name('property_inquiries.featured');
});