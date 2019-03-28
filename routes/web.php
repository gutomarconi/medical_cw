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
    //return view('welcome');
    return redirect()->action('PeopleController@index');
});

Route::resource('/Peoples', 'PeopleController');
Route::resource('/Medrecords', 'MedicalRecordsController',['except' => ['create', 'edit']]);
Route::get('/medrecords/create/{people_id}', 'MedicalRecordsController@create')->name('Medrecords.create');
Route::get('/medrecords/{people_id}', 'MedicalRecordsController@index')->name('Medrecords.get');
Route::get('/medrecords/{people_id}/{medrecords_id}', 'MedicalRecordsController@edit')->name('Medrecords.edit');
Route::get('/Medrecords.cancel/{medrecords_id}/{status}', 'MedicalRecordsController@updateStatus')->name('Medrecords.cancel');

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
