<?php

namespace App\prosvujusmev\Courses\Repositories;

use App\prosvujusmev\Courses\CourseDate;
use App\prosvujusmev\Courses\Mails\CourseDateFinalInformation;
use App\prosvujusmev\Courses\Mails\CourseDateFirstInformation;
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

    /**
     *  Send email to Attendees of CourseDate
     * 
     *  @param \App\prosvujusmev\Courses\CourseDate $courseDate
     *  @param \Illuminate\Mail\Mailable $mail
     *  @return void
     */
    public function sendEmailToAttendees(CourseDate $courseDate, \Illuminate\Mail\Mailable $mail): void
    {
        foreach ($courseDate->getAttendees() as $attendee) {
            \Mail::to($attendee)->send($mail);
        }
    }

     /**
     *  Send email to Substitutes of CourseDate
     * 
     *  @param \App\prosvujusmev\Courses\CourseDate $courseDate
     *  @return void
     */
    public function sendEmailToSubstitutes(CourseDate $courseDate, $mailClass): void
    {
        foreach ($courseDate->getAttendees() as $attendee) {
            if ($attendee->reservations()->where('course_date_id', $courseDate->id)->where('status', Reservation::STATUS_QUEUED)->count() !== 0) {
                $reservation = $attendee->reservations()->where('course_date_id', $courseDate->id)->where('status', Reservation::STATUS_QUEUED)->first();
                $mail = new $mailClass($courseDate, $reservation);
                \Mail::to($attendee)->send($mail);
            }
        }
    }

    /**
     *  Send First Information email to Attendees of CourseDatee
     * 
     *  @param \App\prosvujusmev\Courses\CourseDate $courseDate
     *  @return void
     */
    public function sendFirstInformationEmail(CourseDate $courseDate): void
    {
        $mail = new CourseDateFirstInformation($courseDate);
        $this->sendEmailToAttendees($courseDate, $mail);
    }

    /**
     *  Send Final Information email to Attendees of CourseDatee
     * 
     *  @param \App\prosvujusmev\Courses\CourseDate $courseDate
     *  @return void
     */
    public function sendFinalInformationEmail(CourseDate $courseDate): void
    {
        $mail = new CourseDateFinalInformation($courseDate);
        $this->sendEmailToAttendees($courseDate, $mail);
    }
}