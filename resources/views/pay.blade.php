<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Page</title>
</head>
<body>
    <form action="/save-point" method="POST">
        @csrf <!-- Dodaj token CSRF, jeśli używasz Laravel -->

        <input type="hidden" id="id" name="id" value="{{ $pointData['id'] ?? '' }}">
        <input type="text" id="address" name="address" value="{{ $pointData['address'] ?? '' }}">
        <input type="text" id="city" name="city" value="{{ $pointData['city'] ?? '' }}">
        <input type="text" id="province" name="province" value="{{ $pointData['province'] ?? '' }}">
        <input type="text" id="postcode" name="postcode" value="{{ $pointData['postcode'] ?? '' }}">
        <input type="text" id="street" name="street" value="{{ $pointData['street'] ?? '' }}">
        <input type="text" id="building_number" name="building_number" value="{{ $pointData['building_number'] ?? '' }}">
        <input type="text" id="latitude" name="latitude" value="{{ $pointData['latitude'] ?? '' }}">
        <input type="text" id="longitude" name="longitude" value="{{ $pointData['longitude'] ?? '' }}">
        <input type="text" id="location_type" name="location_type" value="{{ $pointData['location_type'] ?? '' }}">
        <input type="text" id="opening_hours" name="opening_hours" value="{{ $pointData['opening_hours'] ?? '' }}">
        <!-- Dodaj inne pola formularza, jeśli potrzebujesz -->
        <button type="submit">Submit</button>
    </form>
</body>
</html>
