<?php

namespace App\Http\Controllers\prosvujusmev\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->view('admin.dashboard');
    }
}
