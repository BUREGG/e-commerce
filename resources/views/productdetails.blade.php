@extends('layouts.app')

@section('content')
<head>
    <link href="{{ asset('css/productdetails.css') }}" rel="stylesheet">
</head>
<div class="container my-5">
    <h1 class="text-center">{{ $product->name }}</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="product-images">
                @foreach ($product->images as $item)
                    <img src="{{ asset('storage/images/' . $item->image) }}" alt="Zdjęcie produktu" class="img-fluid">
                @endforeach
            </div>
        </div>
        <div class="col-md-6">
            <h2 class="price">Cena: {{ $product->price }} PLN</h2>
            <p class="description">Opis produktu: {!! $product->description !!}</p>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center flex-wrap gap-2">
    <a href="{{ route('cart.store', ['product' => $product ]) }}" class="btn btn-primary">Dodaj do koszyka</a>
</div>
@endsection
