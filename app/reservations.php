<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reservations extends Model
{
    protected $table = 'reservations';
    public function reservations()
    {
        return $this->hasOne('App\rooms','reserve_id');
    }
    protected $fillable = [
        'a_name', 'a_email', 'phone','room','room_no','checkin', 'checkout', 'confirmed','Active','price','paid', 'payment', 'not_paid', 'total',
    ];

}
