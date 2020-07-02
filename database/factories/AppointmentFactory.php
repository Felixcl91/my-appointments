<?php

use Faker\Generator as Faker;

use App\User;
use App\Appointment;

$factory->define(App\Appointment::class, function (Faker $faker) {
	$doctorsId = User::doctors()->pluck('id');
	$patientsId = User::patients()->pluck('id');

	$date = $faker->dateTimeBetween('-1 years', 'now');
	$scheduled_date = $date->format('Y-m-d');
	$scheduled_time = $date->format('H:i:s');

	$types = ['Consulta', 'Examen', 'Opercaion'];
	$statuses = ['Atendida', 'Cancelada'];

    return [
        'description'=> $faker->sentence(5),
        'specialty_id'=> $faker->numberBetween(1, 3),
        'doctor_id'=> $faker->randomElement($doctorsId),
        'patient_id'=> $faker->randomElement($patientsId),
        'scheduled_date'=> $scheduled_date,
        'scheduled_time'=> $scheduled_time,
        'type'=> $faker->randomElement($types),
        'status'=> $faker->randomElement($statuses)
    ];
});
