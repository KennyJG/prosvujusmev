<?php

namespace App\prosvujusmev\Reservations\Listeners;

use App\prosvujusmev\Reservations\Mails\SubstituteReservationHasBecomeFull;

class SendSubstituteReservationHasBecomeFullNotification
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
     * @param mixed $event
     * @return void
     */
    public function handle($event)
    {
        $reservation = $event->reservation;
        $oldReservation = $event->oldReservation;
        $attendee = $reservation->attendee;
        \Mail::to($attendee)->send(new SubstituteReservationHasBecomeFull($reservation, $oldReservation));
    }
}