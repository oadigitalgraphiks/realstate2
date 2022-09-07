<?php

/*
|--------------------------------------------------------------------------
| Refund System Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Admin Panel

Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){
    Route::resource('slider', 'SlidersController');
    Route::get('/slider/edit/{id}', 'SlidersController@edit')->name('slider.edit');
    Route::get('/slider/destroy/{id}', 'SlidersController@destroy')->name('slider.destroy');
    Route::post('/slider/status', 'SlidersController@updateStatus')->name('slider.status');
});
