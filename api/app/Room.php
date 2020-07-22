<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    protected $fillable = ['people_count', 'price_per_night'];

    /**
     * Get the reservations for the room.
     */
    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }
}
