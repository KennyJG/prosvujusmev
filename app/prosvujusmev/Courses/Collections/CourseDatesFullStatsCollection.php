<?php

namespace App\prosvujusmev\Courses\Collections;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CourseDatesFullStatsCollection extends ResourceCollection
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
                $groupedCourseDatesByVenueStats[$courseDate->venue] = ['all' => 0, 'full' => 0];
            }

            if ($courseDate->full) {
                $groupedCourseDatesByVenueStats[$courseDate->venue]['full']++;
            }
            $groupedCourseDatesByVenueStats[$courseDate->venue]['all']++;
        }

        foreach ($groupedCourseDatesByVenueStats as $venue => $venueStats) {
            $groupedCourseDatesByVenueStats[$venue]['percent'] = round(($venueStats['full'] / $venueStats['all']) * 100, 2);
        }
        return $groupedCourseDatesByVenueStats;
    }

    public function getTotal($groupedCourseDatesByVenueStats)
    {
        $full = 0;
        $all = 0;
        foreach ($groupedCourseDatesByVenueStats as $venueStats) {
            $full += $venueStats['full'];
            $all += $venueStats['all'];
        }
        return [
            'full' => $full,
            'all' => $all,
            'percent' => round(($full / $all) * 100, 2),
        ];
    }
}