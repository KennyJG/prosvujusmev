<?php

namespace App\prosvujusmev\Courses\Repositories;

use App\prosvujusmev\Courses\CourseDate;
use App\prosvujusmev\Reservations\Repositories\ReservationRepository;
use App\prosvujusmev\Reservations\Reservation;

class CourseDateRepository 
{
    /**
     *  Deletes CourseDate 
     * 
     *  @param \App\prosvujusmev\Courses\CourseDate $courseDate
     *  @return bool
     */
    public function delete(CourseDate $courseDate):bool
    {
        foreach ($courseDate->reservations as $reservation) {
            app(\App\prosvujusmev\Reservations\Repositories\ReservationRepository::class)->delete($reservation);
        }
        return $courseDate->delete();
    }

    /**
     *  Completes CourseDate
     * 
     *  @param \App\prosvujusmev\Courses\CourseDate $courseDate
     *  @param Array $attendedReservationIds
     *  @return bool
     */
    public function complete(CourseDate $courseDate, Array $attendedReservationIds):bool
    {
        try {
            foreach ($attendedReservationIds as $reservationId) {
                $reservation = \App\prosvujusmev\Reservations\Reservation::findOrFail($reservationId);
                if ($reservation->status !== Reservation::STATUS_COMPLETED) {
                    app(ReservationRepository::class)->complete($reservation);
                }
            }
            foreach ($courseDate->reservations()->whereNotIn('id', $attendedReservationIds)->get() as $reservation) {
                if (Reservation::where('source_code', $reservation->source_code)->where('status', Reservation::STATUS_CONDITIONED)->count() !== 0) {
                    app(ReservationRepository::class)->suspend($reservation);
                } else {
                    app(ReservationRepository::class)->condition($reservation);
                }
            }
            $courseDate->update(['status' => CourseDate::STATUS_COMPLETED]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}