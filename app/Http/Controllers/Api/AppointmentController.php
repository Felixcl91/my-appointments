<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

use App\Http\Requests\StoreAppointment;

class AppointmentController extends Controller
{

	/*
	 	"id",
        "description",
        "specialty_id",
        "doctor_id",
        "patient_id"
        "scheduled_date",
        "scheduled_time",
        "type"percaion",
        "created_at",
        "updated_at",
        "status,
	*/
    public function index() 
    {
    	$user = Auth::guard('api')->user();
    	$appointments = $user->asPatientAppointments()
    	->with([
    		'specialty' => function ($query) {
    			$query->select('id', 'name');
    		}, 
    		'doctor' => function ($query) {
    			$query->select('id', 'name');
    		}
    	])
    	->get([
    		"id",
        	"description",
        	"specialty_id",
        	"doctor_id",
        	"scheduled_date",
        	"scheduled_time",
        	"type",
        	"created_at",
        	"status"
    	]);
    	return $appointments;
    }

    public function store(StoreAppointment $request) 
    {
    	$success = Appointment::createForPatient($request, Auth::guard('api')->id());

        return compact('success');
    }
}