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

//Speciality
Route::get('/specialties', 'SpecialtyController@index');//listar
Route::get('/specialties/create', 'SpecialtyController@create');// form registro especialidades nuevas
Route::get('/specialties/{specialty}/edit', 'SpecialtyController@edit'); //nos muestra el editar

Route::post('/specialties', 'SpecialtyController@store');// nos permite envio del form
Route::put('/specialties/{specialty}', 'SpecialtyController@update');//	actualizar espc
Route::delete('/specialties/{specialty}', 'SpecialtyController@destroy'); // eliminar espc

// Doctors
Route::resource('doctors', 'DoctorController');


// Patients


