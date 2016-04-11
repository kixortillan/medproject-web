<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('home', 'HomeController@index');
Route::get('departments', 'Department\DepartmentController@index');

Route::get('departments/add', 'Department\DepartmentController@store');
Route::post('departments/add', 'Department\DepartmentController@store');

Route::get('departments/edit/{id}', 'Department\DepartmentController@edit');
Route::get('departments/delete/{id}', 'Department\DepartmentController@delete');

Route::get('cases', 'MedicalCase\MedicalCaseController@index');

Route::get('{state}', 'MedicalCase\MedicalCaseController@index');