<?php

namespace App\prosvujusmev\Courses\Events;

use App\prosvujusmev\Courses\CourseDate;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CourseDateSpotFreed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $courseDate;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(CourseDate $courseDate)
    {
        $this->courseDate = $courseDate;
    }
}
