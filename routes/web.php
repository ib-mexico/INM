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

Route::get('/', 'LoginController@index');
Route::post('/login-panel', ['as' => 'login-panel', 'uses' => 'LoginController@access']);
Route::get('/logout-panel', 'LoginController@logout');

Route::group([ 'prefix' => 'panel',
               'middleware' => 'auth' ], function () {
    
    Route::get('sitios', 'SitesController@index')->name('sites');
    Route::get('sitios/formulario/{id_site}', 'SitesController@formulario')->name('sites.form');
    Route::post('sitios/date', 'SitesController@saveDate')->name('sites.date');
    
    Route::get('requisiciones', ['as' => 'requisitions', 'uses' => 'RequisitionsController@index']);
    Route::get('requisicion/{id_requisition}/pdf', 'RequisitionsController@generatePDF');
    Route::post('requisicion/registrar', ['as' => 'new-requisition', 'uses' => 'RequisitionsController@store']);
    Route::get('requisicion/editar/{id_requisition}', 'RequisitionsController@edit')->name('requisition.edit');
    Route::post('requisicion/editar/store', ['as' => 'add-requisition', 'uses' => 'RequisitionsController@storeEdit']);
    Route::post('requisicion/editarDescripcion', ['as' => 'edit-description', 'uses' => 'RequisitionsController@editDescription']);
    Route::get('requisicion/deleteData', 'RequisitionsController@deleteData');
    Route::post('requisicion/media', 'RequisitionsController@storeMedia')->name('sites.media');
    Route::get('requisicion/getmedia/', 'RequisitionsController@getMedia');
});