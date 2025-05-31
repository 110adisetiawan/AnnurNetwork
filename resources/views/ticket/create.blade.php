@push('custom-scripts-map')
<style>
    .text-center {
        text-align: center;
    }

    #map {
        width: auto;
        height: 400px;
    }

</style>
<link rel='stylesheet' href='https://unpkg.com/leaflet@1.8.0/dist/leaflet.css' crossorigin='' />
@endpush
@extends('../layout')
@section('content')
<div class="col-md-6">
    <div class="card">
        <h1 class="card-header">Tambah Ticket</h1>
        <div class="card-body">
            <form action=" {{ route('ticket.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @error('user_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <select id="country" class="select2 form-select" name="user_id">
                        <option value="">Pilih Karyawan</option>
                        @foreach ($karyawans as $karyawan)
                        @if($karyawan->hasRole('Administrator')) @continue @endif
                        <option value="{{ $karyawan->id }}">{{ $karyawan->name }}</option>
                        @endforeach
                    </select>
                    <label for="country">Nama Karyawan</label>
                </div>
                @error('task_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <select id="country" class="select2 form-select" name="task_id">
                        <option value="">Pilih Pekerjaan</option>
                        @foreach ($tasks as $task)
                        <option value="{{ $task->id }}">{{ $task->nama_tugas }}</option>
                        @endforeach
                    </select>
                    <label for="country">Pilih Pekerjaan</label>
                </div>
                @error('priority_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <select id="country" class="select2 form-select" name="priority_id">
                        <option value="">Pilih Prioritas</option>
                        @foreach ($priorities as $priority)
                        <option value="{{ $priority->id }}">{{ $priority->nama_prioritas }}</option>
                        @endforeach
                    </select>
                    <label for="country">Prioritas</label>
                </div>
                @error('sla_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <select id="country" class="select2 form-select" name="sla_id">
                        <option value="">Pilih SLA</option>
                        @foreach ($sla as $sla)
                        <option value="{{ $sla->id }}">{{ $sla->nama_sla }}</option>
                        @endforeach
                    </select>
                    <label for="country">SLA</label>
                </div>
                @error('customer_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="Pak RT" name="customer_name" value="{{ old('customer_name') }}">
                    <label for="basic-default-fullname">Nama Customer</label>
                </div>
                @error('customer_address')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="Jl.xx xx" name="customer_address" value="{{ old('customer_address') }}">
                    <label for="basic-default-fullname">Alamat Customer</label>
                </div>
                @error('image_address')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-6">
                    <label for="formFile" class="form-label">Upload Foto Lokasi</label>
                    <input class="form-control" type="file" id="formFile" name="image_address">
                </div>

        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card">
        <h1 class="card-header"></h1>
        <div class="card-body">
            @error('latitude_ticket')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-floating form-floating-outline mb-6">
                <input type="text" class="form-control" id="latitude_ticket" placeholder="-9 7872988" name="latitude_ticket">
                <label for="basic-default-fullname">Latitude Customer</label>
            </div>
            @error('longitude_ticket')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-floating form-floating-outline mb-6">
                <input type="text" class="form-control" id="longitude_ticket" placeholder="-7 9828761" name="longitude_ticket">
                <label for="basic-default-fullname">Longitude Customer</label>
            </div>
            <div class="mb-6">
                <small class="text-light fw-medium">Maps</small>
                <div class="defaultFormControlInput mt-4">
                    <div id='map'></div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
    </form>
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


        var Stadia_AlidadeSatellite = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_satellite/{z}/{x}/{y}{r}.{ext}', {
            minZoom: 0
            , maxZoom: 20
            , attribution: '&copy; CNES, Distribution Airbus DS, © Airbus DS, © PlanetObserver (Contains Copernicus Data) | &copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            , ext: 'jpg'
        });

        var openstreetMap = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
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


    map.on('click', function(e) {
        if (marker != null) {
            map.removeLayer(marker);
        }
        marker = new L.marker(e.latlng).bindPopup('Hi There! lat').addTo(map);
        document.getElementById('latitude_ticket').value = e.latlng.lat;
        document.getElementById('longitude_ticket').value = e.latlng.lng;
    });
    /* --------------------------- Initialize Markers --------------------------- */

</script>
@endsection
