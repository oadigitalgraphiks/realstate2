<?php

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {

    Route::group(['prefix' => 'menus'], function () {
        //menu Routes
        Route::post('updateMenus', 'MenuController2@updateMenus')->name('updateMenus');
        Route::get('manage-menus/{id?}', 'MenuController2@index')->name('manage.menus');
        Route::post('menu-store', 'MenuController@store')->name('menu.store');
        Route::get('menu-destroy/{id?}', 'MenuController@destroy')->name('menu.destroy');
        Route::post('menu-edit', 'MenuController@edit')->name('menu.edit');
        Route::post('menu-update', 'MenuController@update')->name('menu.update');
        Route::post('menu-change-lang', 'MenuController@chnagelang')->name('menu.changge.lang');
    });
});
