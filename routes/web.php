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
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'admin'])->namespace('Admin')->group(function (){
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
	Route::resource('patients', 'PatientController');

	// Charts
	Route::get('/charts/appointments/line', 'ChartController@appointments');
	Route::get('/charts/doctors/column', 'ChartController@doctors');
	Route::get('/charts/doctors/column/data', 'ChartController@doctorsJson');

});

Route::middleware(['auth', 'doctor'])->namespace('Doctor')->group(function (){
		Route::get('/schedule', 'ScheduleController@edit');
		Route::post('/schedule', 'ScheduleController@store');
});

Route::middleware('auth')->group(function() {

	Route::get('/appointments/create', 'AppointmentController@create');
	Route::post('/appointments', 'AppointmentController@store');

	/*
	/appointments -> verificar 
	-> que variable pasar a la vista
	-> 1 unico blade(condiciones)
	*/
	Route::get('/appointments', 'AppointmentController@index');
	Route::get('/appointments/{appointment}', 'AppointmentController@show');

	Route::get('/appointments/{appointment}/cancel', 'AppointmentController@showCancelForm');
	Route::post('/appointments/{appointment}/cancel', 'AppointmentController@postCancel');

	Route::post('/appointments/{appointment}/confirm', 'AppointmentController@postConfirm');

	
});










