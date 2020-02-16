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

    public $appends = ['createdAtForHumans'];

    const STATUS_CREATED = 'CREATED';
    const STATUS_UNAPPROVED = 'UNAPPROVED';
    const STATUS_APPROVED = 'APPROVED';
    const STATUS_COMPLETED = 'COMPLETED';
    const STATUS_CONDITIONED = 'CONDITIONED';
    const STATUS_SUSPENDED = 'SUSPENDED';
    const STATUS_CANCELED = 'CANCELED';
    const STATUS_QUEUED = 'QUEUED';
    const STATUS_REJECTED = 'REJECTED';

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

    public function mainReservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id', 'id');
    }

    public function statusRecords()
    {
        return $this->hasMany(ReservationStatusRecord::class);
    }

    public function isSubstitute()
    {
        return $this->reservation_id !== null;
    }

    public function canBeCanceled()
    {
        $oldCourseDate = $this->courseDate;
        $now = \Carbon\Carbon::now();
        $startOfCourse = \Carbon\Carbon::parse($oldCourseDate->from_date);
        return $startOfCourse->diffInDays($now) > 4 && in_array($this->status, [
            self::STATUS_CREATED,
            self::STATUS_UNAPPROVED,
            self::STATUS_APPROVED,
            self::STATUS_QUEUED,
        ]);
    }

    public function canChangeCourseDate()
    {
        $oldCourseDate = $this->courseDate;
        $now = \Carbon\Carbon::now();
        $startOfCourse = \Carbon\Carbon::parse($oldCourseDate->from_date);
        return $startOfCourse->diffInDays($now) > 4 && in_array($this->status, [
            self::STATUS_CREATED,
            self::STATUS_UNAPPROVED,
            self::STATUS_APPROVED,
            self::STATUS_QUEUED,
        ]);
    }

    public function getCreatedAtForHumansAttribute()
    {
        \Carbon\Carbon::setLocale('cs');
        return $this->created_at->diffForHumans();
    }
}
