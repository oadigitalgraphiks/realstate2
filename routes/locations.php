<?php 

/*
|--------------------------------------------------------------------------
| Location Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {   
    Route::resource('property_countries', 'CountryController');
    Route::get('/property_countries', 'CountryController@index')->name('property_countries.index');
    Route::get('/property_countries/create', 'CountryController@create')->name('property_countries.create');
    Route::get('/property_countries/edit/{id}', 'CountryController@edit')->name('property_countries.edit');
    Route::any('/property_countries/update/{id}', 'CountryController@update')->name('property_countries.update');
    Route::get('/property_countries/destroy/{id}', 'CountryController@destroy')->name('property_countries.destroy');

    Route::resource('property_states', 'StateController');
    Route::get('/property_states', 'StateController@index')->name('property_states.index');
    Route::get('/property_states/create', 'StateController@create')->name('property_states.create');
    Route::get('/property_states/edit/{id}', 'StateController@edit')->name('property_states.edit');
    Route::post('/property_states/update', 'StateController@update')->name('property_states.update');
    Route::get('/property_states/destroy/{id}', 'StateController@destroy')->name('property_states.destroy');

    Route::resource('property_cities', 'CityController');
    Route::get('/property_cities', 'CityController@index')->name('property_cities.index');
    Route::get('/property_cities/create', 'CityController@create')->name('property_cities.create');
    Route::get('/property_cities/edit/{id}', 'CityController@edit')->name('property_cities.edit');
    Route::post('/property_cities/update', 'CityController@update')->name('property_cities.update');
    Route::get('/property_cities/destroy/{id}', 'CityController@destroy')->name('property_cities.destroy');

    Route::resource('property_areas', 'AreaController');
    Route::get('/property_areas', 'AreaController@index')->name('property_areas.index');
    Route::get('/property_areas/create', 'AreaController@create')->name('property_areas.create');
    Route::get('/property_areas/edit/{id}', 'AreaController@edit')->name('property_areas.edit');
    Route::post('/property_areas/update', 'AreaController@update')->name('property_areas.update');
    Route::get('/property_areas/destroy/{id}', 'AreaController@destroy')->name('property_areas.destroy');

    Route::resource('property_nested_areas', 'NestedAreaController');
    Route::get('/property_nested_areas', 'NestedAreaController@index')->name('property_nested_areas.index');
    Route::get('/property_nested_areas/create', 'NestedAreaController@create')->name('property_nested_areas.create');
    Route::get('/property_nested_areas/edit/{id}', 'NestedAreaController@edit')->name('property_nested_areas.edit');
    Route::post('/property_nested_areas/update', 'NestedAreaController@update')->name('property_nested_areas.update');
    Route::get('/property_nested_areas/destroy/{id}', 'NestedAreaController@destroy')->name('property_nested_areas.destroy');
});