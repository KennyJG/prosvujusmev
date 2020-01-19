<?php

namespace App\prosvujusmev\Reservations\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PublicReservationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'source_type' => $this->source_type,
            'course' => $this->courseDate->course,
            'courseDate' => $this->courseDate,
            'attendee' => $this->attendee->load('address'),
            'source_code' => $this->source_code,
            'status' => $this->status,
            'statusRecords' => $this->statusRecords()->orderBy('id', 'desc')->get(),
            'queuedReservation' => new PublicReservationResource($this->queuedReservation),
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
        ];
    }
}
