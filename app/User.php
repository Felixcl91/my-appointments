<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'dni', 'address', 'phone', 'role', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'pivot',
        'email_verified_at', 'created_at', 'updated_at'
            
            
    ];

    //$user->specialties
    public function specialties()
    {
        return $this->belongsToMany(Specialty::class)->withTimestamps();
    }

    //scope 
    public function scopePatients($query)
    {
        return $query->where('role', 'patient');
    }
    //scope
    public function scopeDoctors($query)
    {
        return $query->where('role', 'doctor');
    }

    public function asDoctorAppointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    public function attendedAppointments()
    {
        return $this->asDoctorAppointments()->where('status', 'Atendida');
    }

    public function cancelledAppointments()
    {
        return $this->asDoctorAppointments()->where('status', 'Cancelada');
    }
}
