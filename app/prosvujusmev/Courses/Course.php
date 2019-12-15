<?php

namespace App\prosvujusmev\Courses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $table = 'courses';

    protected $fillable = [
        'name',
        'description',
    ];

    public function dates()
    {
        return $this->hasMany(\App\prosvujusmev\Courses\CourseDate::class);
    }
}
