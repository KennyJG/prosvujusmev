<?php

namespace App\prosvujusmev\Reservations\Listeners;

use App\prosvujusmev\Reservations\Events\ReservationCourseDateChanged;
use App\prosvujusmev\Reservations\Mails\ReservationCourseDateChanged as MailsReservationCourseDateChanged;

class SendReservationCourseDateChanged 
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
     * @param  \App\prosvujusmev\Reservations\Events\ReservationCourseDateChanged $event
     * @return void
     */
    public function handle(ReservationCourseDateChanged $event)
    {
        $reservation = $event->reservation;
        $attendee = $reservation->attendee;
        \Mail::to($attendee)->send(new MailsReservationCourseDateChanged($reservation));
    }
}