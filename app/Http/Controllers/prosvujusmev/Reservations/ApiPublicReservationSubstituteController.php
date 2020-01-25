<?php

namespace App\Http\Controllers\prosvujusmev\Reservations;

use App\Http\Controllers\Controller;
use App\prosvujusmev\Reservations\Events\ReservationCreated;
use App\prosvujusmev\Reservations\Events\SubstituteReservationCreated;
use App\prosvujusmev\Reservations\Repositories\ReservationRepository;
use App\prosvujusmev\Reservations\Reservation;
use App\prosvujusmev\Reservations\ReservationStatusRecord;
use App\prosvujusmev\Reservations\Resources\PublicReservationResource;
use Illuminate\Http\Request;

class ApiPublicReservationSubstituteController extends Controller
{
    public function store(Request $request, Reservation $publicReservation)
    {
        $this->validate($request, [
            'courseDateId' => 'required|exists:course_dates,id'
        ]);
        if ($publicReservation->queuedReservation) {
            $publicReservation->queuedReservation->delete();
        }
        $reservation = Reservation::create([
            'course_date_id' => $request->courseDateId,
            'source_type' => $publicReservation->source_type,
            'source_code' => $publicReservation->source_code,
            'status' => Reservation::STATUS_QUEUED,
            'attendee_id' => $publicReservation->attendee->id,
            'reservation_id' => $publicReservation->id,
        ]);
        ReservationStatusRecord::create([
            'reservation_id' => $reservation->id,
            'old_status' => null,
            'new_status' => Reservation::STATUS_QUEUED,
        ]);
        event(new SubstituteReservationCreated($reservation));

        return [
            'data' => new PublicReservationResource($publicReservation),
        ];
    }
}
