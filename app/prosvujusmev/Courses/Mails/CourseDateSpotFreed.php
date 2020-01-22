<?php

namespace App\prosvujusmev\Courses\Mails;

use App\prosvujusmev\Courses\CourseDate;
use App\prosvujusmev\Reservations\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CourseDateSpotFreed extends Mailable
{
    use Queueable, SerializesModels;

    protected $courseDate;
    protected $reservation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CourseDate $courseDate, Reservation $reservation)
    {
        $this->courseDate = $courseDate;
        $this->reservation = $reservation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.courses.spot_freed', [
            'courseDate' => $this->courseDate,
            'reservation' => $this->reservation,
        ]);
    }
}
