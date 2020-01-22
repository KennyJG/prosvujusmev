<?php

namespace App\Http\Controllers\prosvujusmev\Reservations;

use App\Http\Controllers\Controller;
use App\prosvujusmev\Reservations\Repositories\ReservationRepository;
use App\prosvujusmev\Reservations\Reservation;
use App\prosvujusmev\Reservations\Resources\PublicReservationResource;
use App\prosvujusmev\Reservations\Resources\ReservationResource;
use Illuminate\Http\Request;

class PublicReservationsController extends Controller
{
    public function show(Request $request, Reservation $publicReservation)
    {
        return view('reservations.public_show', [
            'reservation' => new PublicReservationResource($publicReservation),
        ]);
    }

    public function confirm(Request $request, Reservation $publicReservation)
    {
        abort_if(!$publicReservation->isSubstitute(), 404);
        abort_if($publicReservation->status != Reservation::STATUS_QUEUED, 404);

        app(ReservationRepository::class)->makeFullReservation($publicReservation);

        return view('reservations.confirmed', [
            'reservation' => new PublicReservationResource($publicReservation->fresh()),
        ]);
    }
}
