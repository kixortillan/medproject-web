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
Route::post('departments/edit', 'Department\DepartmentController@edit');
Route::get('departments/delete/{id}', 'Department\DepartmentController@delete');
Route::get('departments/search', 'Department\DepartmentController@search');

Route::get('cases', 'MedicalCase\MedicalCaseController@index');
Route::get('cases/add', 'MedicalCase\MedicalCaseController@create');
Route::post('cases/add', 'MedicalCase\MedicalCaseController@store');
Route::get('cases/edit/{id}', 'MedicalCase\MedicalCaseController@edit');
Route::get('cases/delete/{id}', 'MedicalCase\MedicalCaseController@delete');

Route::get('patients', 'MedicalCase\PatientController@index');
Route::get('patients/add', 'MedicalCase\PatientController@store');
Route::post('patients/add', 'MedicalCase\PatientController@store');
Route::get('patients/edit/{id}', 'MedicalCase\PatientController@edit');
Route::post('patients/edit', 'MedicalCase\PatientController@edit');
Route::get('patients/delete/{id}', 'MedicalCase\PatientController@delete');
Route::get('patients/{id}/cases/add', 'MedicalCase\MedicalCaseController@create');
Route::get('patients/search', 'MedicalCase\PatientController@search');

Route::get('diagnoses/search', 'MedicalCase\DiagnosisController@search');