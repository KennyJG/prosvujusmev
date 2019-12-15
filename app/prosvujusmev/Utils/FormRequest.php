<?php

namespace App\prosvujusmev\Utils;

use Illuminate\Foundation\Http\FormRequest as HttpFormRequest;

class FormRequest extends HttpFormRequest
{
    public function prepareResponse()
    {
        return [];
    }
}