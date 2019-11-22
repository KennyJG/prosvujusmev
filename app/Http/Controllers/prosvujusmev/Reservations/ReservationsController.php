<?php 

namespace App\Http\Controllers\prosvujusmev\Reservations;

use App\Http\Controllers\Controller;

class ReservationsController extends Controller
{
    public function index()
    {
        return response()->view('reservations.index');
    }
}
