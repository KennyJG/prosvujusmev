<?php

namespace App\Http\Controllers\prosvujusmev\Reservations;

use App\Http\Controllers\Controller;
use App\prosvujusmev\Courses\Events\CourseDateSpotFreed;
use App\prosvujusmev\Reservations\Events\ReservationCourseDateChanged;
use App\prosvujusmev\Reservations\Repositories\ReservationRepository;
use App\prosvujusmev\Reservations\Reservation;
use App\prosvujusmev\Reservations\Resources\PublicReservationResource;
use App\Rules\AvailableCourseDate;
use Illuminate\Http\Request;

class ApiPublicReservationsController extends Controller
{
    public function show(Request $request, Reservation $publicReservation)
    {
        return [
            'data' => new PublicReservationResource($publicReservation),
        ];
    }

    public function update(Request $request, Reservation $publicReservation)
    {
        $this->validate($request, [
            'courseDateId' => ['required', new AvailableCourseDate],
        ]);

        $oldCourseDate = $publicReservation->courseDate;
        $now = \Carbon\Carbon::now();
        $startOfCourse = \Carbon\Carbon::parse($oldCourseDate->from_date);
        abort_if($startOfCourse->diffInDays($now) < 4, 401);

        $publicReservation->update([
            'course_date_id' => $request->courseDateId
        ]);

        event(new ReservationCourseDateChanged($publicReservation->fresh()));
        
        if ($oldCourseDate->fresh()->remaining == 1) {
            event(new CourseDateSpotFreed($oldCourseDate->fresh()));
        }
        return response()->json([
            'data' => new PublicReservationResource($publicReservation->fresh()),
        ]);
    }

    public function cancel(Request $request, Reservation $publicReservation)
    {
        app(ReservationRepository::class)->cancel($publicReservation);
        return response()->json([
            'data' => new PublicReservationResource($publicReservation->fresh()),
        ]);
    }
}
