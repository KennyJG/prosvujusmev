<?php

namespace App\prosvujusmev\Reservations\Listeners;

use App\prosvujusmev\Reservations\Repositories\ReservationRepository;

class CancelSubstituteReservation
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
        if ($reservation->queuedReservation) {
            app(ReservationRepository::class)->cancelSubstitute($reservation->queuedReservation);
        }
    }
}