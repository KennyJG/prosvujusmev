<?php

namespace App\Http\Controllers\prosvujusmev\Admin;

use App\Http\Controllers\Controller;
use App\prosvujusmev\Courses\CourseDate;
use App\prosvujusmev\Reservations\Reservation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index(Request $request)
    {
        $courseDatesThisMonth = CourseDate::whereRaw('MONTH(from_date) = ' . \Carbon\Carbon::now()->format('m'))->get();
        $courseDatesNextMonth = CourseDate::whereRaw('MONTH(from_date) = ' . \Carbon\Carbon::now()->addMonth()->format('m'))->get();
        $reservationsWaitingForApprovement = Reservation::where('status', Reservation::STATUS_UNAPPROVED)->get();
        $queuedReservations = Reservation::where('status', Reservation::STATUS_QUEUED)->get();
        return response()->json([
            'data' => [
                'courseDatesThisMonth' => $this->getCountOfCourseDatesOfThisMonth(),
                'courseDatesThisYear' => $this->getCountOfCourseDatesOfThisYear(),
                'courseDatesInProgress' => $this->getCountOfCourseDatesInProgress(),
            ],
        ]);
    }

    /**
     *  Return count of Course Dates that happening this month
     * 
     *  @return int 
     */
    private function getCountOfCourseDatesOfThisMonth(): int 
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        return CourseDate::whereBetween('from_date', [
            $startOfMonth,
            $endOfMonth
        ])->count();
    }

    /**
     *  Return count of Course Dates that happening this year
     * 
     *  @return int 
     */
    private function getCountOfCourseDatesOfThisYear(): int 
    {
        $startOfMonth = Carbon::now()->startOfYear();
        $endOfMonth = Carbon::now()->endOfYear();
        return CourseDate::whereBetween('from_date', [
            $startOfMonth,
            $endOfMonth
        ])->count();
    }
 
    /**
     *  Return count of Course Dates that happening right now
     * 
     *  @return int
     */
    private function getCountOfCourseDatesInProgress(): int
    {
        return CourseDate::where('from_date', '>=', Carbon::now())
            ->where('to_date', '<=', Carbon::now())
            ->count();
    }
}
