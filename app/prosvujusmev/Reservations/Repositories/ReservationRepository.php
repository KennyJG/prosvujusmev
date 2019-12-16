<?php

namespace App\prosvujusmev\Reservations\Repositories;

use App\prosvujusmev\Reservations\Events\ReservationApproved;
use App\prosvujusmev\Reservations\Events\ReservationCompleted;
use App\prosvujusmev\Reservations\Events\ReservationDeleted;
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
        $result = $reservation->delete();
        event(new ReservationDeleted($reservation));
        return $result;
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
    
    /**
     *  Complete Reservation
     * 
     *  @param \App\prosvujusmev\Reservations\Reservation $reservation
     *  @return \App\prosvujusmev\Reservations\Reservation
     */
    public function complete(Reservation $reservation): Reservation
    {
        $reservation->update([
            'status' => Reservation::STATUS_COMPLETED,
        ]);
        event(new ReservationCompleted($reservation->fresh()));
        return $reservation->fresh();
    }
}