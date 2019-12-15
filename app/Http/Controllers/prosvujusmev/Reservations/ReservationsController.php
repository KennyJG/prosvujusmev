<?php 

namespace App\Http\Controllers\prosvujusmev\Reservations;

use App\Http\Controllers\Controller;
use App\prosvujusmev\Attendees\Attendee;
use App\prosvujusmev\Attendees\AttendeeAddress;
use App\prosvujusmev\Reservations\Reservation;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function index()
    {
        return response()->view('reservations.index');
    }

    public function store(Request $request)
    {
        foreach ($request->reservations as $reservation) {
            $attendee = Attendee::create([
                'first_name' => $reservation['firstName'],
                'last_name' => $reservation['lastName'],
                'email' => $reservation['email'],
                'phone' => $reservation['phone'],
            ]);
            $attendeeAddress = AttendeeAddress::create([
                'country' => $reservation['country'],
                'city' => $reservation['city'],
                'street' => $reservation['street'],
                'zip' => $reservation['zip'],
                'attendee_id' => $attendee->id,
            ]);
            $reservationModel = Reservation::create([
                'course_date_id' => $reservation['courseDateId'],
                'source_type' => 'Slevomat',//$reservation['sourceType'],
                'source_code' => $reservation['sourceCode'],
                'status' => 'Čeká na schválení',
                'attendee_id' => $attendee->id,
            ]);
        }

        return response()->json([]);
    }
}
