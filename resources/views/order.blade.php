@extends('layouts.app')

@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Order Details</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>

    <body>
        <div class="container mt-4">
            <?php
            //dd($orders);
            ?>
            @foreach ($orders as $order)
                <div class="card mb-3">
                    <div class="card-header">
                        <h4>Adres paczkomatu: {{ $order->address }}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($order->cartInRealisation->cartPositionsInRealisation as $position)
                                <li class="list-group-item">
                                    <strong>Nazwa:</strong> {{ $position->product->name }} <br>
                                    <strong>Ilość:</strong> {{ $position->quantity }} <br>
                                    <strong>Cena:</strong> {{ $position->product->price }} PLN
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
        @role('admin')
        <div class="container mt-4">

            <?php
$orders = App\Models\Order::with('creator')->get();
//dd($orders);
            ?>
            @foreach ($orders as $order)
                <div class="card mb-3">
                    <div class="card-header">
                        <h6>Nazwa użytkownika: {{ $order->creator->name }}</h6>
                        <h6>E-mail: {{ $order->creator->email }}</h6>
                        <h4>Adres paczkomatu: {{ $order->address }}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($order->cartInRealisation->cartPositionsInRealisation as $position)
                                <li class="list-group-item">
                                    <strong>Nazwa:</strong> {{ $position->product->name }} <br>
                                    <strong>Ilość:</strong> {{ $position->quantity }} <br>
                                    <strong>Cena:</strong> {{ $position->product->price }} PLN
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
        @endrole
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
@endsection
