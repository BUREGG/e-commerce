<?php

namespace App\Http\Requests;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\DB;

class OrderStoreRequestForm extends FormRequest
{
    
    public function rules(): array
    {
        return [
            'address' => 'required|string|max:255', 
            'city' => 'required|string|max:100', 
            'province' => 'required|string|max:100', 
            'name' => 'required|string|max:50', 
            'lastname' => 'required|string|max:50', 
            'phone' => 'required|regex:/^[0-9]{9}$/', 
            'email' => 'required|email|max:255', 
        ];
    }
    public function save()
    {
        $cartId = Cart::where('user_id', auth()->id())->get();
        $data = $this->validated();
        $data['cart_id'] = $cartId[0]['id'];
        $data['created_by_user_id'] = auth()->id();
        DB::beginTransaction();
        $order = Order::query()->create($data);
        DB::commit();
        return $order;
    }
}
