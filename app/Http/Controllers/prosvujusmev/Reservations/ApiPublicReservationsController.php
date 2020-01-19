<?php

namespace App\Http\Controllers\prosvujusmev\Reservations;

use App\Http\Controllers\Controller;
use App\prosvujusmev\Reservations\Repositories\ReservationRepository;
use App\prosvujusmev\Reservations\Reservation;
use App\prosvujusmev\Reservations\Resources\PublicReservationResource;
use App\Rules\AvailableCourseDate;
use Illuminate\Http\Request;

class ApiPublicReservationsController extends Controller
{
    public function show(Request $request, Reservation $publicReservation)
    {
        return [
            'data' => new PublicReservationResource($publicReservation),
        ];
    }

    public function update(Request $request, Reservation $publicReservation)
    {
        $this->validate($request, [
            'courseDateId' => ['required', new AvailableCourseDate],
        ]);

        $publicReservation->update([
            'course_date_id' => $request->courseDateId
        ]);
        
        return response()->json([
            'data' => new PublicReservationResource($publicReservation->fresh()),
        ]);
    }

    public function cancel(Request $request, Reservation $publicReservation) 
    {
        app(ReservationRepository::class)->cancel($publicReservation);
        return response()->json([
            'data' => new PublicReservationResource($publicReservation->fresh()),
        ]);
    }
}
