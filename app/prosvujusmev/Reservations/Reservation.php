<?php

namespace App\prosvujusmev\Reservations;

use Faker\Provider\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Reservation extends Model
{
    use SoftDeletes;

    protected $table = 'reservations';

    protected $fillable = [
        'uuid',
        'course_date_id',
        'source_type',
        'source_code',
        'status',
        'attendee_id',
        'reservation_id',
    ];

    const STATUS_CREATED = 'CREATED';
    const STATUS_UNAPPROVED = 'UNAPPROVED';
    const STATUS_APPROVED = 'APPROVED';
    const STATUS_COMPLETED = 'COMPLETED';
    const STATUS_CONDITIONED = 'CONDITIONED';
    const STATUS_SUSPENDED = 'SUSPENDED';
    const STATUS_CANCELED = 'CANCELED';
    const STATUS_QUEUED = 'QUEUED';

    const SOURCE_TYPE_SLEVOMAT = 'SLEVOMAT';
    const SOURCE_TYPE_FUNFIRST = 'FUNFIRST';

    public static function create(array $attributes = [])
    {
        $attributes = array_merge(['uuid' => Uuid::uuid()], $attributes);
        $model = static::query()->create($attributes);
        return $model;
    }

    public function courseDate()
    {
        return $this->belongsTo(\App\prosvujusmev\Courses\CourseDate::class);
    }

    public function attendee()
    {
        return $this->belongsTo(\App\prosvujusmev\Attendees\Attendee::class);
    }

    public function queuedReservation()
    {
        return $this->hasOne(Reservation::class, 'reservation_id', 'id');
    }

    public function statusRecords()
    {
        return $this->hasMany(ReservationStatusRecord::class);
    }
}
