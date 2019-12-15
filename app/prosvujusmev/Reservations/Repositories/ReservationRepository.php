<?php

namespace App\prosvujusmev\Reservations\Repositories;

use App\prosvujusmev\Reservations\Reservation;

class ReservationRepository 
{
    /**
     *  Deletes Reservation
     * 
     *  @param \App\prosvujusmev\Reservations\Reservation $reservation
     *  @return bool
     */
    public function delete(Reservation $reservation):bool
    {
        // app(\App\prosvujusmev\Attendees\Repositories\AttendeeRepository::class)->delete($reservation->attendee);
        return $reservation->delete();
    }
}