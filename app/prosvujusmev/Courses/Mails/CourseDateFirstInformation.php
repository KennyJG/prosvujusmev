<?php

namespace App\prosvujusmev\Courses\Mails;

use App\prosvujusmev\Courses\CourseDate;
use App\prosvujusmev\EmailMessages\Repositories\EmailMessageRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CourseDateFirstInformation extends Mailable
{
    use Queueable, SerializesModels;

    protected $courseDate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CourseDate $courseDate)
    {
        $this->courseDate = $courseDate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mailMessage = app(EmailMessageRepository::class)->getFirstInformation($this->courseDate);
        if ($mailMessage) {
            return $this->view('mails.courses.first_information', [
                'text' => json_decode($mailMessage->data)->text,
            ]);
        } else {
            return $this->view('mails.courses.default_first_information', [
                'courseDate' => $this->courseDate,
            ]);
        }
    }
}
