<?php

namespace App\prosvujusmev\Reservations\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'course' => $this->courseDate->course,
            'courseDate' => $this->courseDate,
            'attendee' => $this->attendee->load('address'),
            'source_type' => $this->source_type,
            'source_code' => $this->source_code,
            'status' => $this->status,
            'statusRecords' => $this->statusRecords()->orderBy('id', 'desc')->get(),
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
        ];
    }
}
