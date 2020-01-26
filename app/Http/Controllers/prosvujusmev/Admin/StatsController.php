<?php

namespace App\Http\Controllers\prosvujusmev\Admin;

use App\Http\Controllers\Controller;
use App\prosvujusmev\Courses\CourseDate;
use App\prosvujusmev\Reservations\Reservation;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index(Request $request)
    {
        $courseDatesThisMonth = CourseDate::whereRaw('MONTH(from_date) = '. \Carbon\Carbon::now()->format('m'))->get();
        $courseDatesNextMonth = CourseDate::whereRaw('MONTH(from_date) = '. \Carbon\Carbon::now()->addMonth()->format('m'))->get();
        $reservationsWaitingForApprovement = Reservation::where('status', Reservation::STATUS_UNAPPROVED)->get();
        $queuedReservations = Reservation::where('status', Reservation::STATUS_QUEUED)->get();
        return response()->json([
            'data' => [
                'courseDatesThisMonth' => $courseDatesThisMonth,
                'courseDatesNextMonth' => $courseDatesNextMonth,
                'reservationsWaitingForApprovement' => $reservationsWaitingForApprovement,
                'queuedReservations' => $queuedReservations
            ],
        ]);
    }
}
