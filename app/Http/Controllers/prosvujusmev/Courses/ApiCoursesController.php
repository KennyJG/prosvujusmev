<?php

namespace App\Http\Controllers\prosvujusmev\Courses;

use App\Http\Controllers\Controller;
use App\prosvujusmev\Courses\Course;
use Illuminate\Http\Request;

class ApiCoursesController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::all();
        return response()->json([
            'data' => $courses,
        ]);
    }
}
