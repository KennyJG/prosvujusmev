<?php

namespace App\prosvujusmev\Attendees\Repositories;

use App\prosvujusmev\Attendees\Attendee;

class AttendeeRepository 
{
    /**
     *  Deletes Attendee
     * 
     *  @param App\prosvujusmev\Attendees\Attendee $attendee
     *  @return bool
     */
    public function delete(Attendee $attendee): bool
    {
        foreach ($attendee->addresses as $address) {
            $attendee->delete();
        }
        return $attendee->delete();
    }
}