<?php

namespace App\prosvujusmev\Courses\Collections;

use App\prosvujusmev\Courses\CourseDate;
use App\prosvujusmev\Reservations\Reservation;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CourseDatesSpotTakenStatsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $groupedByVenueStats = $this->groupedByVenueStats();
        return [
            'data' => $groupedByVenueStats,
            'total' => $this->getTotal($groupedByVenueStats),
        ];
    }

    public function groupedByVenueStats(): array
    {
        $groupedCourseDatesByVenueStats = [];
        foreach ($this->collection as $courseDate) {
            if (!array_key_exists($courseDate->venue, $groupedCourseDatesByVenueStats)) {
                $groupedCourseDatesByVenueStats[$courseDate->venue] = ['limit' => 0, 'spotsTaken' => 0];
            }
            $groupedCourseDatesByVenueStats[$courseDate->venue]['limit'] += $courseDate->limit;
            $groupedCourseDatesByVenueStats[$courseDate->venue]['spotsTaken'] += $courseDate
                ->reservations()
                ->whereIn('status', [
                    Reservation::STATUS_CREATED,
                    Reservation::STATUS_UNAPPROVED,
                    Reservation::STATUS_APPROVED,
                    Reservation::STATUS_COMPLETED,
                    Reservation::STATUS_CONDITIONED,
                    Reservation::STATUS_SUSPENDED,
                ])->count();
        }

        foreach ($groupedCourseDatesByVenueStats as $venue => $venueStats) {
            $groupedCourseDatesByVenueStats[$venue]['percent'] = round(($venueStats['spotsTaken'] / $venueStats['limit']) * 100, 2);
        }
        return $groupedCourseDatesByVenueStats;
    }

    public function getTotal($groupedCourseDatesByVenueStats)
    {
        $limit = 0;
        $spotsTaken = 0;
        foreach ($groupedCourseDatesByVenueStats as $venueStats) {
            $limit += $venueStats['limit'];
            $spotsTaken += $venueStats['spotsTaken'];
        }
        return [
            'limit' => $limit,
            'spotsTaken' => $spotsTaken,
            'percent' => round(($spotsTaken / $limit) * 100, 2),
        ];
    }
}