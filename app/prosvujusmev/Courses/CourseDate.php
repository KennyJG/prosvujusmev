<?php

namespace App\prosvujusmev\Courses;

use App\prosvujusmev\Reservations\Reservation;
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

    protected $appends = ['fullDateForHumans', 'remaining', 'daysToCourseDate', 'createdAtForHumans', 'full', 'courseName'];

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
        return $this->limit - $this->reservations()
            ->whereIn('status', [
                Reservation::STATUS_APPROVED,
                Reservation::STATUS_UNAPPROVED,
                Reservation::STATUS_COMPLETED,
                Reservation::STATUS_CONDITIONED,
                Reservation::STATUS_SUSPENDED, 
            ])->count();
    }

    public function getFullDateForHumansAttribute()
    {
        $fromDay = $this->from_date->format('d.');
        $toDateDate = $this->to_date->format('d. m. Y');
        return "{$fromDay} - {$toDateDate}";
    }

    public function getCreatedAtForHumansAttribute()
    {
        \Carbon\Carbon::setLocale('cs');
        return $this->created_at->diffForHumans();
    }

    public function getDaysToCourseDateAttribute()
    {
        $now = \Carbon\Carbon::now();
        $now->hour = 1;
        $fromDate = \Carbon\Carbon::parse($this->from_date);
        $fromDate->hour = 0;
        return $now->diffInDays($fromDate);
    }

    public function getAttendees()
    {
        $attendees = [];
        foreach ($this->reservations as $reservation) {
            $attendees[] = $reservation->attendee;
        }
        return $attendees;
    }

    public function scopeFuture($query)
    {
        $query->where('from_date', '>', \Carbon\Carbon::now())
            ->where('to_date', '>', \Carbon\Carbon::now());
    }

    public function getFullAttribute()
    {
        return $this->remaining <= 0;
    }

    public function getCourseNameAttribute()
    {
        return $this->course->name;
    }

    public function getFirstInformationAttribute()
    {
        $emailMessage = \App\prosvujusmev\EmailMessages\EmailMessage::where('model_id', $this->id)
            ->where('model_type', self::class)
            ->where('type', \App\prosvujusmev\EmailMessages\EmailMessage::TYPE_FIRST_INFORMATION)
            ->first();
         
        if ($emailMessage) {
            return json_decode($emailMessage->data)->text;
        }

        return null;
    }

    public function getFinalInformationAttribute()
    {
        $emailMessage = \App\prosvujusmev\EmailMessages\EmailMessage::where('model_id', $this->id)
            ->where('model_type', self::class)
            ->where('type', \App\prosvujusmev\EmailMessages\EmailMessage::TYPE_FINAL_INFORMATION)
            ->first();

        if ($emailMessage) {
            return json_decode($emailMessage->data)->text;
        }

        return null;
    }
}
