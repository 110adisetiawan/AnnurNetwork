@push('custom-scripts-map')
<style>
    .text-center {
        text-align: center;
    }

    #map {
        width: 1100px;
        height: 550px;
    }

</style>
<link rel='stylesheet' href='https://unpkg.com/leaflet@1.8.0/dist/leaflet.css' crossorigin='' />
@endpush

@extends('../layout')


@section('content')
<div class="card mb-6">
    <h5 class="card-header">MAPS Devices</h5>
    <div class="card-body">
        <div id='map'></div>
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
                lat: -7.302458165537493
                , lng: 112.67739816342004
            , }
            , zoom: 14
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

    @foreach ($networks as $network)

    L.marker([{{$network->latitude}}, {{ $network->longitude }}], {
        icon: baseLine
    }).bindPopup('<h6 class="text-nowrap text-heading">Nama Device : {{ $network->nama_device }}</h6></br><h6 class="text-nowrap text-heading">IP Address : {{ $network->ip_address }}</h6></br><h6 class="text-nowrap text-heading">Status Device : @if($network->status == 'active')<span class="badge rounded-pill bg-label-success me-1">Active</span> @elseif($network->status == 'offline')<span class="badge rounded-pill bg-label-danger me-1">Offline</span> @elseif($network->status == 'rusak')<span class="badge rounded-pill bg-label-dark me-1">Rusak</span> @endif</h6></br><a href="{{ route('network.edit', $network->id) }}" class="btn btn-warning">Edit</a>').addTo(map);

    @endforeach
    /* --------------------------- Initialize Markers --------------------------- */

</script>

@endsection
