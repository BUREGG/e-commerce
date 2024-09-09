<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequestForm;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(OrderStoreRequestForm $form)
    {
        //dd($form);
        $order = $form->save();
    }
}
