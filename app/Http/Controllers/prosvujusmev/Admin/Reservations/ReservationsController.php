<?php

namespace App\Http\Controllers\prosvujusmev\Admin\Reservations;

use App\Http\Controllers\Controller;
use FunFirst\Reservations\Models\Courses\Course;
use FunFirst\Reservations\Models\Courses\CourseDate;
use FunFirst\Reservations\Models\Reservations\Reservation;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->json == true) {
            return response()->json([
                'data' => Reservation::with(['courseDate', 'courseDate.course'])->get(),
            ]);
        }
        return response()->view('admin.reservations.index');
    }

    public function create()
    {
        return response()->view('admin.courses.dates.create', [
            'courses' => Course::all()
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'course_id' => 'required|integer|exists:courses,id',
            'from_date_date' => 'required|date',
            'from_date_time' => 'required',
            'from_date_date' => 'required|date',
            'from_date_time' => 'required',
            'venue' => 'required|string|min:1|max:254',
            'lecturer' => 'required|string|min:1|max:254',
            'limit' => 'required|integer|min:0|max:9999999',
            'description' => 'nullable|string|min:1|max:5000',
        ]);

        CourseDate::create([
            'course_id' => $request->course_id,
            'from_date' => \Carbon\Carbon::createFromDate($request->from_date_date)->setTime(\Carbon\Carbon::parse($request->from_date_time)->hour, \Carbon\Carbon::parse($request->from_date_time)->minute),
            'to_date' => \Carbon\Carbon::createFromDate($request->to_date_date)->setTime(\Carbon\Carbon::parse($request->from_date_time)->hour, \Carbon\Carbon::parse($request->from_date_time)->minute),
            'venue' => $request->venue,
            'lecturer' => $request->lecturer,
            'limit' => $request->limit,
            'description' => $request->description,
        ]);

        return redirect('/admin/course-dates')->with([
            'message' => 'Termín kurzu byl vytvořen.'
        ]);
    }

    public function edit(Request $request, CourseDate $courseDate)
    {
        return response()->view('admin.courses.dates.edit', [
            'courseDate' => $courseDate,
            'courses' => Course::all()
        ]);
    }

    public function update(Request $request, CourseDate $courseDate)
    {
        $this->validate($request, [
            'course_id' => 'required|integer|exists:courses,id',
            'from_date_date' => 'required|date',
            'from_date_time' => 'required',
            'from_date_date' => 'required|date',
            'from_date_time' => 'required',
            'venue' => 'required|string|min:1|max:254',
            'lecturer' => 'required|string|min:1|max:254',
            'limit' => 'required|integer|min:0|max:9999999',
            'description' => 'nullable|string|min:1|max:5000',
        ]);

        $courseDate->update([
            'course_id' => $request->course_id,
            'from_date' => \Carbon\Carbon::createFromDate($request->from_date_date)->setTime(\Carbon\Carbon::parse($request->from_date_time)->hour, \Carbon\Carbon::parse($request->from_date_time)->minute),
            'to_date' => \Carbon\Carbon::createFromDate($request->to_date_date)->setTime(\Carbon\Carbon::parse($request->from_date_time)->hour, \Carbon\Carbon::parse($request->from_date_time)->minute),
            'venue' => $request->venue,
            'lecturer' => $request->lecturer,
            'limit' => $request->limit,
            'description' => $request->description,
        ]);

        return redirect('/admin/course-dates')->with([
            'message' => 'Kurz byl upraven.'
        ]);
    }

    public function destroy(Request $request, Reservation $reservation)
    {
        $reservation->delete();
        return response()->json();
    }
}
