<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zamówienie</title>
    <link href="{{ asset('css/pay.css') }}" rel="stylesheet">
</head>
<body>
    <div class="form-container">
        <h2>Zamówienie</h2>
        <form action="{{ route('order.store') }}" method="POST">
            @csrf <!-- Dodaj token CSRF, jeśli używasz Laravel -->

            <div class="form-group">
                <label for="address">Adres</label>
                <input type="text" id="address" name="address" value="{{ $point[0]['address'] ?? '' }}">
            </div>

            <div class="form-group">
                <label for="city">Miasto</label>
                <input type="text" id="city" name="city" value="{{ $point[0]['city'] ?? '' }}">
            </div>

            <div class="form-group">
                <label for="province">Województwo</label>
                <input type="text" id="province" name="province" value="{{ $point[0]['province'] ?? '' }}">
            </div>
            <div class="form-group">
                <label for="province">Imie</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="province">Nazwisko</label>
                <input type="text" id="lastname" name="lastname">
            </div>
            <div class="form-group">
                <label for="province">Telefon</label>
                <input type="text" id="phone" name="phone">
            </div>
            <div class="form-group">
                <label for="province">E-mail</label>
                <input type="text" id="email" name="email">
            </div>
            <button type="submit">Przejdź do płatności</button>
        </form>
    </div>
</body>
</html>
