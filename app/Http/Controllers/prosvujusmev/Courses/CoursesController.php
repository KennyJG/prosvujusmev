<?php

namespace App\Http\Controllers\prosvujusmev\Courses;

use App\Http\Controllers\Controller;
use App\prosvujusmev\Courses\Course;
use App\prosvujusmev\Courses\Resources\CourseResource;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function show(Request $request, Course $course)
    {
        return response()->view('courses.show', [
            'course' => json_encode(new CourseResource($course)),
        ]);
    }
}
