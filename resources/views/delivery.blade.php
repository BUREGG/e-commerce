<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Jeśli używasz CSRF w Laravel -->
    <link rel="stylesheet" href="https://geowidget.inpost.pl/inpost-geowidget.css"/>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .widget-container {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        inpost-geowidget {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }
    </style>
    <script src='https://geowidget.inpost.pl/inpost-geowidget.js' defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.addEventListener('onpointselect', (event) => {
                console.log('Event details:', event.detail); // Logowanie danych dla sprawdzenia

                if (event.detail) {
                    const point = event.detail;

                    // Przygotowanie danych do wysłania na serwer
                    const payload = {
                        id: point.name || 'Unknown', // Zakładam, że "name" jest identyfikatorem paczkomatu
                        address: point.address.line1 + ', ' + point.address.line2,
                        city: point.address_details.city,
                        province: point.address_details.province,
                        postcode: point.address.post_code,
                        street: point.address.street,
                        building_number: point.address.building_number,
                        latitude: point.location.latitude,
                        longitude: point.location.longitude,
                        location_type: point.location_type,
                        opening_hours: point.opening_hours,
                        functions: point.functions, // Funkcje dostępne w paczkomacie
                    };

                    // Wyślij dane do serwera
                    fetch('/save-point', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF jeśli wymagane
                        },
                        body: JSON.stringify(payload)
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Success:', data);
                        // Przekierowanie po pomyślnym zapisaniu danych
                        window.location.href = '/pay'; 
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
                } else {
                    console.error('Event details is undefined');
                }
            });
        });
    </script>
</head>
<body>
    <div class="widget-container">
        <inpost-geowidget onpoint="onpointselect" token='{{ $geoWidgetToken }}' language='pl' config='parcelcollect'></inpost-geowidget>
    </div>
</body>
</html>
