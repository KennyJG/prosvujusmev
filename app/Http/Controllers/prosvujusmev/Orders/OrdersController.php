<?php 

namespace App\Http\Controllers\prosvujusmev\Orders;

use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function index()
    {
        return response()->view('orders.index');
    }
}
