<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Appointment;
use App\User;
use DB;

class ChartController extends Controller
{
    public function appointments()
    {
    	
    	$monthlyCounts = Appointment::select(
    		DB::raw('MONTH(created_at) as month'),
    		DB::raw('COUNT(1) as count')
    	)->groupBy('month')->get()->toArray();

    	$counts = array_fill(0, 12, 0); //index, qty, value
    	foreach ($monthlyCounts as $monthlyCount) {
    		$index = $monthlyCount['month']-1;
    		$counts[$index] = $monthlyCount['count'];
    	}
    	
    	return view('charts.appointments', compact('counts'));
    }

    public function doctors()
    {
    	
    	return view('charts.doctors');
    }

    public function doctorsJson()
    {
    	$doctors = User::doctors()
    	->select('name')
    	->withCount([
    		'attendedAppointments',
    		'cancelledAppointments'
    	])
    	->orderBy('attended_appointments_count', 'desc')
    	->take(3) // limit 3
    	->get();
    	
    	
    	$data = [];
    	$data['categories'] = $doctors->pluck('name');

    	$series = [];
    	//atendidas
    	$series1['name'] = 'Citas atendidas';
    	$series1['data'] = $doctors->pluck('attended_appointments_count');
    	//canceladas
    	$series2['name'] = 'Citas canceladas';
    	$series2['data'] = $doctors->pluck('cancelled_appointments_count');

    	$series[] = $series1;
    	$series[] = $series2;

    	$data['series'] = $series;

    	return $data;
    	
    }
}
