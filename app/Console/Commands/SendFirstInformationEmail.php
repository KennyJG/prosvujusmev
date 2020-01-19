<?php

namespace App\Console\Commands;

use App\prosvujusmev\Courses\CourseDate;
use App\prosvujusmev\Courses\Repositories\CourseDateRepository;
use Illuminate\Console\Command;

class SendFirstInformationEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'course-dates:send-first-information-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends email to all attendees of course dates that will happen in 14 days.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $from = \Carbon\Carbon::parse('+14 days');
        $from->hour = 0;
        $from->minute = 0;
        $from->second = 0;

        $to = \Carbon\Carbon::parse('+14 days');
        $to->hour = 23;
        $to->minute = 59;
        $to->second = 59;

        $courseDates = CourseDate::whereBetween('from_date', [$from, $to])->get();

        foreach ($courseDates as $courseDate) {
            app(CourseDateRepository::class)->sendFirstInformationEmail($courseDate);
        }
    }
}
