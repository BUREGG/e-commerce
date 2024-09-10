<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequestForm;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(OrderStoreRequestForm $form)
    {
        $order = $form->save();
    }
    public function show()
    {
       $orders = Order::where('created_by_user_id', auth()->id())->with('cartInRealisation.cartPositionsInRealisation.product')->get();
       return view('order', ['orders' => $orders]);
    }
}
