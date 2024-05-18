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

// Llamamos al controlador HomeController
Route::get(
    '/', 'HomeController@index'
    // function () {
    //     return view('welcome');
    // }
);

Auth::routes();

// Agrupamos las rutas:
// prefix (Delante de todas las url): admin
// namespace (Controlador): Admin
// middleware: auth
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('admin.home'); //Ingresar al dashboard
    Route::resource('/files', 'FileController')->names('admin.files'); // Ruta CRUD , Controlador CRUD
});
