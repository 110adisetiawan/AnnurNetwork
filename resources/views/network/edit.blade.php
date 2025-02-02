@push('custom-scripts-map')
<style>
    .text-center {
        text-align: center;
    }

    #map {
        width: 750px;
        height: 450px;
    }

</style>
<link rel='stylesheet' href='https://unpkg.com/leaflet@1.8.0/dist/leaflet.css' crossorigin='' />
@endpush

@extends('../layout')
@section('content')

<div class="card mb-6" style="height: 80%">
    <h5 class="card-header">Edit Device</h5>
    <!-- Checkboxes and Radios -->
    <div class="row row-bordered g-0">
        <div class="col-4 p-6">
            <form action=" {{ route('network.update',$network->id) }}" method="post">
                @csrf
                @method('put')
                <small class="text-light fw-medium">Device</small>
                <div class="form-floating form-floating-outline mb-6 mt-4">
                    <input type="text" class="form-control" id="basic-default-fullname" value="{{ $network->nama_device }}" placeholder="HIOSO / CDATA / MIKROTIK" name="nama_device" required>
                    <label for="basic-default-fullname">Nama Device</label>
                </div>
                <div class="form-floating form-floating-outline mb-6 mt-4">
                    <input type="text" class="form-control" id="basic-default-fullname" value="{{ $network->serial_number }}" placeholder="XXX XXX XXX" name="serial_number" required>
                    <label for="basic-default-fullname">Serial Number</label>
                </div>
                <div class="form-floating form-floating-outline mb-6 mt-4">
                    <input type="text" class="form-control" id="basic-default-fullname" value="{{ $network->ip_address }}" placeholder="192.168.x.x" name="ip_address" required>
                    <label for="basic-default-fullname">IP Address</label>
                </div>
                <div class="form-floating form-floating-outline mb-6 mt-4">
                    <input type="text" class="form-control" id="latitude" value="{{ $network->latitude }}" placeholder="-9 7872988" name="latitude" required>
                    <label for="basic-default-fullname">Latitude</label>
                </div>
                <div class="form-floating form-floating-outline mb-6 mt-4">
                    <input type="text" class="form-control" id="longitude" value="{{ $network->longitude }}" placeholder="-7 9828761" name="longitude" required>
                    <label for="basic-default-fullname">Longitude</label>
                </div>
                @error('status')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline">
                    <select id="country" class="select2 form-select" name="status">
                        <option @if($network->status == 'active') selected @endif value="active">active</option>
                        <option @if($network->status == 'offline') selected @endif value="offline">offline</option>
                        <option @if($network->status == 'rusak') selected @endif value="rusak">rusak</option>
                    </select>
                    <label for="country">Status</label>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
            </form>

        </div>
        <div class="col-md p-6">
            <small class="text-light fw-medium">Maps</small>
            <div class="defaultFormControlInput mt-4">
                <div id='map'></div>
            </div>
        </div>
    </div>
    <hr class="m-0">
    <!-- Inline Checkboxes -->
</div>
</div>

{{-- LeafletJS  --}}
<script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>
<script>
    let map, marker;
    /* ----------------------------- Initialize Map ----------------------------- */
    function initMap() {
        map = L.map('map', {
            center: {
                lat: {{ $network->latitude }}
                , lng: {{ $network->longitude }}
            , }
            , zoom: 15
        });

        var Stadia_AlidadeSatellite = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_satellite/{z}/{x}/{y}{r}.{ext}', {
            minZoom: 0
            , maxZoom: 20
            , attribution: '&copy; CNES, Distribution Airbus DS, © Airbus DS, © PlanetObserver (Contains Copernicus Data) | &copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            , ext: 'jpg'
        }).addTo(map);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        });




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

    marker = L.marker([{{ $network->latitude }},{{ $network->longitude }}]).addTo(map);

    map.on('click', function(e) {
        if (marker != null) {
            map.removeLayer(marker);
        }
        marker = new L.marker(e.latlng).bindPopup('Hi There! lat').addTo(map);
        console.log(e.latlng);
        document.getElementById('latitude').value = e.latlng.lat;
        document.getElementById('longitude').value = e.latlng.lng;
    });
    /* --------------------------- Initialize Markers --------------------------- */

</script>

@endsection
