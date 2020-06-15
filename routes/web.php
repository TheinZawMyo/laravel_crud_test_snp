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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**admin route */
Route::get('/admin', 'Admin\EmployeeController@index')    
    ->name('admin');

Route::resource('/employee', 'Admin\EmployeeController');

Route::resource('/company', 'Admin\CompanyController');

