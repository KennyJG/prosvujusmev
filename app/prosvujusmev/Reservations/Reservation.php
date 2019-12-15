<?php

namespace App\prosvujusmev\Reservations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;

    protected $table = 'reservations';

    protected $fillable = [
        'course_date_id',
        'source_type',
        'source_code',
        'status',
        'attendee_id',
    ];

    public function courseDate()
    {
        return $this->belongsTo(\App\prosvujusmev\Courses\CourseDate::class);
    }

    public function attendee()
    {
        return $this->belongsTo(\App\prosvujusmev\Attendees\Attendee::class);
    }
}
