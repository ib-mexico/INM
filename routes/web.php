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
    Route::get('sitios/formulario/{id_site}', 'SitesController@formulario')->name('sites.formulario');
    
    Route::get('requisiciones', ['as' => 'requisitions', 'uses' => 'RequisitionsController@index']);
    Route::get('requisicion/{id_requisition}/pdf', 'RequisitionsController@generatePDF');
    Route::post('requisicion/registrar', ['as' => 'new-requisition', 'uses' => 'RequisitionsController@store']);
});