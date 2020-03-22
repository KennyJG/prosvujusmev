<?php

namespace App\prosvujusmev\Courses\Resources;

use App\prosvujusmev\Courses\CourseDate;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'courseDates' => $this->dates()->where('status', CourseDate::STATUS_ACTIVE)->get(),
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
        ];
    }
}
