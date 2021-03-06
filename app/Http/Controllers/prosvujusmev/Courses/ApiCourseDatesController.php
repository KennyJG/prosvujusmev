<?php

namespace App\Http\Controllers\prosvujusmev\Courses;

use App\Http\Controllers\Controller;
use App\prosvujusmev\Courses\CourseDate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiCourseDatesController extends Controller
{
    public function index(Request $request)
    {
        $courseDatesQuery = CourseDate::query();
        if ($request->courseId) {
            $courseDatesQuery->where('course_id', $request->courseId);
        }
        if ($request->status) {
            $courseDatesQuery->where('status', $request->status);
        }
        if ($request->scopes) {
            foreach ($request->scopes as $scope) {
                $courseDatesQuery->$scope();
            }
        }
        $courseDates = $courseDatesQuery->get();

        if ($request->group_by) {
            $courseDates = $this->groupCourseDates($courseDates, $request->group_by);
        }
        return response()->json([
            'data' => $courseDates,
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
