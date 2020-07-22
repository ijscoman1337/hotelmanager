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
        'date_arrival',
        'date_checkout',
        'admin_confirmed',
        'price_total',
        'payment_confirmed'
        ];
}
