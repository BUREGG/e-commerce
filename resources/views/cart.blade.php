@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-5">Twój Koszyk</h1>

        @if(count($cart) > 0)
            @php
                $totalPrice = 0;
            @endphp

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <table class="table table-bordered table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Produkt</th>
                                <th>Ilość</th>
                                <th>Cena</th>
                                <th>Łącznie</th>
                                <th>Akcje</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart->first()->cartPositions as $item)
                                @php
                                    $itemTotal = $item->quantity * $item->product->price;
                                    $totalPrice += $itemTotal;
                                @endphp
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <form action="{{ route('cart.update', ['cartPosition' => $item]) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                                                <button type="submit" class="btn btn-secondary btn-sm" {{ $item->quantity <= 1 ? 'disabled' : '' }}>-</button>
                                            </form>
                                            <span class="mx-2">{{ $item->quantity }}</span>
                                            <form action="{{ route('cart.update', ['cartPosition' => $item]) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                                <button type="submit" class="btn btn-primary btn-sm">+</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>{{ $item->product->price }} PLN</td>
                                    <td>{{ $itemTotal }} PLN</td>
                                    <td>
                                        <form action="{{ route('cart.destroy', ['cartPosition' => $item]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Usuń</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="summary-box mt-4 p-3 bg-light border rounded shadow-sm">
                        <h3>Podsumowanie</h3>
                        <p><strong>Łączny koszt:</strong> {{ $totalPrice }} PLN</p>
                        <a href="{{ route('inpost.show') }}" class="btn btn-primary mt-3">Przejdź do dostawy</a>
                    </div>
                </div>
            </div>
        @else
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <p>Twój koszyk jest pusty.</p>
                </div>
            </div>
        @endif
    </div>
@endsection
