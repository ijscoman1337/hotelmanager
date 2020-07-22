<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class User extends Model
{
    use HasApiTokens;

    protected $table = 'users';

    protected $fillable = ['name', 'email', 'password', 'date_birth', 'phone', 'role'];

    protected $attributes = ['role' => 'customer'];

    /**
     * Get the reservations for the user.
     */
    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }
}
