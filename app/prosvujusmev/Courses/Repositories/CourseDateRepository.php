<?php

namespace App\prosvujusmev\Courses\Repositories;

use App\prosvujusmev\Courses\CourseDate;

class CourseDateRepository 
{
    /**
     *  Deletes CourseDate 
     * 
     *  @param \App\prosvujusmev\Courses\CourseDate $courseDate
     *  @return bool
     */
    public function delete(CourseDate $courseDate):bool
    {
        foreach ($courseDate->reservations as $reservation) {
            app(\App\prosvujusmev\Reservations\Repositories\ReservationRepository::class)->delete($reservation);
        }
        return $courseDate->delete();
    }
}