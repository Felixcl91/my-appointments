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
    	User::create([
    		'name' => 'Felix Cruz',
        'email' => 'felix@hotmail.com',
        'password' => bcrypt('123123'), // secret
        'dni' => '77777777',
        'address' => '',
        'phone' => '',
        'role' => 'admin'
    	]);
        factory(User::class, 50)->create();
    }
}
