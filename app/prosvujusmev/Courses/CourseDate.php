<?php

namespace App\prosvujusmev\Courses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseDate extends Model
{
    use SoftDeletes;

    protected $table = 'course_dates';

    protected $fillable = [
        'course_id',
        'from_date',
        'to_date',
        'venue',
        'status',
        'lecturer',
        'limit',
        'description',
    ];

    protected $dates = [
        'from_date',
        'to_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    protected $appends = ['fullDateForHumans', 'remaining'];

    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_IN_PROGRESS = 'IN_PROGRESS';
    const STATUS_COMPLETED = 'COMPLETED';
    const STATUS_CANCELED = 'CANCELED';

    public function course()
    {
        return $this->belongsTo(\App\prosvujusmev\Courses\Course::class);
    }

    public function reservations()
    {
        return $this->hasMany(\App\prosvujusmev\Reservations\Reservation::class);
    }

    public function getRemainingAttribute()
    {
        return $this->limit - $this->reservations()->count();
    }

    public function getFullDateForHumansAttribute()
    {
        $fromDateDate = $this->from_date->format('d.m.Y');
        $fromDateTime = $this->from_date->format('H:i');
        $toDateDate = $this->to_date->format('d.m.Y');
        $toDateTime = $this->to_date->format('H:i');

        return "{$fromDateDate} {$fromDateTime} - {$toDateDate} {$toDateTime}";
    }
}
