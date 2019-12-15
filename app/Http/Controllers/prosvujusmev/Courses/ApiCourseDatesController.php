<?php

namespace App\Http\Controllers\prosvujusmev\Courses;

use App\Http\Controllers\Controller;
use App\prosvujusmev\Courses\CourseDate;
use Illuminate\Http\Request;

class ApiCourseDatesController extends Controller
{
    public function index(Request $request)
    {
        $courseDatesQuery = CourseDate::query();
        if ($request->courseId) {
            $courseDatesQuery->where('course_id', $request->courseId);
        }
        return response()->json([
            'data' => $courseDatesQuery->get(),
        ]);
    }
}
