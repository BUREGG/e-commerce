<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartStoreRequestForm;
use App\Http\Requests\CartUpdateRequestForm;
use App\Http\Resources\BaseResource;
use App\Models\Cart;
use App\Models\CartPosition;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    /**
     * Koszyk - pozycja - dodaj
     *
     * Uprawnienia: shared__orders__create
     *
     */
    public function store(CartStoreRequestForm $form, Product $product)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $cartPosition = $form->save();
        return redirect()->route('welcome');

    }

    /**
     * Koszyk - pozycja - aktualizuj
     *
     * Uprawnienia: shared__orders__create
     *
     * Endpoint pozwala zaktualizować ilość zamawianych ekspozytorów (tylko dla zamówień nowych ekspozytorów) oraz dodać załączniki i komentarz do pozycji
     *
     *      */
    public function update(CartUpdateRequestForm $form, CartPosition $cartPosition)
    {
        $cart = $form->save();
        return new BaseResource($cart);
    }

    /**
     * Koszyk - pozycja - usuń
     *
     * Uprawnienia: shared__orders__create
     *
     */
    public function destroy(CartPosition $cartPosition):JsonResponse
    {
        $cartPosition->delete();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    public function show()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->with('cartPositions.product')->get();

        return view('cart', ['cart' => $cart]);
    }
}
