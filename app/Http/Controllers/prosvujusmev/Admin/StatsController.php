<?php

namespace App\Http\Controllers\prosvujusmev\Admin;

use App\Http\Controllers\Controller;
use App\prosvujusmev\Courses\Collections\CourseDatesFullStatsCollection;
use App\prosvujusmev\Courses\Collections\CourseDatesSpotTakenStatsCollection;
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
        return response()->json([
            'data' => [
                'countOfCourseDatesThisMonth' => $this->getCountOfCourseDatesOfThisMonth(),
                'countOfCourseDatesThisYear' => $this->getCountOfCourseDatesOfThisYear(),
                'countOfCourseDatesInProgress' => $this->getCountOfCourseDatesInProgress(),
                'countOfFullCourseDatesThisMonth' => $this->getCountOfFullCourseDatesThisMonth(),
                'countOfFullCourseDatesThisYear' => $this->getCountOfFullCourseDatesThisYear(),
                'countOfCompletedCourseDatesThisMonth' => $this->getCountOfCompletedCourseDatesThisMonth(),
                'countOfCompletedCourseDatesThisYear' => $this->getCountOfCompletedCourseDatesThisYear(),

                'waitingForApprovementReservations' => Reservation::where('status', Reservation::STATUS_UNAPPROVED)->get(),
                'queuedReservations' => Reservation::where('status', Reservation::STATUS_QUEUED)->get(),

                'spotTakenCourseDateStatsThisMonth' => new CourseDatesSpotTakenStatsCollection($this->getCourseDatesOfThisMonth()),
                'spotTakenCourseDateStatsThisYear' => new CourseDatesSpotTakenStatsCollection($this->getCourseDatesOfThisYear()),
                
                'fullCourseDatesStatsThisMonth' => new CourseDatesFullStatsCollection($this->getCourseDatesOfThisMonth()),
                'fullCourseDatesStatsThisYear' => new CourseDatesFullStatsCollection($this->getCourseDatesOfThisYear()),
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

    /**
     *  Return count of Course Dates that are already completed this month
     * 
     *  @return int 
     */
    private function getCountOfCompletedCourseDatesThisMonth(): int 
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        return CourseDate::whereBetween('from_date', [
                $startOfMonth,
                $endOfMonth
            ])->where('status', CourseDate::STATUS_COMPLETED)
            ->count();
    }

    /**
     *  Return count of Course Dates that are already completed this year
     * 
     *  @return int 
     */
    private function getCountOfCompletedCourseDatesThisYear(): int 
    {
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();

        return CourseDate::whereBetween('from_date', [
                $startOfYear,
                $endOfYear
            ])->where('status', CourseDate::STATUS_COMPLETED)
            ->count();
    }

    /**
     *  Return Course Dates that happening this month
     * 
     *  @return \Illuminate\Database\Eloquent\Collection 
     */
    private function getCourseDatesOfThisMonth(): Collection 
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        return CourseDate::whereBetween('from_date', [
                $startOfMonth,
                $endOfMonth
            ])->get();
    }

    /**
     *  Return Course Dates that happening this year
     * 
     *  @return \Illuminate\Database\Eloquent\Collection 
     */
    private function getCourseDatesOfThisYear(): Collection 
    {
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();
        return CourseDate::whereBetween('from_date', [
            $startOfYear,
            $endOfYear
        ])->get();
    }
}
