<?php

namespace App\prosvujusmev\Courses\Collections;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FullCourseDatesByMonthsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $groupedByMonths = $this->groupedByMonthsStats();
        return [
            'data' => $groupedByMonths,
            'total' => $this->getTotal($groupedByMonths),
        ];
    }

    public function groupedByMonthsStats(): array
    {
        $groupedCourseDatesByMonthStats = [];
        foreach ($this->collection as $courseDate) {
            if (Carbon::parse($courseDate->from_date)->year !== Carbon::now()->year) {
                continue;
            }
            $monthName = ucfirst(Carbon::parse($courseDate->from_date)->locale('cs')->monthName);
            if (!array_key_exists($monthName, $groupedCourseDatesByMonthStats)) {
                $groupedCourseDatesByMonthStats[$monthName] = ['all' => 0, 'full' => 0];
            }

            if ($courseDate->full) {
                $groupedCourseDatesByMonthStats[$monthName]['full']++;
            }
            $groupedCourseDatesByMonthStats[$monthName]['all']++;
        }

        foreach ($groupedCourseDatesByMonthStats as $monthName => $monthStats) {
            $groupedCourseDatesByMonthStats[$monthName]['percent'] = round(($monthStats['full'] / $monthStats['all']) * 100, 2);
        }
  
        return $groupedCourseDatesByMonthStats;
    }

    public function getTotal($groupedCourseDatesByMonthStats)
    {
        $full = 0;
        $all = 0;
        foreach ($groupedCourseDatesByMonthStats as $monthStats) {
            $full += $monthStats['full'];
            $all += $monthStats['all'];
        }
        return [
            'full' => $full,
            'all' => $all,
            'percent' => round(($full / $all) * 100, 2),
        ];
    }
}