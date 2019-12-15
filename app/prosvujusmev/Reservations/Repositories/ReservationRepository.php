<?php

namespace App\prosvujusmev\Reservations\Repositories;

use App\prosvujusmev\Reservations\Events\ReservationApproved;
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

    /**
     *  Approves Reservation
     * 
     *  @param \App\prosvujusmev\Reservations\Reservation $reservation
     *  @return \App\prosvujusmev\Reservations\Reservation
     */
    public function approve(Reservation $reservation): Reservation
    {
        $reservation->update([
            'status' => 'Schváleno',
        ]);
        event(new ReservationApproved($reservation->fresh()));
        return $reservation->fresh();
    }
}