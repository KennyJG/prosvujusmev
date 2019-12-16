<?php

namespace App\prosvujusmev\Reservations\Listeners;

use App\prosvujusmev\Reservations\Events\ReservationCompleted;
use App\prosvujusmev\Reservations\Mails\ReservationCompleted as MailsReservationCompleted;

class SendReservationCompletedNotification
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
     * @param  \App\prosvujusmev\Reservations\Events\ReservationCompleted $event
     * @return void
     */
    public function handle(ReservationCompleted $event)
    {
        $reservation = $event->reservation;
        $attendee = $reservation->attendee;
        \Mail::to($attendee)->send(new MailsReservationCompleted($reservation));
    }
}