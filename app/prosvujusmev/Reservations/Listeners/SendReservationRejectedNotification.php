<?php

namespace App\prosvujusmev\Reservations\Listeners;

use App\prosvujusmev\Reservations\Events\ReservationRejected;
use App\prosvujusmev\Reservations\Mails\ReservationCompleted as MailsReservationCompleted;
use App\prosvujusmev\Reservations\Mails\ReservationRejected as MailsReservationRejected;

class SendReservationRejectedNotification
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
     * @param  \App\prosvujusmev\Reservations\Events\ReservationRejected $event
     * @return void
     */
    public function handle(ReservationRejected $event)
    {
        $reservation = $event->reservation;
        $attendee = $reservation->attendee;
        \Mail::to($attendee)->send(new MailsReservationRejected($reservation));
    }
}