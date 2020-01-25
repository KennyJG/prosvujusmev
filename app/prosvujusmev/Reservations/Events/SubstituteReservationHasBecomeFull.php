<?php

namespace App\prosvujusmev\Reservations\Events;

use App\prosvujusmev\Reservations\Reservation;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SubstituteReservationHasBecomeFull
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reservation;
    public $oldReservation;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Reservation $reservation, Reservation $oldReservation)
    {
        $this->reservation = $reservation;
        $this->oldReservation = $oldReservation;
    }
}
