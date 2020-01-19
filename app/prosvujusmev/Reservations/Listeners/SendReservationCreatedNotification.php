<?php

namespace App\prosvujusmev\Reservations\Listeners;

use App\prosvujusmev\Reservations\Events\ReservationCreated;
use App\prosvujusmev\Reservations\Mails\ReservationCreated as MailsReservationCreated;
use App\prosvujusmev\Reservations\Reservation;

class SendReservationCreatedNotification
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
        if ($reservation->status !== Reservation::STATUS_QUEUED) {
            $attendee = $reservation->attendee;
            \Mail::to($attendee)->send(new MailsReservationCreated($reservation));
        }
    }
}