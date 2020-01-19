<?php

namespace App\prosvujusmev\Reservations\Listeners;

use App\prosvujusmev\Courses\Mails\CourseDateFirstInformation;
use App\prosvujusmev\Reservations\Events\ReservationCreated;

class SendFirstCourseInformationMailToNewReservation
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\prosvujusmev\Reservations\Events\ReservationCreated $event
     * @return void
     */
    public function handle(ReservationCreated $event)
    {
        $reservation = $event->reservation;
        $attendee = $reservation->attendee;
        $courseDate = $reservation->courseDate;

        if ($reservation->status == 'CREATED' && $courseDate->daysToCourseDate < 14) {
            \Mail::to($attendee)->send(new CourseDateFirstInformation($courseDate));
        }
    }
}