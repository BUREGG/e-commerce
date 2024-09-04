<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartPositionStoreRequestForm;
use App\Http\Requests\CartPositionUpdateRequestForm;
use App\Http\Resources\BaseResource;
use App\Models\CartPosition;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CartPositionController extends Controller
{
       /**
     * Zamówienie - pozycje zamówienia - dodaj
     *
     * Uprawnienia: admin__orders__update
     *
     */
    public function store(Order $order, CartPositionStoreRequestForm $form)
    {
        $cart = $form->save();
        return new BaseResource($cart);
    }

    /**
     * Zamówienia - pozycje zamówienia - aktualizuj
     *
     * Uprawnienia: admin__orders__update
     *
     * Endpoint pozwala zaktualizować ilość zamawianych ekspozytorów (tylko dla zamówień nowych ekspozytorów)
     */
    public function update(Request $request, CartPosition $cartPosition)
    {
        $quantity = $request->input('quantity');
        if ($quantity <= 0) {
            return redirect()->back()->with('error', 'Ilość musi być większa niż 0.');
        }
        $cartPosition->update(['quantity' => $quantity]);
        return redirect()->back()->with('success', 'Ilość została zaktualizowana.');
    }

    /**
     * Zamówienia - pozycje zamówienia - usuń
     *
     * Uprawnienia: admin__orders__update
     *
     */
    public function destroy(CartPosition $cartPosition)
    {
        $cartPosition->delete();
        return redirect()->back()->with('success', 'Produkt został usunięty z koszyka.');
    }
}
