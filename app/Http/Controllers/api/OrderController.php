<?php

namespace App\Http\Controllers\api;

use App\Events\createOrderEvent;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Respectamos el principio SOLID de responsabilidad única, que nos dice que una clase debe tener una única responsabilidad.
    public function create()
    {
        $order = Order::create([
            'user_id' => 11,
            'amount' => 120
        ]);

        createOrderEvent::dispatch($order);

        return response()->json([
            'message' => 'Order created'
        ]);
    }
}
