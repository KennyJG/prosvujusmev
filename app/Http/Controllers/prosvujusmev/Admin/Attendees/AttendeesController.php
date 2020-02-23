<?php

namespace App\Http\Controllers\prosvujusmev\Admin\Attendees;

use App\Http\Controllers\Controller;
use App\prosvujusmev\Attendees\Attendee;
use App\prosvujusmev\Reservations\Reservation;
use Illuminate\Http\Request;

class AttendeesController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendee::query();
        if ($request->scopes) {
            foreach ($request->scopes as $scope) {
                $query->$scope();
            }
        }

        $attendees = $query->get();

        if ($request->group_by) {
            $attendees = $this->groupBy($attendees, $request->group_by);
        }

        return response()->json([
            'data' => $attendees
        ]);
    }

    public function groupBy($attendees, $groupBy) 
    {
        switch ($groupBy) {
            case 'venues':
                $groupedByVenues = [];
                foreach ($attendees as $attendee) {
                    $reservations = $attendee->reservations()->where('status', Reservation::STATUS_COMPLETED)->get();
                    foreach ($reservations as $reservation) {
                        $groupedByVenues[$reservation->courseDate->venue][] = $attendee; 
                    }
                }
                return $groupedByVenues;
            default:
                return $attendees;
        }
    }
}
