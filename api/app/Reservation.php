<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

    //id
    //created_at
    //updated_at
    //fullname
    //email
    //date_birth
    //phone
    //date_arrival
    //date_checkout
    //admin_confirmed
    //price_total
    //payment_confirmed
class Reservation extends Model
{

    protected $table = 'reservations';

    protected $fillable = [
        'fullname',
        'email',
        'date_birth',
        'phone',
        'date_checkin',
        'date_checkout',
        'admin_confirmed',
        'price_total',
        'payment_confirmed',
        'user_id',
        'room_íd',
        'people_count',
        'nights_count'
    ];

    protected $attributes = [
        'admin_confirmed' => false,
        'payment_confirmed' => false,
        'price_total' => 0,
    ];

    /**
     * Set the user's first name.
     *
     * @param  string|Room  $value
     * @return void
     */
    public function setRoomId($room_id)
    {

    }


}
