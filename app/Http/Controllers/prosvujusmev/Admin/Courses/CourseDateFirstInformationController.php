<?php

namespace App\Http\Controllers\prosvujusmev\Admin\Courses;

use App\Http\Controllers\Controller;
use App\prosvujusmev\Courses\CourseDate;
use App\prosvujusmev\EmailMessages\Repositories\EmailMessageRepository;
use Illuminate\Http\Request;

class CourseDateFirstInformationController extends Controller
{
    public function save(Request $request, CourseDate $courseDate)
    {
        $this->validate($request, [
            'firstInformation' => 'required|string|max:5000',
        ]);

        app(EmailMessageRepository::class)->saveFirstInformation($courseDate, $request->firstInformation);

        return response()->json([
            'success' => true,
        ]);
    }
}
