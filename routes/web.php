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
    return view('patient');
});

Route::resource('/Peoples', 'PeopleController');
Route::resource('/Medrecords', 'MedicalRecordsController',['except' => ['create', 'edit']]);
Route::get('/Medrecords.cancel/{medrecords_id}/{status}', 'MedicalRecordsController@updateStatus')->name('Medrecords.cancel');
Route::get('patients', 'PeopleController@getPeoples')->name('patients.list');
Route::get('medicalrecords/{people_id}', 'MedicalRecordsController@getMedicalRecords')->name('medicalrecords.list');
Route::get('validateDelete/{people_id}', 'PeopleController@validateDelete')->name('validate.delete');
Route::get('/home', 'HomeController@index')->name('home');
