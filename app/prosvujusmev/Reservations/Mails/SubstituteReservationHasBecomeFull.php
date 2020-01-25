<?php

namespace App\prosvujusmev\Reservations\Mails;

use App\prosvujusmev\Reservations\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubstituteReservationHasBecomeFull extends Mailable
{
    use Queueable, SerializesModels;

    protected $reservation;
    protected $oldMainReservation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Reservation $reservation, Reservation $oldMainReservation)
    {
        $this->reservation = $reservation;
        $this->oldMainReservation = $oldMainReservation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.reservations.has-become-full', [
            'reservation' => $this->reservation,
            'oldMainReservation' => $this->oldMainReservation,
        ]);
    }
}
