<?php

namespace App\Http\Controllers\prosvujusmev;

use App\Http\Controllers\Controller;

class PricesController extends Controller
{
    public function index()
    {
        return response()->view('prices.index');
    }
}
