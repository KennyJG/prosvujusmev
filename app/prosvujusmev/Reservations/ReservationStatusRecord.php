<?php

namespace App\prosvujusmev\Reservations;

use Illuminate\Database\Eloquent\Model;

class ReservationStatusRecord extends Model
{
    protected $table = 'reservation_status_records';

    protected $fillable = [
        'reservation_id',
        'old_status',
        'new_status',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}