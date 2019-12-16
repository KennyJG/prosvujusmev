<?php

namespace App\prosvujusmev\Reservations\Listeners;

use App\prosvujusmev\Reservations\Events\ReservationDeleted;
use App\prosvujusmev\Reservations\Mails\ReservationDeleted as MailsReservationDeleted;

class SendReservationDeletedNotification
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
     * @param  \App\prosvujusmev\Reservations\Events\ReservationDeleted $event
     * @return void
     */
    public function handle(ReservationDeleted $event)
    {
        $reservation = $event->reservation;
        $attendee = $reservation->attendee;
        \Mail::to($attendee)->send(new MailsReservationDeleted($reservation));
    }
}