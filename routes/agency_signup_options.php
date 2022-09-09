<?php

/*
|--------------------------------------------------------------------------
| Agency Signup Options Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::resource('agency_signup_options', 'AgencySignupOptionController');
    Route::get("agency_signup_options/create/",'AgencySignupOptionController@create')->name('agency_signup_options.create');
    Route::get("agency_signup_options/edit/{id}",'AgencySignupOptionController@edit')->name('agency_signup_options.edit');
    Route::get('agency_signup_options/product/serach', 'AgencySignupOptionController@search')->name('agency_signup_options.search');
    Route::post('agency_signup_options/product/product_list', 'AgencySignupOptionController@product_list')->name('agency_signup_options.type_list');
    Route::get('agency_signup_options', 'AgencySignupOptionController@index')->name('agency_signup_options.index');
    Route::get('agency_signup_options/destroy/{id}', 'AgencySignupOptionController@destroy')->name('agency_signup_options.destroy');
    Route::post('/agency_signup_options/featured', 'AgencySignupOptionController@updateFeatured')->name('agency_signup_options.featured');
});