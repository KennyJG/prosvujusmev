<?php

namespace App\prosvujusmev\Reservations\Listeners;

use App\prosvujusmev\Reservations\Events\SubstituteReservationCreated;
use App\prosvujusmev\Reservations\Mails\SubstituteReservationCreated as MailsSubstituteReservationCreated;
use App\prosvujusmev\Reservations\Reservation;

class SendSubstituteReservationCreatedNotification
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
    public function handle(SubstituteReservationCreated $event)
    {
        $reservation = $event->reservation;
        if ($reservation->status === Reservation::STATUS_QUEUED) {
            $attendee = $reservation->attendee;
            \Mail::to($attendee)->send(new MailsSubstituteReservationCreated($reservation));
        }
    }
}