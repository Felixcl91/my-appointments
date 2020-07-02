<?php namespace App\Services;

use App\Interfaces\ScheduleServiceInterface;
use App\Workday;
use Carbon\Carbon;
use App\User;
use App\Appointment;

class ScheduleService implements ScheduleServiceInterface
{

	public function isAvailableInterval($date, $doctorId, Carbon $start) {
		// si no existe una cita para est hora con este medico
		  $exists = Appointment::where('doctor_id', $doctorId)
		    	->where('scheduled_date', $date)
		    	->where('scheduled_time', $start->format('H:i:s'))
		    	->exists();

		  return !$exists; // available if already none exists
	}

	/*
		Funcion que nos devuelve los intervalos de las horas
	*/
	public function getAvailableIntervals($date, $doctorId)
	{
		$workDay = Workday::where('active', true)
	    	->where('day', $this->getDayFromDate($date))
	    	->where('user_id', $doctorId)
	    	->first([
	    		'morning_start', 'morning_end',
	    		'afternoon_start', 'afternoon_end'
	    	]);

        if (!$workDay) {
            return [];
        }


	    $morningIntervals = $this->getIntervals(
	    	$workDay->morning_start, $workDay->morning_end,
	    	$date, $doctorId
	    );

	    $afternoonIntervals = $this->getIntervals(
	    	$workDay->afternoon_start, $workDay->afternoon_end,
	    	$date, $doctorId
	    );
	   

    	$data = [];
    	$data['morning'] = $morningIntervals;
    	$data['afternoon'] = $afternoonIntervals;

    	return $data;
	}

	private function getDayFromDate($date)
	{
		
    	$dateCarbon = new Carbon($date);

    	// dayofweek
    	// Carbon: 0 (sunday) - 6 (saturday)
    	// workday: 0 (monday) - 6 (sunday)
        $i = $dateCarbon->dayOfWeek;
    	$day = ($i==0 ? 6 : $i-1);
    	return $day;
	}

	
	private function getIntervals($start, $end, $date, $doctorId) {
	        	$start = new Carbon($start);
			    $end = new Carbon($end);

			    $intervals = [];

			    while ($start < $end) {
			    	$interval = [];

		    	$interval['start'] = $start->format('g:i A');

		    	// cuando estan disponibles las horas del doctor
		    	$available = $this->isAvailableInterval($date, $doctorId, $start);

		    	$start->addMinutes(30);
		    	$interval['end'] = $start->format('g:i A');		    	

		    	if ($available) {
		    		$intervals []= $interval;
		    	}
		    }
		    return $intervals;
        }
}