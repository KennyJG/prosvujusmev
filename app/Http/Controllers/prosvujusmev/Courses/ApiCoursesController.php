<?php

namespace App\Http\Controllers\prosvujusmev\Courses;

use App\Http\Controllers\Controller;
use App\prosvujusmev\Courses\Course;
use App\prosvujusmev\Courses\Resources\CourseResource;
use Illuminate\Http\Request;

class ApiCoursesController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::query();
        return response()->json([
            'data' => CourseResource::collection($query->get()),
        ]);
    }
}
