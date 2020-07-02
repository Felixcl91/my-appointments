<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
    	User::create([
    	'name' => 'Felix Cruz',
        'email' => 'felix@hotmail.com',
        'password' => bcrypt('123123'), // secret
        'role' => 'admin'
    	]);

        // 2
        User::create([
        'name' => 'Patient 1',
        'email' => 'patient@hotmail.com',
        'password' => bcrypt('123123'), // secret
        'role' => 'patient'
        ]);

        //3
        User::create([
        'name' => 'Doctor 1',
        'email' => 'doctor@hotmail.com',
        'password' => bcrypt('123123'), // secret
        'role' => 'doctor'
        ]);

        factory(User::class, 50)->states('patient')->create();
    }
}
