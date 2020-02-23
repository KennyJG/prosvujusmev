<?php

namespace App\Http\Controllers\prosvujusmev\Admin\Lecturers;

use App\Http\Controllers\Controller;
use App\prosvujusmev\Courses\CourseDate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LecturersController extends Controller
{
    public function index(Request $request)
    {
        $courseDates = CourseDate::future()->get();
        $lecturers = [];
        foreach ($courseDates as $courseDate) {
            $lecturers[$courseDate->lecturer][] = $courseDate;
        }

        $lecturers = array_map(function ($courseDates) {
            $groupedCourseDates = $this->groupCourseDates($courseDates, 'month');
            return array_map(function($courseDates) {
                return count($courseDates);
            }, $groupedCourseDates);
        }, $lecturers);
        return response()->json([
            'data' => $lecturers
        ]);
    }

    public function groupCourseDates($courseDates, $groupBy)
    {
        switch ($groupBy) {
            case 'weekend':
                $groupedCourseDates = [];
                foreach ($courseDates as $courseDate) {
                    if (!array_key_exists($courseDate->fullDateForHumans, $groupedCourseDates)) {
                        $groupedCourseDates[$courseDate->fullDateForHumans] = [];
                    }
                    $groupedCourseDates[$courseDate->fullDateForHumans][] = $courseDate;
                }
                return $groupedCourseDates;
            case 'lecturer':
                $groupedCourseDates = [];
                foreach ($courseDates as $courseDate) {
                    if (!array_key_exists($courseDate->lecturer, $groupedCourseDates)) {
                        $groupedCourseDates[$courseDate->lecturer] = [];
                    }
                    $groupedCourseDates[$courseDate->lecturer][] = $courseDate;
                }
                return $groupedCourseDates;
            case 'month':
                $groupedCourseDates = [];
                foreach ($courseDates as $courseDate) {
                    $monthName = Carbon::parse($courseDate->from_date)->year . ' '. ucfirst(Carbon::parse($courseDate->from_date)->locale('cs')->monthName);
                    if (!array_key_exists($monthName, $groupedCourseDates)) {
                        $groupedCourseDates[$monthName] = [];
                    }
                    $groupedCourseDates[$monthName][] = $courseDate;
                }
                return $groupedCourseDates;
            default:
                return $courseDates;
        }
    }
}
