<?php 

namespace App\Http\Controllers\prosvujusmev\Reservations;

use App\Http\Controllers\Controller;
use App\prosvujusmev\Reservations\Reservation;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function index()
    {
        return response()->view('reservations.index');
    }

    public function store(Request $request)
    {
        foreach ($request->reservations as $reservation) {
            Reservation::create([
                'course_date_id' => $reservation['courseDateId'],
                'source_type' => 'Slevomat',//$reservation['sourceType'],
                'source_code' => $reservation['sourceCode'],
                'status' => 'Čeká na schválení',
            ]);
        }

        return response()->json([]);
    }
}
