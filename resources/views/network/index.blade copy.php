<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <style>
        .text-center {
            text-align: center;
        }

        #map {
            width: 600px;
            height: 600px;
        }

    </style>
    <link rel='stylesheet' href='https://unpkg.com/leaflet@1.8.0/dist/leaflet.css' crossorigin='' />
</head>

<body>
    <h1 class='text-center'>Laravel Leaflet Maps</h1>
    <div id='map'></div>

    <input type='text' id='latitude' name='latitude'>
    <input type='text' id='longitude' name='longitude'>

    <script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>
    <script>
        let map, marker;
        /* ----------------------------- Initialize Map ----------------------------- */
        function initMap() {
            map = L.map('map', {
                center: {
                    lat: -7.302458165537493
                    , lng: 112.67739816342004
                , }
                , zoom: 15
            });


            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);




        }
        initMap();

        let baseLine = L.icon({
            iconUrl: '{{ asset("assets/img/base-station-line.png") }}',

            iconSize: [40, 40], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62], // the same for the shadow
            popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
        });

        L.marker([-7.302458165537493, 112.67739816342004], {
            icon: baseLine
        }).bindPopup('<h2>HALO</h2>').addTo(map);

        map.on('click', function(e) {
            if (marker != null) {
                map.removeLayer(marker);
            }
            marker = new L.marker(e.latlng).bindPopup('Hi There! lat').addTo(map);
            document.getElementById('latitude').value = e.latlng.lat;
            document.getElementById('longitude').value = e.latlng.lng;
        });
        /* --------------------------- Initialize Markers --------------------------- */

    </script>
</body>

</html>
