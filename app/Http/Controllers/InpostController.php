<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class InpostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Walidacja danych
        $validatedData = $request->validate([
            'id' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'location_type' => 'nullable|string',
            'opening_hours' => 'nullable|string',
            'functions' => 'nullable|array'
        ]);

        // Pobierz identyfikator użytkownika
        $userId = Auth::id();

        // Sprawdź, czy istnieje rekord dla danego użytkownika
        $point = Point::where('user_id', $userId)->first();

        if ($point) {
            // Zaktualizuj istniejący rekord
            $point->update(array_merge($validatedData, [
                'functions' => json_encode($validatedData['functions'])
            ]));
        } else {
            // Stwórz nowy rekord
            $point = new Point($validatedData);
            $point->user_id = $userId;
            $point->functions = json_encode($validatedData['functions']);
            $point->save();
        }

        return response()->json(['success' => true]);
    }



    /**
     * Display the specified resource.
     */
    public function show()
    {
        $geoWidgetToken = env('GEO_WIDGET_TOKEN');
        return view('delivery', ['geoWidgetToken' => $geoWidgetToken]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
