<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
{
    // Udostępnij zmienną $cartCount do wszystkich widoków
    View::composer('*', function ($view) {
        // Sprawdź, czy użytkownik jest zalogowany
        if (Auth::check()) {
            // Pobierz koszyk z bazy danych dla zalogowanego użytkownika
            $cart = Cart::where('user_id', Auth::user()->id)->with('cartPositions')->first();
            
            // Sprawdź, czy koszyk istnieje
            if ($cart) {
                // Oblicz łączną liczbę pozycji w koszyku
                $cartCount = $cart->cartPositions->count();
            } else {
                // Jeśli nie ma koszyka, liczba pozycji wynosi 0
                $cartCount = 0;
            }
        } else {
            $cartCount = 0;
        }

        $view->with('cartCount', $cartCount);
    });
}

}
