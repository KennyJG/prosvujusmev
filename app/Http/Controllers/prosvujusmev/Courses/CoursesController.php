<?php

namespace App\Http\Controllers\prosvujusmev\Courses;

use App\Http\Controllers\Controller;
use App\prosvujusmev\Courses\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function show(Request $request, Course $course)
    {
        return response()->view('courses.show', [
            'course' => $course,
        ]);
    }
}
