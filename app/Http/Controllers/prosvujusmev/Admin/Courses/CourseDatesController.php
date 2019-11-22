<?php

namespace App\Http\Controllers\prosvujusmev\Admin\Courses;

use App\Http\Controllers\Controller;
use FunFirst\Reservations\Models\Courses\Course;
use FunFirst\Reservations\Models\Courses\CourseDate;
use Illuminate\Http\Request;

class CourseDatesController extends Controller
{
    public function index()
    {
        return response()->view('admin.courses.dates.index', [
            'courseDates' => CourseDate::all()
        ]);
    }

    public function create()
    {
        return response()->view('admin.courses.dates.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:1|max:191',
            'description' => 'nullable|string|min:1|max:5000',
        ]);

        Course::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect('/admin/courses')->with([
            'message' => 'Kurz byl vytvořen.'
        ]);
    }

    public function edit(Request $request, Course $course)
    {
        return response()->view('admin.courses.dates.edit', [
            'course' => $course
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $this->validate($request, [
            'name' => 'required|string|min:1|max:191',
            'description' => 'nullable|string|min:1|max:5000',
        ]);

        $course->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect('/admin/courses')->with([
            'message' => 'Kurz byl upraven.'
        ]);
    }

    public function destroy(Request $request, Course $course)
    {
        $course->delete();
        
        return redirect('/admin/courses')->with([
            'message' => 'Kurz byl odstraněn.'
        ]);
    }
}
