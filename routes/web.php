<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');


Route::group([ 'prefix' => 'sites' ], function () {
    
    Route::get('/', 'SitesController@index')->name('index.sites');
    Route::get('/formulario/{id_empresa}', 'SitesController@form')->name('index.formulario');
});