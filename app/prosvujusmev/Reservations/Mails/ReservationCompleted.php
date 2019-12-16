<?php

namespace App\prosvujusmev\Reservations\Mails;

use App\prosvujusmev\Reservations\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationCompleted extends Mailable
{
    use Queueable, SerializesModels;

    protected $reservation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.reservations.completed', [
            'reservation' => $this->reservation,
        ]);
    }
}
