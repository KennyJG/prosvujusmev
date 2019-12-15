<?php

namespace App\prosvujusmev\Attendees;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    protected $table = 'attendees';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'funfirst_contact_id'
    ];

    public function reservations()
    {
        return $this->hasMany(\App\prosvujusmev\Reservations\Reservation::class);
    }
}