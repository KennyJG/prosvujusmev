<?php

namespace App\Http\Controllers\prosvujusmev\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseDatesController extends Controller
{
    public function index(Request $request)
    {
        return response()->view('course_dates.index');
    }
}
