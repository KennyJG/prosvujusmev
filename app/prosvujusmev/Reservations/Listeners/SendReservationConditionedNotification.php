<?php

namespace App\prosvujusmev\Reservations\Listeners;

use App\prosvujusmev\Reservations\Events\ReservationConditioned;
use App\prosvujusmev\Reservations\Mails\ReservationConditioned as MailsReservationConditioned;

class SendReservationConditionedNotification
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
     * @param  \App\prosvujusmev\Reservations\Events\ReservationConditioned $event
     * @return void
     */
    public function handle(ReservationConditioned $event)
    {
        $reservation = $event->reservation;
        $attendee = $reservation->attendee;
        \Mail::to($attendee)->send(new MailsReservationConditioned($reservation));
    }
}