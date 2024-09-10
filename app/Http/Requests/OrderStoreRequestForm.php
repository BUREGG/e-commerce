<?php

namespace App\Http\Requests;

use App\Models\Cart;
use App\Models\CartPosition;
use App\Models\CartPositionInRealisation;
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
        $cart = Cart::find($cartId)->first();
        $cartInRealisation = $cart->replicate();
        $cartInRealisation->setTable('cart_in_realisations');
        $cartInRealisation->save();
        $positions = CartPosition::where('cart_id', $cartId[0]['id'])->get();
        foreach ($positions as $position) {
            $positionInRelisation = new CartPositionInRealisation();
            $positionInRelisation->cart_in_realisation_id = $position['cart_id'];
            $positionInRelisation->product_id = $position['product_id'];
            $positionInRelisation->quantity = $position['quantity'];
            $positionInRelisation->save();
        }
        $data = $this->validated();
        $data['cart_in_realisation_id'] = $cartId[0]['id'];
        $data['created_by_user_id'] = auth()->id();
        DB::beginTransaction();
        $order = Order::query()->create($data);
        Cart::where('user_id', auth()->id())->delete();
        DB::commit();
        return $order;
    }
}
