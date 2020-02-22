<?php

namespace App\prosvujusmev\Courses\Collections;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CourseDateRemainingSpotsByMonthsCollection extends ResourceCollection
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
                $groupedCourseDatesByMonthStats[$monthName] = ['all' => 0, 'remaining' => 0];
            }
            $groupedCourseDatesByMonthStats[$monthName]['remaining'] += $courseDate->remaining;
            $groupedCourseDatesByMonthStats[$monthName]['all'] += $courseDate->limit;
        }

        foreach ($groupedCourseDatesByMonthStats as $monthName => $monthStats) {
            $groupedCourseDatesByMonthStats[$monthName]['percent'] = round(($monthStats['remaining'] / $monthStats['all']) * 100, 2);
        }
        return $groupedCourseDatesByMonthStats;
    }

    public function getTotal($groupedCourseDatesByMonthStats)
    {
        $remaining = 0;
        $all = 0;
        foreach ($groupedCourseDatesByMonthStats as $monthStats) {
            $remaining += $monthStats['remaining'];
            $all += $monthStats['all'];
        }
        return [
            'remaining' => $remaining,
            'all' => $all,
            'percent' => round(($remaining / $all) * 100, 2),
        ];
    }
}