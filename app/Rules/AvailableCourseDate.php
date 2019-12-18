<?php

namespace App\Rules;

use App\prosvujusmev\Courses\CourseDate;
use App\prosvujusmev\Reservations\Reservation;
use Illuminate\Contracts\Validation\Rule;

class AvailableCourseDate implements Rule
{
    protected $message = '';
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $courseDate = CourseDate::find($value);
        if ($courseDate == null) {
            return false; // Not existing CourseDate
        }

        if ($courseDate->status !== CourseDate::STATUS_ACTIVE) {
            $this->message = 'Na tento termín se nelze přihlásit.';
            return false; // CourseDate is not in valid state (already started, already completed or has been cancled)
        }
        if ($courseDate->remaining < 1) {
            $this->message = 'Tento termín je již plně obsazen.';
            return false; // CourseDate limit has been reached.
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
