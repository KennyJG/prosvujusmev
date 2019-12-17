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

    const STATUS_CREATED = 'CREATED';
    const STATUS_UNAPPROVED = 'UNAPPROVED';
    const STATUS_APPROVED = 'APPROVED';
    const STATUS_COMPLETED = 'COMPLETED';
    const STATUS_CONDITIONED = 'CONDITIONED';
    const STATUS_SUSPENDED = 'SUSPENDED';
    const STATUS_CANCELED = 'CANCELED';

    public function courseDate()
    {
        return $this->belongsTo(\App\prosvujusmev\Courses\CourseDate::class);
    }

    public function attendee()
    {
        return $this->belongsTo(\App\prosvujusmev\Attendees\Attendee::class);
    }

    public function statusRecords()
    {
        return $this->hasMany(ReservationStatusRecord::class);
    }
}
