<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayController extends Controller
{
    public function show()
    {
        $point = Point::where('user_id', Auth::id())->get();
        return view('pay', ['point' => $point]);
    }
}
