<?php

namespace App\Rules;

use App\prosvujusmev\Reservations\Reservation;
use Illuminate\Contracts\Validation\Rule;

class SourceCode implements Rule
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
        if (Reservation::where('source_code', $value)->where('status', '!=', Reservation::STATUS_CONDITIONED)->count() !== 0) {
            $this->message = 'Číslo objednávky bylo již použito.';
            return false; // Reservation with code already exists
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
