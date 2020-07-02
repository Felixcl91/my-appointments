<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Specialty;

class SpecialtyController extends Controller
{

	//metodo que recibe un parametro de ruta con la especialidad
    public function index()
    {
    	return Specialty::all('id', 'name');
    }

	//metodo que recibe un parametro de ruta con la especialidad
    public function doctors(Specialty $specialty)
    {
    	//respuesta en formato JSON
    	return $specialty->users()->get([
    		'users.id', 'users.name'
    	]);
    }
}
