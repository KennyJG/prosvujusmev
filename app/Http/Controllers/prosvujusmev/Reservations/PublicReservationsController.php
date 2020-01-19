<?php

namespace App\Http\Controllers\prosvujusmev\Reservations;

use App\Http\Controllers\Controller;
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
}
