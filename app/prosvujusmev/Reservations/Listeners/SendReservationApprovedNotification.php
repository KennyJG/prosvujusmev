<?php

namespace App\prosvujusmev\Reservations\Listeners;

use App\prosvujusmev\Reservations\Events\ReservationApproved;
use App\prosvujusmev\Reservations\Mails\ReservationApproved as MailsReservationApproved;

class SendReservationApprovedNotification
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
     * @param  \App\prosvujusmev\Reservations\Events\ReservationApproved $event
     * @return void
     */
    public function handle(ReservationApproved $event)
    {
        $reservation = $event->reservation;
        $attendee = $reservation->attendee;
        \Mail::to($attendee)->send(new MailsReservationApproved($reservation));
    }
}