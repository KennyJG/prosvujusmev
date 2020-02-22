<?php

namespace App\Http\Controllers\prosvujusmev\Admin;

use App\Http\Controllers\Controller;
use App\prosvujusmev\Courses\CourseDate;
use App\prosvujusmev\Reservations\Reservation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                'fullCourseDatesThisMonth' => $this->getCountOfFullCourseDatesThisMonth(),
                'fullCourseDatesThisYear' => $this->getCountOfFullCourseDatesThisYear(),
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
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();
        return CourseDate::whereBetween('from_date', [
            $startOfYear,
            $endOfYear
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

    /**
     *  Return count of Course Dates that are full this month
     * 
     *  @return int 
     */
    private function getCountOfFullCourseDatesThisMonth(): int 
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $sqlQuery = '
            SELECT 
                COUNT(id) as countOfFullCourseDates
            FROM 
                course_dates 
            WHERE 
                `limit` <= (SELECT COUNT(id) FROM reservations WHERE reservations.course_date_id = course_dates.id AND reservations.reservation_id IS NULL)
            AND 
                (from_date BETWEEN \'' . $startOfMonth->format('Y-m-d H:i:s') . '\' AND \'' . $endOfMonth->format('Y-m-d H:i:s') . '\')';
      
        return DB::select(DB::raw($sqlQuery))[0]->countOfFullCourseDates;
    }

    /**
     *  Return count of Course Dates that are full this year
     * 
     *  @return int 
     */
    private function getCountOfFullCourseDatesThisYear(): int 
    {
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();
        $sqlQuery = '
            SELECT 
                COUNT(id) as countOfFullCourseDates
            FROM 
                course_dates 
            WHERE 
                `limit` <= (SELECT COUNT(id) FROM reservations WHERE reservations.course_date_id = course_dates.id AND reservations.reservation_id IS NULL)
            AND 
                (from_date BETWEEN \'' . $startOfYear->format('Y-m-d H:i:s') . '\' AND \'' . $endOfYear->format('Y-m-d H:i:s') . '\')';
    
        return DB::select(DB::raw($sqlQuery))[0]->countOfFullCourseDates;
    }
}
