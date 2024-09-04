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
                $cart = Cart::where('user_id', Auth::user()->id)->with('cartPositions')->get();
                // Oblicz łączną liczbę pozycji w koszyku
                $cartCount = $cart->first()->cartPositions->count();
            } else {
                $cartCount = 0;
            }

            $view->with('cartCount', $cartCount);
        });
    }
}
