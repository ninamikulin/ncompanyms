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

Auth::routes(['register' =>false, 'reset'=>false]);

Route::resource('companies', 'CompanyController');
Route::get('companies/{company}/employees', 'CompanyEmployeesController@index');
Route::post('companies/{company}/employees', 'CompanyEmployeesController@store');
Route::get('companies/{company}/employees/create', 'CompanyEmployeesController@create');
Route::get('companies/{company}/employees/{employee}', 'CompanyEmployeesController@show');
Route::get('companies/{company}/employees/{employee}/edit', 'CompanyEmployeesController@edit')->name('employees.edit');
Route::patch('companies/{company}/employees/{employee}', 'CompanyEmployeesController@update');
Route::delete('companies/{company}/employees/{employee}', 'CompanyEmployeesController@destroy');
Route::get('/home', 'HomeController@index')->name('home');


