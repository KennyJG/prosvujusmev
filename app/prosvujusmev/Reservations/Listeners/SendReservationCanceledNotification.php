<?php

namespace App\prosvujusmev\Reservations\Listeners;

use App\prosvujusmev\Reservations\Events\ReservationCanceled;
use App\prosvujusmev\Reservations\Events\ReservationSuspended;
use App\prosvujusmev\Reservations\Mails\ReservationSuspended as MailsReservationSuspended;

class SendReservationSuspendedNotification
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
     * @param  \App\prosvujusmev\Reservations\Events\ReservationSuspended $event
     * @return void
     */
    public function handle(ReservationCanceled $event)
    {
        $reservation = $event->reservation;
        $attendee = $reservation->attendee;
        \Mail::to($attendee)->send(new MailsReservationSuspended($reservation));
    }
}