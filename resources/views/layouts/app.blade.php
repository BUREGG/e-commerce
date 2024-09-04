<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/homepage.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-custom">
    <a class="navbar-brand" href="{{ route('welcome') }}">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex align-items-center" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('welcome') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Disabled</a>
            </li>
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="#">Dashboard</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Logowanie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Rejestracja</a>
                </li>
            @endauth
            @role('admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('permissions') ? 'fw-bold' : '' }}" href="{{ route('product.create') }}">Dodaj produkt</a>
                </li>
            @endrole
        </ul>
        @auth
            <div class="d-flex align-items-center ms-3">
                <!-- Koszyk -->
                <a class="nav-link" href="{{ route('cart.show') }}">
                    <i class="fas fa-shopping-cart"></i>
                    @if ($cartCount > 0)
                        <span class="badge bg-danger">{{ $cartCount }}</span>
                    @endif
                </a>
                <div class="logout-wrapper ms-3">
                    <span class="navbar-text me-2">
                        Zalogowany jako: {{ auth()->user()->name }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light">Wyloguj się</button>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9t+zO4l6bR8y9Pz4xox5iFSABbo68l9qqoJQH86MgG8jpF+r4ZB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-sYUszX2IhbS1ZG7z0YfSFFPpMCh7c1Oo8rAoE28f7H07iZaPp9AbX1J7LPuKzOqO3" crossorigin="anonymous"></script>
</body>
</html>
