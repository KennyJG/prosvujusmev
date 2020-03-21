<?php

namespace App\Http\Controllers\prosvujusmev;

use App\Http\Controllers\Controller;

class ContactsController extends Controller
{
    public function index()
    {
        return response()->view('contacts.index');
    }
}
