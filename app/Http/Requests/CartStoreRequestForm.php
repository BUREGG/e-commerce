<?php

namespace App\Http\Requests;

use App\Models\Cart;
use App\Models\CartPosition;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CartStoreRequestForm extends FormRequest
{
    private ?Product $product;

    public function rules(): array
    {
        $this->product = $this->route('product');
        return [
        ];
    }

    public function save()
    {
        $product = $this->product;
        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id()]
        );

        $cartPosition = CartPosition::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();
        if ($cartPosition) 
        {
            $cartPosition->quantity++;
            $cartPosition->save();
        } else 
        {
            $cartPosition = CartPosition::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }
        return $cartPosition;
    }
}
