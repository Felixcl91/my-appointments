<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class CancelledAppointment extends Model
{
    public function cancelled_by()	// cancelled_by_id
    {
    	//  belongsTo CAncellation N - 1 User hasMany
    	return $this->belongsTo(User::class);
    }
}
