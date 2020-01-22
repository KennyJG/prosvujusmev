<?php

namespace App\prosvujusmev\Courses\Listeners;

use App\prosvujusmev\Courses\Mails\CourseDateSpotFreed;
use App\prosvujusmev\Courses\Repositories\CourseDateRepository;

class SendCourseDateAvailableMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param mixed $event
     * @return void
     */
    public function handle($event)
    {
        if (property_exists($event, 'courseDate')) {
            $courseDate = $event->courseDate;
        }
        if (property_exists($event, 'reservation')) {
            $courseDate = $event->reservation->courseDate;
        }
        if ($courseDate && $courseDate->remaining == 1) {
            app(CourseDateRepository::class)->sendEmailToSubstitutes($courseDate, new CourseDateSpotFreed($courseDate));
        }
    }
}