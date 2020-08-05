<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'PagesController@inicio')->name('inicio');

Route::post('/', 'PagesController@crear')->name('tareas.crear');

Route::get('/editar/{id}', 'PagesController@editar')->name('tareas.editar');

Route::put('/editar/{id}', 'PagesController@update')->name('tareas.update');

Route::delete('eliminar/{id}', 'PagesController@eliminar')->name('tareas.eliminar');

Route::get('terminar/{id}', 'PagesController@terminar')->name('tareas.terminar');

