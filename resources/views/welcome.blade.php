@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-5">Nasze Produkty</h1>
    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm border-0">
                @if ($product->images->isNotEmpty())
                <img class="card-img-top" src="{{ asset('storage/images/' . $product->images->first()->image) }}" alt="{{ $product->name }}" width="170px"
                                height="270px"
                style="height: 350px; object-fit: cover; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                @else
                <div class="d-flex justify-content-center align-items-center" style="height: 300px; background-color: #f8f9fa; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                    <span class="text-muted">Brak zdjęcia</span>
                </div>
                @endif
                <div class="card-body d-flex flex-column">
                  <h5 class="card-title text-center font-weight-bold">{{ $product->name }}</h5>
                  <p class="card-text text-muted">{{ Str::limit(strip_tags($product->description), 100) }}</p>
                  <div class="mt-auto text-center">
                    <a href="#" class="btn btn-primary">Dodaj do koszyka</a>
                  </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
