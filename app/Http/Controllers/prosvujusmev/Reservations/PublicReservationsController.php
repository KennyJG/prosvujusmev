<?php

namespace App\Http\Controllers\prosvujusmev\Reservations;

use App\Http\Controllers\Controller;
use App\prosvujusmev\Reservations\Repositories\ReservationRepository;
use App\prosvujusmev\Reservations\Reservation;
use App\prosvujusmev\Reservations\Resources\PublicReservationResource;
use Illuminate\Http\Request;

class PublicReservationsController extends Controller
{
    public function show(Request $request, Reservation $publicReservation)
    {
        if ($publicReservation->isSubstitute()) {
            $publicReservation = $publicReservation->mainReservation;
        }
        return view('reservations.public_show', [
            'reservation' => new PublicReservationResource($publicReservation),
        ]);
    }

    public function confirm(Request $request, Reservation $publicReservation)
    {
        abort_if(!$publicReservation->isSubstitute(), 404);
        abort_if($publicReservation->status != Reservation::STATUS_QUEUED, 404);

        if ($publicReservation->courseDate->remaining === 0) {
            return view('reservations.spot_taken', [
                'reservation' => new PublicReservationResource($publicReservation->fresh()),
            ]);
        }

        app(ReservationRepository::class)->makeFullReservation($publicReservation);

        return view('reservations.confirmed', [
            'reservation' => new PublicReservationResource($publicReservation->fresh()),
        ]);
    }

    public function cancel(Request $request, Reservation $publicReservation)
    {
        abort_if(!$publicReservation->isSubstitute(), 404);
        abort_if($publicReservation->status != Reservation::STATUS_QUEUED, 404);

        app(ReservationRepository::class)->cancel($publicReservation);

        return view('reservations.canceled', [
            'reservation' => new PublicReservationResource($publicReservation->fresh()),
        ]);
    }
}
