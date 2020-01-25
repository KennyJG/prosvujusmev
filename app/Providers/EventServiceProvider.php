<?php

namespace App\Providers;

use App\prosvujusmev\Courses\Listeners\SendCourseDateAvailableMail;
use App\prosvujusmev\Courses\Events\CourseDateSpotFreed;
use App\prosvujusmev\Reservations\Events\ReservationApproved;
use App\prosvujusmev\Reservations\Events\ReservationCanceled;
use App\prosvujusmev\Reservations\Events\ReservationCompleted;
use App\prosvujusmev\Reservations\Events\ReservationConditioned;
use App\prosvujusmev\Reservations\Events\ReservationCourseDateChanged;
use App\prosvujusmev\Reservations\Events\ReservationCreated;
use App\prosvujusmev\Reservations\Events\ReservationDeleted;
use App\prosvujusmev\Reservations\Events\ReservationRejected;
use App\prosvujusmev\Reservations\Events\ReservationSuspended;
use App\prosvujusmev\Reservations\Events\SubstituteReservationCreated;
use App\prosvujusmev\Reservations\Events\SubstituteReservationHasBecomeFull;
use App\prosvujusmev\Reservations\Listeners\CancelSubstituteReservation;
use App\prosvujusmev\Reservations\Listeners\SendFinalCourseInformationMail;
use App\prosvujusmev\Reservations\Listeners\SendFinalCourseInformationMailToNewReservation;
use App\prosvujusmev\Reservations\Listeners\SendFirstCourseInformationMail;
use App\prosvujusmev\Reservations\Listeners\SendFirstCourseInformationMailToNewReservation;
use App\prosvujusmev\Reservations\Listeners\SendReservationApprovedNotification;
use App\prosvujusmev\Reservations\Listeners\SendReservationCanceledNotification;
use App\prosvujusmev\Reservations\Listeners\SendReservationCompletedNotification;
use App\prosvujusmev\Reservations\Listeners\SendReservationConditionedNotification;
use App\prosvujusmev\Reservations\Listeners\SendReservationCourseDateChanged;
use App\prosvujusmev\Reservations\Listeners\SendReservationCreatedNotification;
use App\prosvujusmev\Reservations\Listeners\SendReservationDeletedNotification;
use App\prosvujusmev\Reservations\Listeners\SendReservationRejectedNotification;
use App\prosvujusmev\Reservations\Listeners\SendReservationSuspendedNotification;
use App\prosvujusmev\Reservations\Listeners\SendSubstituteReservationCreatedNotification;
use App\prosvujusmev\Reservations\Listeners\SendSubstituteReservationHasBecomeFullNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ReservationCreated::class => [
            SendReservationCreatedNotification::class,
            SendFirstCourseInformationMailToNewReservation::class,
            SendFinalCourseInformationMailToNewReservation::class,
        ],
        ReservationApproved::class => [
            SendReservationApprovedNotification::class,
            SendFirstCourseInformationMail::class,
            SendFinalCourseInformationMail::class,
        ],
        ReservationRejected::class => [
            SendReservationRejectedNotification::class,
            SendCourseDateAvailableMail::class,
        ],
        ReservationCompleted::class => [
            SendReservationCompletedNotification::class,
        ],
        ReservationDeleted::class => [
            SendReservationDeletedNotification::class,
        ],
        ReservationConditioned::class => [
            SendReservationConditionedNotification::class,
        ],
        ReservationSuspended::class => [
            SendReservationSuspendedNotification::class,
        ],
        ReservationCourseDateChanged::class => [
            SendReservationCourseDateChanged::class,
            // SendFirstCourseInformationMail::class,
            // SendFinalCourseInformationMail::class,
        ],
        CourseDateSpotFreed::class => [
            SendCourseDateAvailableMail::class,
        ],
        ReservationCanceled::class => [
            SendReservationCanceledNotification::class,
            SendCourseDateAvailableMail::class,
            CancelSubstituteReservation::class,
        ],
        SubstituteReservationHasBecomeFull::class => [
            SendSubstituteReservationHasBecomeFullNotification::class,
        ],
        SubstituteReservationCreated::class => [
            SendSubstituteReservationCreatedNotification::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
