<?php

namespace App\prosvujusmev\Reservations\Listeners;

use App\prosvujusmev\Reservations\Events\ReservationCanceled;
use App\prosvujusmev\Reservations\Mails\ReservationCanceled as MailsReservationCanceled;

class SendReservationCanceledNotification
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
     * @param  \App\prosvujusmev\Reservations\Events\ReservationCanceled $event
     * @return void
     */
    public function handle(ReservationCanceled $event)
    {
        $reservation = $event->reservation;
        $attendee = $reservation->attendee;
        \Mail::to($attendee)->send(new MailsReservationCanceled($reservation));
    }
}
