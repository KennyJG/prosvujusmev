<?php 

namespace App\Http\Controllers\prosvujusmev;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return response()->view('home');
    }
}