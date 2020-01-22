<?php

namespace App\prosvujusmev\Reservations\Repositories;

use App\prosvujusmev\Reservations\Events\ReservationApproved;
use App\prosvujusmev\Reservations\Events\ReservationCanceled;
use App\prosvujusmev\Reservations\Events\ReservationCompleted;
use App\prosvujusmev\Reservations\Events\ReservationConditioned;
use App\prosvujusmev\Reservations\Events\ReservationDeleted;
use App\prosvujusmev\Reservations\Events\ReservationSuspended;
use App\prosvujusmev\Reservations\Events\SubstituteReservationHasBecomeFull;
use App\prosvujusmev\Reservations\Reservation;
use App\prosvujusmev\Reservations\ReservationStatusRecord;

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
     *  Unapproves Reservation
     * 
     *  @param \App\prosvujusmev\Reservations\Reservation $reservation
     *  @return \App\prosvujusmev\Reservations\Reservation
     */
    public function unapprove(Reservation $reservation): Reservation
    {
        $oldStatus = $reservation->status;
        $reservation->update([
            'status' => Reservation::STATUS_UNAPPROVED,
        ]);
        ReservationStatusRecord::create([
            'reservation_id' => $reservation->id,
            'old_status' => $oldStatus,
            'new_status' => Reservation::STATUS_UNAPPROVED,
        ]);
        return $reservation->fresh();
    }
    /**
     *  Approves Reservation
     * 
     *  @param \App\prosvujusmev\Reservations\Reservation $reservation
     *  @return \App\prosvujusmev\Reservations\Reservation
     */
    public function approve(Reservation $reservation): Reservation
    {
        $oldStatus = $reservation->status;
        $reservation->update([
            'status' => Reservation::STATUS_APPROVED,
        ]);
        ReservationStatusRecord::create([
            'reservation_id' => $reservation->id,
            'old_status' => $oldStatus,
            'new_status' => Reservation::STATUS_APPROVED,
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
        $oldStatus = $reservation->status;
        $reservation->update([
            'status' => Reservation::STATUS_COMPLETED,
        ]);
        ReservationStatusRecord::create([
            'reservation_id' => $reservation->id,
            'old_status' => $oldStatus,
            'new_status' => Reservation::STATUS_COMPLETED,
        ]);
        event(new ReservationCompleted($reservation->fresh()));
        return $reservation->fresh();
    }
    
    /**
     *  Condition Reservation
     * 
     *  @param \App\prosvujusmev\Reservations\Reservation $reservation
     *  @return \App\prosvujusmev\Reservations\Reservation
     */
    public function condition(Reservation $reservation): Reservation
    {
        $oldStatus = $reservation->status;
        $reservation->update([
            'status' => Reservation::STATUS_CONDITIONED,
        ]);
        ReservationStatusRecord::create([
            'reservation_id' => $reservation->id,
            'old_status' => $oldStatus,
            'new_status' => Reservation::STATUS_CONDITIONED,
        ]);
        event(new ReservationConditioned($reservation->fresh()));
        return $reservation->fresh();
    }

    /**
     *  Suspend Reservation
     * 
     *  @param \App\prosvujusmev\Reservations\Reservation $reservation
     *  @return \App\prosvujusmev\Reservations\Reservation
     */
    public function suspend(Reservation $reservation): Reservation
    {
        $oldStatus = $reservation->status;
        $reservation->update([
            'status' => Reservation::STATUS_SUSPENDED,
        ]);
        ReservationStatusRecord::create([
            'reservation_id' => $reservation->id,
            'old_status' => $oldStatus,
            'new_status' => Reservation::STATUS_SUSPENDED,
        ]);
        event(new ReservationSuspended($reservation->fresh()));
        return $reservation->fresh();
    }

    /**
     *  Cancels Reservation 
     * 
     *  @param \App\prosvujusmev\Reservations\Reservation $reservation
     *  @return \App\prosvujusmev\Reservations\Reservation
     */
    public function cancel(Reservation $reservation): Reservation
    {
        $reservation->update([
            'status' => Reservation::STATUS_CANCELED,
        ]);
        event(new ReservationCanceled($reservation->fresh()));
        return $reservation->fresh();
    }

    /**
     *  Cancels Substitute Reservation 
     * 
     *  @param \App\prosvujusmev\Reservations\Reservation $reservation
     *  @return \App\prosvujusmev\Reservations\Reservation
     */
    public function cancelSubstitute(Reservation $reservation): Reservation
    {
        $reservation->update([
            'status' => Reservation::STATUS_CANCELED,
        ]);
        return $reservation->fresh();
    }

    /**
     *  Make full reservation from substitute reservation 
     * 
     *  @param \App\prosvujusmev\Reservations\Reservation $reservation
     *  @return \App\prosvujusmev\Reservations\Reservation
     */
    public function makeFullReservation(Reservation $reservation): Reservation
    {
        $mainReservation = $reservation->mainReservation;
        $mainReservation->update([
            'status' => Reservation::STATUS_CANCELED,
        ]);

        $reservation->update([
            'status' => Reservation::STATUS_UNAPPROVED,
            'reservation_id' => null,
        ]);

        event(new SubstituteReservationHasBecomeFull($reservation->fresh()));

        return $reservation->fresh();
    }
}