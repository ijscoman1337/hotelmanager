<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = ['name', 'email', 'password', 'date_birth', 'phone', 'role'];

    /**
     * Get the reservations for the user.
     */
    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }
}
