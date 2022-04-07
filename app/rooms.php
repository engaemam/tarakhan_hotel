<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rooms extends Model
{

    protected $table = 'rooms';
    public function rooms()
    {
        return $this->hasMany('App\reservations','id');
    }

    //id	room_no	room_type	reserved	created_at	updated_at
    protected $fillable = [
        'room_no', 'room_type', 'reserved',
    ];

}
