@extends('../layout')
@section('content')

<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            @if(session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif
            @if($ticket->status == 'open')
            <form action="{{ route('ticket.update', $ticket->id) }}" method="post" style="display: inline" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <button type=" submit" class="btn btn-warning waves-effect waves-light float-end" name="status" value="onprogress">
                    On Progress<span class="ri-arrow-drop-right-line ri-25px"></span>
                </button>
            </form>
            @endif
            <h3>Edit Ticket</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('ticket.update', $ticket->id) }}" method="post" style="display: inline" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="" name="ticket_id" value="{{ $ticket->id }}" readonly>
                    <label for="basic-default-fullname">Tiket ID</label>
                </div>
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="Pak RT" name="customer_name" value="{{ $ticket->customer_name }}" readonly>
                    <label for="basic-default-fullname">Nama Customer</label>
                </div>
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="Jl.xx xx" name="customer_address" value="{{ $ticket->customer_address }}" readonly>
                    <label for="basic-default-fullname">Alamat Customer</label>
                </div>
                @error('karyawan_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="" name="" value="{{ $ticket->user->name }}" readonly>
                    <label for="basic-default-fullname">Teknisi</label>
                </div>
                @if($ticket->status != 'closed')
                <button type="button" data-bs-toggle="modal" data-bs-target="#modalCenterUbahTeknisi" class="btn btn-success waves-effect waves-light mb-2 mb-2">Ubah Teknisi</button>
                @endif
                <div class="mb-6">
                    <div class="mt-4">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success waves-effect waves-light mb-2" data-bs-toggle="modal" data-bs-target="#modalCenter">
                            <span class="ri-image-line ri-16px me-1_5"></span>Lihat Foto Lokasi
                        </button>
                        <a class="btn btn-success waves-effect waves-light mb-2" target="_blank" href="https://www.google.com/maps/place/{{ $ticket->latitude_ticket }},{{ $ticket->longitude_ticket }}">
                            <span class="ri-map-2-line ri-16px me-1_5"></span>Lihat Maps Lokasi
                        </a>
                    </div>
                </div>
                <div class="mb-6"> Ticket Status :
                    @if($ticket->status == 'open')
                    <span class="badge rounded-pill bg-label-success me-1">OPEN</span>
                    @elseif($ticket->status == 'onprogress')
                    <span class="badge rounded-pill bg-label-warning me-1">ON PROGRESS</span>
                    @else
                    <span class="badge rounded-pill bg-label-dark me-1">CLOSED</span>@endif
                </div>

        </div>
    </div>
</div>
@if($ticket->status == 'onprogress')

<div class="col-md-6">
    <div class="card">
        <div class="card-body">
            <h3>On Progress Form</h3>
            <div class="form-floating form-floating-outline mb-6">
                <input type="text" class="form-control" id="basic-default-fullname" placeholder="" value="{{ $ticket->start_date }}" readonly>
                <label for="basic-default-fullname">Start Date</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
                <input type="text" class="form-control" id="basic-default-fullname" placeholder="" value="{{ $ticket->sla->nama_sla }}" readonly>
                <label for="basic-default-fullname">SLA</label>
            </div>
            @error('latitude_task')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('longitude_task')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="input-group mb-6">
                <span class="input-group-text"><span class="ri-gps-line ri-16px me-1_5"></span>GPS</span>
                <input type="text" aria-label="First name" class="form-control" name="latitude_task" id="latitude_karyawan" readonly>
                <input type="text" aria-label="Last name" class="form-control" name='longitude_task' id="longitude_karyawan" readonly>
            </div>
            <button type="button" class="btn btn-warning waves-effect waves-light mb-6" id="button_gps" name="status" value="onprogress" onclick="getLocation()">
                <span class="ri-gps-line ri-16px me-1_5"></span><text id="text_gps">Get GPS</text>
            </button>
            @error('image_task')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-6">
                <label for="formFile" class="form-label">Upload Foto</label>
                <input class="form-control" type="file" id="formFile" name="image_task">
            </div>
            @error('note')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-floating form-floating-outline mb-6">
                <textarea class="form-control h-px-100" id="exampleFormControlTextarea1" placeholder="Opsional" name="note"></textarea>
                <label for="exampleFormControlTextarea1">Catatan</label>
            </div>
            <button type="submit" class="btn btn-success" name="close_ticket"><span class="ri-save-3-line ri-16px me-1_5"></span>Closed Ticket</button>
            </form>
        </div>
    </div>
</div>
@endif

<div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Foto Lokasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-12 mb-6 mt-2 text-center">
                        <div class="form-floating form-floating-outline">
                            <img class="img-fluid rounded mx-auto d-block" src="{{ url('/') }}/assets/img/customer/{{ $ticket->image_address }}" alt="{{ $ticket->customer_name }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalCenterUbahTeknisi" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Ubah Teknisi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-12 mb-6 mt-2 text-center">
                        <div class="form-floating form-floating-outline">
                            <div class="form-floating form-floating-outline mb-6">
                                <form action="{{ route('ticket.update', $ticket->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <select id="country" class="select2 form-select" name="user_id">
                                        <option value="{{ $ticket->user->id }}">{{ $ticket->user->name }}</option>
                                        @foreach ($karyawans as $karyawan)
                                        <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success float-end"><span class="ri-save-3-line ri-16px me-1_5"></span>Ubah Teknisi</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const x = document.getElementById("demo");

    function getLocation() {
        if (navigator.geolocation) {
            document.getElementById("button_gps").disabled = true;
            document.getElementById("text_gps").textContent = "Getting GPS...";
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }


    function showPosition(position) {
        document.getElementById("button_gps").disabled = false;
        document.getElementById("text_gps").textContent = "Get GPS";
        document.getElementById('latitude_karyawan').value = position.coords.latitude;
        document.getElementById('longitude_karyawan').value = position.coords.longitude;
    }

</script>

@endsection
