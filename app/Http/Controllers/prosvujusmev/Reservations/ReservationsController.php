<?php 

namespace App\Http\Controllers\prosvujusmev\Reservations;

use App\Http\Controllers\Controller;
use FunFirst\Reservations\Models\Reservations\Reservation;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function index()
    {
        return response()->view('reservations.index');
    }

    public function store(Request $request)
    {
        Reservation::create([
            'course_date_id' => $request->courseDateId,
            'source_type' => $request->sourceType,
            'source_code' => $request->sourceCode,
            'status' => 'Čeká na schválení',
        ]);

        return response()->json([]);
    }
}
