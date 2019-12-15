<?php

namespace App\prosvujusmev\Attendees;

use Illuminate\Database\Eloquent\Model;

class AttendeeAddress extends Model
{
    protected $table = 'attendee_addresses';

    protected $fillable = [
        'street',
        'city',
        'country',
        'zip',
        'attendee_id'
    ];

    public function attendee()
    {
        return $this->hasMany(\App\prosvujusmev\Attendees\Attendee::class);
    }
}