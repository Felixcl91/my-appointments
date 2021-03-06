<?php

use Illuminate\Http\Request;

Route::post('/login', 'AuthController@login');



// Public resources
Route::get('/specialties', 'SpecialtyController@index');
Route::get('/specialties/{specialty}/doctors', 'SpecialtyController@doctors');
Route::get('/schedule/hours', 'ScheduleController@hours');

Route::middleware('auth:api')->group(function (){

	Route::get('/user', 'UserController@show');
	Route::post('/logout', 'AuthController@logout');

	// apointments
	Route::post('/appointments', 'AppointmentController@store');
	Route::get('/appointments', 'AppointmentController@index');

	// fcm
	Route::post('/fcm/token', 'FirebaseController@postToken');

});